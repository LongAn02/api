<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingSession extends Model
{
    use HasFactory;

    protected $table = 'shopping_session';

    protected $fillable = [
        'user_id',
        'total'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function users() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
