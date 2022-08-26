<?php


namespace App\Services;


use App\Models\ArticleCollection;
use App\Repositories\NewArticleRepository;

class NewArticleService
{
    private NewArticleRepository $newArticleRepository;


    public function __construct(NewArticleRepository $newArticleRepository)
    {
        $this->newArticleRepository = $newArticleRepository;
    }

    public function execute(): ArticleCollection
    {

            return $this->newArticleRepository->requestArticles();

    }
    public function executeSave (StoreArticleServiceRequest $request):void
    {

        $this->newArticleRepository->save($request);

    }

    public function executeUpdate (StoreArticleServiceRequest $request):void
    {

        $this->newArticleRepository->update($request);

    }

    public function executeDestroy (int $id):void
    {

        $this->newArticleRepository->destroy($id);

    }

}
