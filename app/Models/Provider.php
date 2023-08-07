<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    use HasFactory;

    // 表名
    protected $table = 'providers';

    // 可写入字段
    protected $fillable = ['user_id', 'provider', 'provider_id'];

    // 定义与 User 模型的关联关系
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
