<?php


namespace App\Services;


use App\Models\UserCollection;
use App\Repositories\NewUserRepository;


class NewUserService
{
    private NewUserRepository $newUserRepository;


    public function __construct(NewUserRepository $newUserRepository)
    {
        $this->newUserRepository = $newUserRepository;
    }

    public function execute(): UserCollection
    {

            return $this->newUserRepository->requestUsers();

    }
    public function executeSave (StoreUserServiceRequest $request): void
    {

        $this->newUserRepository->save($request);

    }


}
