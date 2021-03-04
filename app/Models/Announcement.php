<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $table = "Announcements";

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'price',
    ];

    protected $attributes = [
        'enabled' => true,
    ];

    // récupération de l'id de user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
