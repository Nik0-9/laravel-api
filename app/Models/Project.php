<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\Tag;
use App\Models\Types;


class Project extends Model
{
    use HasFactory;
    protected $fillable = ['title','image','content','slug','type_id'];
    public static function generateSlug($title)
    {
        $slug = Str::slug($title, '-');
        
        return $slug;
    }

    public function type(){
        return $this->belongsTo(Type::class);
    }
    
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }
}
