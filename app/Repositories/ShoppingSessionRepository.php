<?php

namespace App\Repositories;

use App\Models\ShoppingSession;

class ShoppingSessionRepository extends BaseRepository
{
    public function model()
    {
        return ShoppingSession::class;
    }

    public function createShoppingSession($data)
    {
        $this->store($data);
    }

    public function updateTotal($where, array $value)
    {
        return $this->update($where, $value);
    }

    public function getTotalOnShoppingSession($shoppingSessionId)
    {
        return $this->where('id', $shoppingSessionId)->get();
    }
}
