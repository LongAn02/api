<?php

namespace App\Service;

use App\Repositories\UserRepository;

class UserService
{
    protected $userRepository;

    /**
     * @param UserRepository $userRepository
     */
    public function __construct(
        UserRepository $userRepository
    ){
        $this->userRepository = $userRepository;
    }

    public function createUser($data) {
        $dataUsers = [
            'name' => $data['_name'],
            'email' => $data['_email'],
            'password' => bcrypt($data['_password']),
            'phone' => $data['_phone'],
            'address' => $data['_address'],
            'age' => $data['_age'],
            'sex' => $data['_sex'],
            'created_at' => now(),
            'updated_at' => now()
        ];
        return $this->userRepository->storeUser($dataUsers);
    }

    public function getAllUser() {
        return $this->userRepository->getUser();
    }

    public function getUserById($id) {
        return $this->userRepository->showUserById($id);
    }

    public function updateUserById($id, $data) {
        $dataUsers = [
            'name' => $data['_name'],
            'email' => $data['_email'],
            'password' => bcrypt($data['_password']),
            'phone' => $data['_phone'],
            'address' => $data['_address'],
            'age' => $data['_age'],
            'sex' => $data['_sex'],
            'created_at' => now(),
            'updated_at' => now()
        ];

        return $this->userRepository->updateUser($id,$dataUsers);
    }
}
