<?php

namespace App\Models;

class ArticleCollection
{
    private array $articles = [];

    public function __construct(array $articles)
    {
        foreach ($articles as $article) {
            $this->addArticle($article);
        }
    }
    public function addArticle(Article  $article): void
    {
        $this->articles[] = $article;
    }
    public function getArticles(): array
    {
       return $this->articles;
    }
}