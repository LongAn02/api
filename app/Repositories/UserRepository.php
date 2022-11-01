<?php

namespace App\Repositories;

use App\Models\User;

class UserRepository extends BaseRepository
{
    public function model()
    {
        return User::class;
    }

    public function getAllUser() {
        return $this->getAll();
    }

    public function getUser() {
        return $this->model->leftJoin('user_discountDetail', 'users.id', '=', 'user_discountDetail.user_id')
            ->leftJoin('discount_detail', 'discount_detail.id', '=', 'user_discountDetail.discountDetail_id')
            ->leftJoin('discount_type', 'discount_type.id', '=', 'discount_detail.discount_type_id')
            ->leftJoin('discounts', 'discounts.id', '=', 'discount_detail.discount_id')
            ->leftJoin('categories', function ($leftJoin) {
                $leftJoin->on('discount_detail.detailID', '=', 'categories.id')
                    ->where('discount_detail.discount_type_id', '=', '1');
            })
            ->leftJoin('products', function ($leftJoin) {
                $leftJoin->on('discount_detail.detailID', '=', 'products.id')
                    ->where('discount_detail.discount_type_id', '=', '2');
            })
            ->select('users.id as user_id', 'users.name as user_name', 'users.email as user_email',
                    'users.phone as user_phone', 'users.address as user_address', 'users.age as user_age',
                'users.sex as user_sex', 'discount_type.name as discount_type_name', 'discounts.name as discount_name',
                'discounts.percent_discount as discount_percent', 'categories.name as category_name',
                'products.name as product_name', 'products.price as product_price')
            ->get();
    }

    public function storeUser($data) {
        return $this->store($data);
    }

    public function showUserById($id) {
        return $this->findOrFail($id);
    }

    public function updateUser($id, $data) {
        return $this->update($id, $data);
    }
}
