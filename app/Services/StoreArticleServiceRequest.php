<?php

namespace App\Services;

class StoreArticleServiceRequest
{
    private string $author;
    private string $title;
    private string $description;
    private string $url;
    private string $urlToImage;
    private string $content;
    private int $id;

    public function __construct(
        string $author,
        string $title,
        string $description,
        string $url,
        string $urlToImage,
        string $content,
        int $id = null
    ) {
        $this->author = $author;
        $this->title = $title;
        $this->description = $description;
        $this->url = $url;
        $this->urlToImage = $urlToImage;
        $this->content = $content;
    }


    public function getAuthor(): string
    {
        return $this->author;
    }


    public function getTitle(): string
    {
        return $this->title;
    }


    public function getDescription(): string
    {
        return $this->description;
    }


    public function getUrl(): string
    {
        return $this->url;
    }


    public function getUrlToImage(): string
    {
        return $this->urlToImage;
    }



    public function getContent(): string
    {
        return $this->content;
    }


    public function getId(): int
    {
        return $this->id;
    }
}