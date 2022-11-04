<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Service\ShoppingSessionService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $user;
    protected $shoppingSessionService;

    /**
     * @param User $user
     * @param ShoppingSessionService $shoppingSessionService
     */
    public function __construct(
        ShoppingSessionService $shoppingSessionService,
        User $user
    ) {
        $this->user = $user;
        $this->shoppingSessionService = $shoppingSessionService;
    }

    /**
     * @param UserRequest $userRequest
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(UserRequest $userRequest)
    {
        $user = $userRequest->all();
        $user['password'] = bcrypt($user['password']);

        $userCreate = $this->user->create($user);
        $this->shoppingSessionService->storeShoppingSession($userCreate->id);

        $userResource = new UserResource($userCreate);

        return $this->sentSuccessResponse(
            $userResource,
            message: "successfully",
            status: Response::HTTP_OK
        );
    }

    public function login(UserLoginRequest $userLoginRequest)
    {
        $userLogin = $userLoginRequest->all();

        if (Auth::attempt($userLogin)) {

            $user = auth()->user();

            $token = $user->createToken("testAPI")->accessToken;

            $userResource = new UserResource($user);

            return $this->sentSuccessResponse(
                [
                    'user' => $userResource,
                    'token' => $token
                ],
                message: 'login successful',
                status: Response::HTTP_OK
            );
        } else {
            return $this->sentSuccessResponse(
                message: 'login unsuccessful',
                status: Response::HTTP_UNAUTHORIZED
            );
        }
    }
}
