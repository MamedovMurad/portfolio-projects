<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;
    protected $fillable = [
        'author_id',
        'cover_img',
        'title',
        'link',
        'likes',
        'desc',
        'category_id',
        'project_id',
       
        
    ];
}
