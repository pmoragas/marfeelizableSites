<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'sites';

    protected $primaryKey = 'id';

    protected $fillable = array('url','rank','isMarfeelizable');

    protected $hidden = ['created_at','updated_at'];
}
