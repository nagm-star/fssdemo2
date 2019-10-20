<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gallary extends Model
{

    public $table = 'gallaries';


    public $fillable = [
        'title','body','image','status'
    ];
}
