<?php

use App\Repositories\NewArticleRepository;
use App\Repositories\NewsApiArticleRepository;
use App\Repositories\NewUserRepository;
use App\Services\ArticlesService;
use App\Services\NewArticleService;
use App\Services\NewUserService;
use App\Services\TwigController;
use App\TemplateView;
use DI\Container;
use DI\ContainerBuilder;
use Dotenv\Dotenv;

require_once 'vendor/autoload.php';


$dotEnv = Dotenv::createImmutable(__DIR__);
$dotEnv->load();

session_start();

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {

    if ($_SESSION['activeId'] == '' || !isset($_SESSION['activeId'])){
        $r->addRoute('GET', '/login', "App\Controllers\UserController@login");
        $r->addRoute('GET', '/register', "App\Controllers\UserController@register");
        $r->addRoute('POST', '/user/create', "App\Controllers\UserController@store");
    }
    if ($_SESSION['activeId'] > 0) {
        $r->addRoute('GET', '/articles', "App\Controllers\ArticleIndexController@articles");
        $r->addRoute('GET', '/logout', "App\Controllers\UserController@logout");
        $r->addRoute('POST', '/destroy', "App\Controllers\NewArticleController@destroy");
        $r->addRoute('GET', '/article/{id}/edit', "App\Controllers\NewArticleController@edit");
        $r->addRoute('POST', '/article/{id}/update', "App\Controllers\NewArticleController@update");
        $r->addRoute('GET', '/articles/create', "App\Controllers\NewArticleController@create");

        $r->addRoute('GET', '/entertainment', "App\Controllers\ArticleIndexController@entertainment");
        $r->addRoute('GET', '/business', "App\Controllers\ArticleIndexController@business");
        $r->addRoute('GET', '/science', "App\Controllers\ArticleIndexController@science");
        $r->addRoute('GET', '/health', "App\Controllers\ArticleIndexController@health");
        $r->addRoute('GET', '/sports', "App\Controllers\ArticleIndexController@sports");
        $r->addRoute('GET', '/technology', "App\Controllers\ArticleIndexController@technology");
    }
    $r->addRoute('POST', '/authenticate', "App\Controllers\UserController@authenticate");
    $r->addRoute('GET', '/', "App\Controllers\ArticleIndexController@index");
    $r->addRoute('GET', '/contacts', "App\Controllers\ArticleIndexController@contacts");
    $r->addRoute('POST', '/articles', "App\Controllers\NewArticleController@store");
    $r->addRoute('GET', '/article/{id}', "App\Controllers\NewArticleController@article");

});


$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];


if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);

}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo "404 Not Found";
        header('Location: /');


        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo "405 Method Not Allowed";

        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];


        [$controller, $method] = explode("@", $handler);

        $twigConfig = new TwigController();

        /** @var TemplateView $view */

        $container = new Container();

        $containerBuilder = new ContainerBuilder();
        $containerBuilder->addDefinitions([
            'ArticlesService' => new ArticlesService(new NewsApiArticleRepository()),
            'NewArticleService' => new NewArticleService(new NewArticleRepository()),
            'NewUserService' => new NewUserService(new NewUserRepository())
        ]);
        $container = $containerBuilder->build();
        $articleService = $container->get("ArticlesService");
        $newArticleService = $container->get("NewArticleService");
        $newUserService = $container->get("NewUserService");



        if ($controller == 'App\Controllers\ArticleIndexController') {
            $view = (new $controller($articleService, $newArticleService))->$method();
        }else if ($controller == 'App\Controllers\NewArticleController'){
            $view = (new $controller($newArticleService))->$method();
        }else{
            $view = (new $controller($newUserService))->$method();
        }

        if ($view) {
            $template = $twigConfig->twig()->load($view->getTemplatePath());
            echo $template->render($view->getData());
        }
        break;
}
