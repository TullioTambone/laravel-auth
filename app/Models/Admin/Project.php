<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;
    protected $table = 'projects';

    protected $fillable = ['title', 'description','img', 'slug'];

    public static function generateSlug($title)
    {
        return  Str::slug($title, '-');
    }
}
