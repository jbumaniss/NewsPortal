<?php


namespace App\Repositories;


use App\Models\Article;
use App\Models\ArticleCollection;
use App\Services\StoreArticleServiceRequest;
use Doctrine\DBAL\Connection;


class NewArticleRepository implements ArticleRepository
{

    private function db (): Connection
    {
        $connectionParams = [
            'dbname' => $_ENV['DBNAME'],
            'user' => $_ENV['USER'],
            'password' => $_ENV['PASSWORD'],
            'host' => $_ENV['HOST'],
            'driver' => $_ENV['DRIVER'],
        ];
        return  \Doctrine\DBAL\DriverManager::getConnection($connectionParams);
    }

    public function requestArticles(): ArticleCollection
    {

        $conn = self::db();
        $queryBuilder = $conn->createQueryBuilder();
        $mySqlResponse = $queryBuilder->select('*')
            ->from('articles')
            ->fetchAllAssociative();

        $articles = [];
        foreach ($mySqlResponse as $article) {
            $articles[] = new Article(
                $article['author'],
                $article['title'],
                $article['description'],
                '/article/'.$article['id'],
                $article['urlToImage'],
                $article['created_at'],
                $article['content'],
                '',
                $article['id'],
            );
        }
        return new ArticleCollection($articles);
    }



    public function save(StoreArticleServiceRequest $newArticle): void
    {
        $author = $newArticle->getAuthor();
        $title = $newArticle->getTitle();
        $description = $newArticle->getDescription();
        $url = $newArticle->getUrl();
        $urlToImage = $newArticle->getUrlToImage();
        $content = $newArticle->getContent();

        $conn = self::db();
        $conn->insert('articles', [
            'author' => $author,
            'title' => $title,
            'description' => $description,
            'url' => $url,
            'urlToImage' => $urlToImage,
            'content' => $content
        ]);
    }

    public function update(StoreArticleServiceRequest $newArticle): void
    {

        //var_dump($newArticle->getAuthor());


        $author = $newArticle->getAuthor();
        $title = $newArticle->getTitle();
        $description = $newArticle->getDescription();
        $url = $newArticle->getUrl();
        $urlToImage = $newArticle->getUrlToImage();
        $content = $newArticle->getContent();
        $id = $_SESSION['currentArticleId'];

        $conn = self::db();


        $conn->update('articles', [
            'author' => $author,
            'title' => $title,
            'description' => $description,
            'url' => $url,
            'urlToImage' => $urlToImage,
            'content' => $content,
        ], ['id' => $id]);

    }

    public function destroy(int $id): void
    {

        $conn = self::db();

        //var_dump($id);

        $conn->delete('articles', ['id' => $id]);


    }


}