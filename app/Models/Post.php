<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory;
    use Searchable;

    protected $primaryKey = 'ulid';
    protected $keyType = 'string';

    protected $fillable = [
        'ulid',
        'title',
        'slug',
        'content',
        'image',
        'background_image',
        'published',
        'published_at',
        'views',
        'meta_description',
        'meta_keywords',
        'user_id',
        'category_id'
    ];

    protected $casts = [ 'published_at' => 'datetime' ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function getImageAttribute($value)
    {
        $backgroundImageArray = json_decode(env('BACKGROUND_IMAGE'), true);
        if (empty($backgroundImageArray)) {
            $defaultImage = '/storage/images/660200782b63f73c4ae3fa42773deeea.jpg';
        } else {
            $defaultImage = $backgroundImageArray[array_rand($backgroundImageArray)]['url'];
        }
        return $value ?: $defaultImage;
    }

    public function searchableAs()
    {
        return 'posts';
    }

    public function shouldBeSearchable()
    {
        return $this->published;
    }
}
