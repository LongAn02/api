<?php

namespace App\Service;

use App\Repositories\ShoppingCartRepository;
use App\Repositories\ShoppingSessionRepository;
use function PHPUnit\Framework\isEmpty;

class ShoppingCartService
{
    protected $shoppingCartRepository;
    protected $shoppingSessionRepository;

    /**
     * @param ShoppingCartRepository $shoppingCartRepository
     * @param ShoppingSessionRepository $shoppingSessionRepository
     */
    public function __construct(
        ShoppingCartRepository $shoppingCartRepository,
        ShoppingSessionRepository $shoppingSessionRepository
    ) {
        $this->shoppingCartRepository = $shoppingCartRepository;
        $this->shoppingSessionRepository = $shoppingSessionRepository;
    }

    public function storeShoppingCart($product_id)
    {
        $shoppingSessionId = auth()->user()->shoppingSession->id;
        $productInShoppingCart = $this->shoppingCartRepository->whereProductId($shoppingSessionId, $product_id);

        if ($productInShoppingCart->count()) {
            return $this->shoppingCartRepository->updateQuantity($shoppingSessionId, $product_id);
        }

        $addProductTheCart = $this->shoppingCartRepository->createShoppingCart([
            'shopping_session_id' => $shoppingSessionId,
            'product_id' => $product_id,
        ]);

        if ($addProductTheCart) {
            $this->shoppingSessionRepository->updateTotal($shoppingSessionId);
        }
        return $addProductTheCart;
    }
}
