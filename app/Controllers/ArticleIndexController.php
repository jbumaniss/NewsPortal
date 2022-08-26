<?php

namespace App\Controllers;


use App\Services\ArticlesService;
use App\Services\NewArticleService;
use App\TemplateView;

class ArticleIndexController
{
    private ArticlesService $service;
    private NewArticleService $newArticleService;

    public function __construct(ArticlesService $articlesService, NewArticleService $newArticleService)
    {
        $this->newArticleService = $newArticleService;
        $this->service = $articlesService;
    }

    public function index(): TemplateView
    {
        $api = $this->service->execute()->getArticles();
        $new = $this->newArticleService->execute()->getArticles();
        $articles = array_merge($new, $api);

        return new TemplateView("index.view.html.twig", [
            'articles' => $articles,
            'categoryName' => $_ENV['CATEGORY'],
            'user' => $_SESSION['user']
        ]);
    }

    public function articles(): TemplateView
    {
        $api = $this->service->execute()->getArticles();
        $new = $this->newArticleService->execute()->getArticles();
        $articles = array_merge($new, $api);

        return new TemplateView("articles.view.html.twig", [
            'articles' => $articles,
            'categoryName' => $_ENV['CATEGORY']
        ]);
    }


    public function contacts(): TemplateView
    {
        return new TemplateView("contacts.view.html.twig", ['articles' => $this->service->execute()->getArticles()]);
    }


    public function entertainment(): TemplateView
    {
        $_ENV['CATEGORY'] = 'entertainment';
        $api = $this->service->execute()->getArticles();
        $new = $this->newArticleService->execute()->getArticles();
        $articles = array_merge($new, $api);

        return new TemplateView("articles.view.html.twig", [
            'articles' => $articles,
            'categoryName' => $_ENV['CATEGORY']
        ]);
    }

    public function business(): TemplateView
    {
        $_ENV['CATEGORY'] = 'business';
        $api = $this->service->execute()->getArticles();
        $new = $this->newArticleService->execute()->getArticles();
        $articles = array_merge($new, $api);

        return new TemplateView("articles.view.html.twig", [
            'articles' => $articles,
            'categoryName' => $_ENV['CATEGORY']
        ]);
    }

    public function science(): TemplateView
    {
        $_ENV['CATEGORY'] = 'science';
        $api = $this->service->execute()->getArticles();
        $new = $this->newArticleService->execute()->getArticles();
        $articles = array_merge($new, $api);

        return new TemplateView("articles.view.html.twig", [
            'articles' => $articles,
            'categoryName' => $_ENV['CATEGORY']
        ]);
    }

    public function health(): TemplateView
    {
        $_ENV['CATEGORY'] = 'health';
        $api = $this->service->execute()->getArticles();
        $new = $this->newArticleService->execute()->getArticles();
        $articles = array_merge($new, $api);

        return new TemplateView("articles.view.html.twig", [
            'articles' => $articles,
            'categoryName' => $_ENV['CATEGORY']
        ]);
    }

    public function sports(): TemplateView
    {
        $_ENV['CATEGORY'] = 'sports';
        $api = $this->service->execute()->getArticles();
        $new = $this->newArticleService->execute()->getArticles();
        $articles = array_merge($new, $api);

        return new TemplateView("articles.view.html.twig", [
            'articles' => $articles,
            'categoryName' => $_ENV['CATEGORY']
        ]);
    }

    public function technology(): TemplateView
    {
        $_ENV['CATEGORY'] = 'technology';
        $api = $this->service->execute()->getArticles();
        $new = $this->newArticleService->execute()->getArticles();
        $articles = array_merge($new, $api);

        return new TemplateView("articles.view.html.twig", [
            'articles' => $articles,
            'categoryName' => $_ENV['CATEGORY']
        ]);
    }


}
