<?php

namespace App\Service;

use App\Repositories\ShoppingCartRepository;
use App\Repositories\ShoppingSessionRepository;

class ShoppingCartService
{
    protected $shoppingCartRepository;
    protected $shoppingSessionRepository;
    protected $shoppingSessionService;

    /**
     * @param ShoppingCartRepository $shoppingCartRepository
     * @param ShoppingSessionRepository $shoppingSessionRepository
     */
    public function __construct(
        ShoppingCartRepository $shoppingCartRepository,
        ShoppingSessionRepository $shoppingSessionRepository,
        ShoppingSessionService $shoppingSessionService
    ) {
        $this->shoppingCartRepository = $shoppingCartRepository;
        $this->shoppingSessionRepository = $shoppingSessionRepository;
        $this->shoppingSessionService = $shoppingSessionService;
    }

    /**
     * @param $product_id
     * @return bool|\Illuminate\Database\Eloquent\Model|mixed
     */
    public function storeShoppingCart($product_id)
    {
        $shoppingSessionId = shopping_session_by_user();
        $productInShoppingCart = $this->shoppingCartRepository->whereProductId($shoppingSessionId, $product_id);

        if ($productInShoppingCart->count()) {
            return $this->updateQuantityProductInShoppingCart($product_id);
        }

        $addProductTheCart = $this->shoppingCartRepository->createShoppingCart([
            'shopping_session_id' => $shoppingSessionId,
            'product_id' => $product_id,
        ]);

        if ($addProductTheCart) {
            $this->shoppingSessionService->updateTotalShoppingSession();
        }
        return $addProductTheCart;
    }

    /**
     * @param $product_id
     * @param $act
     * @return bool|mixed
     */
    public function updateQuantityProductInShoppingCart($product_id, $act = 'update_one')
    {
        $arr = $this->shoppingCartRepository->whereProductId(shopping_session_by_user(), $product_id);
        if (!$arr->count()){
            return false;
        }
        $quantityProductInCart = $arr->first()->quantity;
        if ($act == 'delete_one') {
            if ($quantityProductInCart > 1) {
                return $this->shoppingCartRepository->updateQuantity($arr->first()->id, ['quantity' => $quantityProductInCart - 1]);
            } else {
                return false;
            }
        }
        return $this->shoppingCartRepository->updateQuantity($arr->first()->id, ['quantity' => $quantityProductInCart + 1]);
    }

    /**
     * @param $productId
     * @return mixed
     */
    public function deleteProductInShoppingCartByProductId($productId)
    {
        $deleteProduct = $this->shoppingCartRepository->deleteProductByProductId(shopping_session_by_user(), $productId);
        if ($deleteProduct) {
            $this->shoppingSessionService->updateTotalShoppingSession('delete_one');
        }
        return $deleteProduct;
    }

    /**
     * @return mixed
     */
    public function showShoppingCartByUser()
    {
        return $this->shoppingCartRepository->getShoppingCartByUser(shopping_session_by_user());
    }
}
