<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\UserCollection;
use App\Services\StoreUserServiceRequest;

interface UserRepository
{
public function requestUsers(): UserCollection;
public function save(StoreUserServiceRequest $newUser): void;
}
