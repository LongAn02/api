<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShoppingCartResource;
use App\Service\ShoppingCartService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShoppingCartController extends Controller
{
    protected $shoppingCartService;

    public function __construct(
        ShoppingCartService $shoppingCartService,
    ) {
        $this->shoppingCartService = $shoppingCartService;
    }


    /**
     * Show shopping cart of the user login
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shoppingCart = $this->shoppingCartService->showShoppingCartByUser();

        $shoppingCartResource =  ShoppingCartResource::collection($shoppingCart);

        return $this->sentSuccessResponse(
            $shoppingCartResource,
            status: Response::HTTP_OK
        );
    }

    /**
     * Add product to shopping cart of the user login by product id
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $addProduct = $this->shoppingCartService->storeShoppingCart($request->id);

        $addProductResource =  new ShoppingCartResource($addProduct);

        return $this->sentSuccessResponse(
            $addProductResource,
            status: Response::HTTP_OK
        );
    }


    /**
     * Increase or decrease the quantity of a product in shopping cart of the user login by product id and act
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $product_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $product_id)
    {
        $updateProductInShoppingCart = $this->shoppingCartService->updateQuantityProductInShoppingCart($product_id, $request->act);

        if ($updateProductInShoppingCart) {
            $shoppingCartResource = new ShoppingCartResource($updateProductInShoppingCart);
        } else {
            $shoppingCartResource = 'false';
        }

        return $this->sentSuccessResponse(
            $shoppingCartResource,
            message: 'bad request',
            status: $updateProductInShoppingCart ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }

    /**
     * Remove product from cart of the user login by product id
     *
     * @param  int $product_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($product_id)
    {
        $deleteProduct = $this->shoppingCartService->deleteProductInShoppingCartByProductId($product_id);

        return $this->sentSuccessResponse(
              message: $deleteProduct ? 'delete successfully' : 'delete failed',
              status:  $deleteProduct ? Response::HTTP_OK : Response::HTTP_BAD_REQUEST
        );
    }
}
