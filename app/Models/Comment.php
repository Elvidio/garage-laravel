<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $table = "Comments";

    protected $fillable = [
        'content',
    ];

    protected $attributes = [
        'enabled' => true,
    ];

    // récupération de l'id de user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // récupération de l'id de announcement
    public function announcement()
    {
        return $this->belongsTo(Announcement::class);
    }


}

