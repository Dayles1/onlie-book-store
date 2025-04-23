<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
class Translation extends Model
{
    protected $fillable = ['key', 'value', 'lang_prefix', 'is_active'];
}

