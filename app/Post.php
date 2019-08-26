<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    use SoftDeletes;

    protected $fillable = ['title', 'description', 'content', 'published_at', 'image'];

    public function deleteImage()
    {
        $image = Storage::delete('public/posts/'.$this->image);
    }

    public function category()
    {
      return $this->belongsTo(Category::class, 'category_id');
    }
}
