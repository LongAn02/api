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

    public function updateTotal($shoppingSessionId)
    {
        $shoppingSession = $this->getTotalOnShoppingSession($shoppingSessionId);
        $total = $shoppingSession->first()->total;
        $this->update($shoppingSession->first()->id,['total' => $total + 1]);
    }

    public function getTotalOnShoppingSession($shoppingSessionId)
    {
        return $this->where('id', $shoppingSessionId)->get();
    }
}
