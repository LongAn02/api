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

    public function updateQuantity($where, $value)
    {
        return $this->update($where, $value);
    }

    public function whereProductId($shopping_session_id, $product_id)
    {
        return $this->model->where('shopping_session_id', $shopping_session_id)
            ->where('product_id', $product_id)->get();
    }

    public function getShoppingCartByUser($shoppingSessionId)
    {
        return $this->model->where('shopping_session_id', $shoppingSessionId)->get();
    }

    public function deleteProductByProductId($shoppingSessionId, $productId)
    {
        return $this->model->where('shopping_session_id', $shoppingSessionId)
            ->where('product_id', $productId)
            ->delete();
    }

}
