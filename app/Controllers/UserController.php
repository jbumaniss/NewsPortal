<?php


namespace App\Controllers;


use App\Services\NewUserService;
use App\Services\StoreUserServiceRequest;
use App\TemplateView;

class UserController
{

    private NewUserService $newUserService;

    public function __construct(NewUserService $newUserService)
    {
        $this->newUserService = $newUserService;
    }

    public function register(): TemplateView
    {
        return new TemplateView("register.view.html.twig", ['articles' => 'test']);
    }

    public function store(): void
    {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        $this->newUserService
            ->executeSave(
                new StoreUserServiceRequest(
                    $_POST["name"],
                    $_POST["surname"],
                    $_POST["email"],
                    $password,
                )
            );

        header('Location: /');
    }

    public function login(): TemplateView
    {
        return new TemplateView("login.view.html.twig", ['articles' => 'test']);
    }

    public function authenticate(): void
    {
        $users = $this->newUserService->execute()->getUsers();



        $email = $_POST['email'];
        $password = $_POST['password'];
        foreach ($users as $user) {

            if ($user->getEmail() == $email && password_verify($password, $user->getPassword())) {
                $_SESSION['activeId'] = $user->getID();
                $_SESSION['user'] = $user;
                header('Location: /');
                break;
            }
            if ($user->getEmail() != $email && !password_verify($password, $user->getPassword())) {
                header('Location: /login');
            }
        }
    }

    public function logout(): void
    {
        $_SESSION['activeId'] = '';
        header('Location: /');
    }

}
