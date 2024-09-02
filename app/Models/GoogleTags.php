<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleTags extends Model
{
    use HasFactory;

    protected $table = 'google_tags';
    
    protected $fillable = [
        'tag_id',
        'name',
        'token',
    ];
}
