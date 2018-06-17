<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $url
 * @property int $rank
 * @property boolean $isMarfeelizable
 */

class Site extends Model
{

    protected $fillable = ['url','rank','isMarfeelizable'];

}
