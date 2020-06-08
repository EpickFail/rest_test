<?php
namespace App;

class ReserveFilter
{
    /**
     * builder of Reserve
     * 
     * @var \Illuminate\Database\Eloquent\Builder
     */
    protected $builder;
    
    /**
     * Instanse of Request
     * 
     * @var \Illuminate\Http\Request 
     */
    protected $request;
    
    /**
     * offset for list request
     * 
     * @var int 
     */
    protected $offset = 0;
    
    /**
     * limit for list request
     *
     * @var int 
     */
    protected $limit = 10;
    
    /**
     * count of element in storage
     * 
     * @var int
     */
    protected $count;
    
    /**
     * Create a new ReserveController instance.
     * 
     * @param \Illuminate\Database\Eloquent\Builder $builder
     * @param \Illuminate\Http\Request $request
     */
    public function __construct($builder, $request) 
    {
        $this->builder = $builder;    
        $this->request = $request;
    }
    
    /**
     * Apply request filters
     * 
     * @return array
     */
    public function apply():array
    {
        foreach ($this->filters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }
        $this->count = $this->builder->count();
        return $this->wrapResult($this->builder->skip($this->offset)->take($this->limit)->get());
    }
    
    /**
     * Wrap the result of the request with additional information.
     * 
     * @param object $result
     * @return array
     */
    private function wrapResult(object $result):array
    {
        $wrapper_result = array_merge(
                ['result' => $result],
                ['total' => $this->count],
                ['limit' => $this->limit],
                ['offset' => $this->offset],
                ['next' => $this->offset+$this->limit]
            );
        return $wrapper_result;
    }
    
    /**
     * Show filters in request.
     * 
     * @return array
     */
    public function filters():array
    {
        return $this->request->all();
    }
    
    /**
     * Filter on status of reserve 
     * 
     * @param boolean $value
     * @return boolean
     */
    private function status(bool $value)
    {
        return $this->builder->where('status', $value);
    }
    
    /**
     * Filter on id_user of reserve 
     * 
     * @param int $value
     * @return int
     */
    private function id_user(int $value)
    {
        return $this->builder->where('id_user', $value);
    }
    
    /**
     * Set offset for sampling
     * 
     * @param int $value
     * @return int
     */
    private function offset(int $value):int
    {
        return $this->offset = $value;
    }
    
    /**
     * Set limit for sampling
     * 
     * @param int $value
     * @return int
     */
    private function limit(int $value):int
    {
        return $this->limit = $value;
    }

}
