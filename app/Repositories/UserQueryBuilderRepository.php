<?php

namespace App\Repositories;

use Illuminate\Database\ConnectionInterface;

class UserQueryBuilderRepository
{
    public function __construct(private readonly ConnectionInterface $connection)
    {
    }

    public function getUsers(int $take = 1000): array
    {
        $users = $this
            ->connection
            ->table('users')
            ->select(['name', 'email', 'created_at'])
            ->take($take)
            ->get();

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
