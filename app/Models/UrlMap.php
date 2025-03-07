<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UrlMap extends Model
{
    use HasFactory;

    protected $table = 'url_map';

    protected $fillable = [
        'long_url',
        'short_url',
    ];
}
