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
}
