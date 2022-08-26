<?php


namespace App\Repositories;

use App\Models\Article;
use App\Models\ArticleCollection;
use App\Services\StoreArticleServiceRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;

class NewsApiArticleRepository implements ArticleRepository
{

    public function requestArticles(): ArticleCollection
    {
        $urlOfHistory = $_ENV['BASE_URL'] . $_ENV["DESTINATION"];
        $response = [];


        $parametersOfHistory = [
            'category'=>$_ENV['CATEGORY'],
            'apiKey' => $_ENV['API_KEY'],
            'country' => $_ENV['COUNTRY']
        ];

        $qsForHistory = http_build_query($parametersOfHistory);

        $requestUrlForHistory = "$urlOfHistory?$qsForHistory";

        $client = new Client();

        try {
            $response = $client->request('GET', $requestUrlForHistory);
        } catch (ClientException $e) {
            echo 'Caught exception: ' . $e->getMessage() . "\n";
        } catch (GuzzleException $e) {
            echo $e;
        }
        $apiResponse = json_decode($response->getBody());

        $articles = [];
        foreach ($apiResponse->articles as $article){

        $articles[] = new Article(
            (string)$article->author,
            (string)$article->title,
            (string)$article->description,
            (string)$article->url,
            (string)$article->urlToImage,
            (string)date('Y-m-d h:i:s', strtotime($article->publishedAt)),
            (string)$article->content,
            (string)$article->source->name
        );
        }
        return new ArticleCollection($articles);
    }

    public function save(StoreArticleServiceRequest $newArticle): void
    {
        // TODO: Implement save() method.
    }
}