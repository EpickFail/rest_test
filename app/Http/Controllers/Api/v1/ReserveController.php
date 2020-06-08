<?php

namespace App\Http\Controllers\Api\v1;

use App\Reserve;
use App\ReserveFilter;
use App\Http\Requests\ReserveRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReserveController extends Controller 
{

    /**
     * Display a listing of the reserve.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function list(Request $request) 
    {    
        $reserve = Reserve::query();    
        $result = (new ReserveFilter($reserve, $request))->apply();   
        return response($result, 200);
    }

    /**
    * Create new reserve in storage.
    * 
    * @param App\Http\Requests\ReserveRequest $request
    * @return \Illuminate\Http\Response
    */
    public function create(ReserveRequest $request) 
    {
        $reserve = Reserve::create($request->validated());
        return response($reserve, 201);
    }

    /**
     * Display the specified reserve.
     *
     * @param  $id reserve
     * @return \Illuminate\Http\Response
     */
    public function getById($id) 
    {
        return response(Reserve::find($id), 200);
    }
   

    /**
     * Update the specified reserve in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Reserve  ReserveRequest
     * @return \Illuminate\Http\Response
     */
    public function update(ReserveRequest $request, $id) {
        $reserve = Reserve::findOrFail($id);
        $reserve->update($request->validated());
        return response($reserve, 200);
    }

    /**
     * Dele tehe specified reserve.
     * 
     * @param App\Http\Requests\ReserveRequest $request
     * @param type $id reserve
     * @return int status answer
     */
    public function delete(ReserveRequest $request, $id) {
        $reserve = Reserve::findOrFail($id);
        $reserve->delete();
        return 204;
    }

}
