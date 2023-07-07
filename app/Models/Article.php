<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Article extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = "article";

    protected $guarded =[];


    public function UserBind(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user', 'id');
    }


}
