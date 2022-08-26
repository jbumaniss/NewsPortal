<?php


namespace App\Services;

use App\Models\ArticleCollection;
use App\Repositories\ArticleRepository;

class ArticlesService
{
    private ArticleRepository $articleRepository;

    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    public function execute(): ArticleCollection
    {
        return $this->articleRepository->requestArticles();
    }

}
