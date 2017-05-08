<?php

namespace App\Repositories;

use App\Models\User;
use Schema;
use Hash;

class UserRepository extends BaseRepository
{
    public function __construct(User $user)
    {
        $this->model = $user;
    }

    /**
     * Limit to app users only
     *
     * @return mixed
     */
    public function appUsers()
    {
        return $this->query()->where('role', 'appuser')->orderBy('created_at', 'DESC');
    }
}
