<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content',
        'user_id',
        'post_id',
        'parent_id'
    ];

    protected function serializeDate(\DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function parent()
    {
        return $this->belongsTo(Comment::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Comment::class, 'parent_id');
    }

    public function descendants()
    {
        return $this->children()->with('descendants');
    }

    public function ancestors()
    {
        return $this->parent()->with('ancestors');
    }

    public function getDescendantsAttribute()
    {
        return $this->descendants->flatten();
    }

    public function getAncestorsAttribute()
    {
        return $this->ancestors->flatten();
    }

    public function getParentIdAttribute($value)
    {
        return $value ?? 0;
    }

    public static function buildTree($comments, $parentId = 0)
    {
        $branch = [];

        foreach ($comments as $comment) {
            if ($comment->parent_id == $parentId) {
                $children = self::buildTree($comments, $comment->id);

                if ($children) {
                    $comment->replies = $children;
                }

                $branch[] = $comment;
            }
        }

        return $branch;
    }
}
