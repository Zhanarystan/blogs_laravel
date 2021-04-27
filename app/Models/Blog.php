<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Blog extends Model
{
    protected $table = "blogs";

    protected $fillable = [
        'id',
        'title',
        'text',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
