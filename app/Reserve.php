<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reserve extends Model
{
    protected $fillable = ['date_reserve', 'status', 'id_user'];
    
}
