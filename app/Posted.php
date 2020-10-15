<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posted extends Model
{
    protected $table = 'posteds';

    protected $fillable = ['title','description','slug','featured_image','is_deleted'];
}
