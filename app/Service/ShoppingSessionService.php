<?php

namespace App\Service;

use App\Repositories\ShoppingSessionRepository;

class ShoppingSessionService
{
    protected $shoppingSessionRepository;

    public function __construct(ShoppingSessionRepository $shoppingSessionRepository)
    {
        $this->shoppingSessionRepository = $shoppingSessionRepository;
    }

    public function storeShoppingSession($user_id)
    {
        $data = [
            'user_id' => $user_id,
            'created_at' => now(),
            'updated_at' => now()
        ];
        $this->shoppingSessionRepository->createShoppingSession($data);
    }

    public function updateTotalShoppingSession($act = 'update_one') {
        $shoppingSession = $this->shoppingSessionRepository->getTotalOnShoppingSession(shopping_session_by_user());
        $total = $shoppingSession->first()->total;
        if ($act == 'delete_one') {
            return $this->shoppingSessionRepository->updateTotal($shoppingSession->first()->id, ['total' => $total - 1]);
        }
        return $this->shoppingSessionRepository->updateTotal($shoppingSession->first()->id,['total' => $total + 1]);
    }

}
