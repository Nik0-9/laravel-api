<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Project;


class Tag extends Model
{
    use HasFactory;
    protected $fillable=['name','slug'];
    public static function generateSlug($name)
    {
        $slug = Str::slug($name, '-');
        
        return $slug;
    }
    public function projects(){
        return $this->belongsToMany(Project::class);
    }

}
