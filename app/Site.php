<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Site extends Model
{
    protected $table = 'Sites';

    protected $primaryKey = 'Id';

    protected $fillable = array('Url','Rank','IsMarfeelizable');

    protected $hidden = ['created_at','updated_at'];
}
