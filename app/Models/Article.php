<?php


namespace App\Models;


class Article
{


    private string $author;
    private string $title;
    private string $description;
    private string $url;
    private string $urlToImage;
    private string $publishedAt;
    private string $content;
    private string $source;
    private ?int $id;

    public function __construct(string $author, string $title, string $description, string $url = '', string $urlToImage = '', string $publishedAt = '', string $content = '', string $source = '', int $id = null)
    {


        $this->author = $author;
        $this->title = $title;
        $this->description=$description;
        $this->url=$url;
        $this->urlToImage=$urlToImage;
        $this->publishedAt=$publishedAt;
        $this->content=$content;
        $this->source = $source;
        $this->id = $id;
    }


    /**
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getUrlToImage(): string
    {
        return $this->urlToImage;
    }

    /**
     * @return string
     */
    public function getPublishedAt(): string
    {
        return date('Y-m-d h:i:s', strtotime($this->publishedAt));
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

}