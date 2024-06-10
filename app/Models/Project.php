<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;
    protected $fillable = ['title','image','content','slug','type_id','technology_id'];
    public static function generateSlug($title)
    {
        $slug = Str::slug($title, '-');
        
        return $slug;
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }
    public function technologies(){
        return $this->belongsToMany(Technology::class)->withTimestamps();
    }
    
}
