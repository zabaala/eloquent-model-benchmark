<?php

namespace App\Repositories;

use App\Models\User;

class UserModelRepository
{
    public function __construct(private readonly User $userModel)
    {
    }

    public function getUsers(int $take = 1000)
    {
        $users = $this->userModel->select(['name', 'email', 'created_at'])->take($take)->get();

        $items = [];

        foreach ($users as $user) {
            $name = explode(' ', $user->name);
            $domain = explode('@', $user->email);

            $items[] = [
                'firstName' => $name[0],
                'lastName' => end($name),
                'email' => $user->email,
                'domain' => end($domain),
                'created_at' => $user->created_at,
            ];
        }

        return $items;
    }
}
