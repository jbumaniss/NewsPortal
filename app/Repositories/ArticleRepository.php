<?php

namespace App\Repositories;

use App\Models\ArticleCollection;
use App\Services\StoreArticleServiceRequest;


interface ArticleRepository
{
public function requestArticles(): ArticleCollection;
public function save(StoreArticleServiceRequest $newArticle): void;
}
