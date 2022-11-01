<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Service\UserService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    protected $userService;
    protected $user;

    /**
     * @param UserService $userService
     */
    public function __construct(
        UserService $userService,
        User $user
    ) {
        $this->userService = $userService;
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->user->all();

        $userResource = UserResource::collection($users);

        return $this->sentSuccessResponse(
            $userResource,
            status: Response::HTTP_OK
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $user = $this->user->create($request->all());

        $userResource = new UserResource($user);

        return $this->sentSuccessResponse(
            $userResource,
            status: Response::HTTP_OK
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = $this->user->findOrFail($id);

        $userResource = new UserResource($user);

        return $this->sentSuccessResponse(
            $userResource,
            status: Response::HTTP_OK
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = $this->user->findOrFail($id);

        $user->update($request->all());

        $userResource = new UserResource($user);

        return $this->sentSuccessResponse(
            $userResource,
            message: $userResource ? 'success' : 'errors',
            status: $userResource ? Response::HTTP_OK : Response::HTTP_NOT_FOUND,
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->user->findOrFail($id);

        $user->delete();

        return $this->sentSuccessResponse(
            extraDataTransmission: [
                'message' => 'successfully deleted '.$id
            ],
            status: Response::HTTP_OK
        );
    }
}
