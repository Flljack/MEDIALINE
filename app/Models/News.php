<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'news';

    protected $fillable = ['title', 'description', 'description_preview', 'author', 'source', 'created_at'];

    public $timestamps = false;
}
