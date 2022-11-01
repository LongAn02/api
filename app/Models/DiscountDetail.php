<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountDetail extends Model
{
    use HasFactory;
    protected $primaryKey ='id';

    protected $table = 'discount_detail';

    protected $fillable = [
        'discount_type_id',
        'discount_id',
        'detailID'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function users() {
        return $this->belongsToMany(User::class, 'user_discountDetail', 'discountDetail_id', 'user_id');
    }

    public function discounts() {
        return $this->belongsTo(Discount::class, 'discount_id', 'id');
    }
}
