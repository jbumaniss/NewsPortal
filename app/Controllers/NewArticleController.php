<?php


namespace App\Controllers;


use App\Services\NewArticleService;
use App\Services\StoreArticleServiceRequest;
use App\TemplateView;

class NewArticleController
{

    private NewArticleService $newArticleService;

    public function __construct(NewArticleService $newArticleService)
    {
        $this->newArticleService = $newArticleService;
    }


    public function create(): TemplateView
    {
        return new TemplateView("addArticle.view.html.twig", ['articles' => 'test']);
    }

    public function store(): void
    {
        $this->newArticleService
            ->executeSave(
                new StoreArticleServiceRequest(
                    $_POST["author"],
                    $_POST["title"],
                    $_POST["description"],
                    '',
                    $_POST["urlToImage"],
                    $_POST["content"],
                )
            );

        header('Location: /articles/create');
    }

    public function article(): TemplateView
    {
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        $idOfSelectedArticle = $uri[2];
        $selectedArticle = [];
        $createdArticles = $this->newArticleService->execute()->getArticles();
        foreach ($createdArticles as $article) {
            if ($article->getId() == $idOfSelectedArticle) {
                $selectedArticle[] = $article;
            }
        }

        return new TemplateView("article.view.html.twig", [
            'articles' => $selectedArticle
        ]);
    }

    public function edit(): TemplateView
    {
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        $idOfSelectedArticle = $uri[2];
        $selectedArticle = [];
        $createdArticles = $this->newArticleService->execute()->getArticles();
        foreach ($createdArticles as $article) {
            if ($article->getId() == $idOfSelectedArticle) {
                $selectedArticle[] = $article;
            }
        }


        return new TemplateView("edit.view.html.twig", [
            'articles' => $selectedArticle
        ]);
    }

    public function update(): void
    {
        $uri = explode('/', $_SERVER['REQUEST_URI']);
        $idOfSelectedArticle = $uri[2];
        $_SESSION['currentArticleId'] = $idOfSelectedArticle;

        $this->newArticleService
            ->executeUpdate(
                new StoreArticleServiceRequest(
                    $_POST["author"],
                    $_POST["title"],
                    $_POST["description"],
                    '',
                    $_POST["urlToImage"],
                    $_POST["content"],
                )
            );

        header('Location: /');
    }

    public function destroy(): void
    {
        if (isset($_POST['destroy'])) {
            $id = $_POST['id'];
            $this->newArticleService->executeDestroy($id);
            header('Location: /articles');
        }
    }

}
