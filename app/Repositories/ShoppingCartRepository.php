<?php

namespace App\Repositories;

use App\Models\ShoppingCart;

class ShoppingCartRepository extends BaseRepository
{
    public function model()
    {
        return ShoppingCart::class;
    }

    public function createShoppingCart($data)
    {
        return $this->store($data);
    }

    public function updateQuantity($shopping_session_id, $product_id)
    {
        $arr = $this->whereProductId($shopping_session_id, $product_id);
        $quantityProductInCart = $arr->first()->quantity;
        return $this->update($arr->first()->id, ['quantity' => $quantityProductInCart + 1]);
    }

    public function whereProductId($shopping_session_id, $product_id)
    {
        return $this->model->where('shopping_session_id', $shopping_session_id)
            ->where('product_id', $product_id)->get();
    }
}
