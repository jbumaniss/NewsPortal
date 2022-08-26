<?php

use App\Models\User;
use App\Models\UserCollection;

test("NewsData Article collection  test", function () {
    $articles = new UserCollection([
        new User(
            "One",
            "John Lee",
            "Master",
            "www.code.com",
            "https",
            "https//image",
            "22-22-22",
            "Lorem"
        ),
        new User(
            "double",
            "John Smith",
            "Master",
            "//www.google.com",
            "http",
            "https//icon",
            "22-44-22",
            "LoremDolem"
        ),
        new User(
            "trouble",
            "John Lame",
            "Master",
            "//www.ape.com",
            "ftp",
            "https//avatar",
            "22-66-22",
            "LoremMolem"
        )
        ]);
    expect(count($articles->getArticles()))->toBe(3);
    expect($articles->getArticles()[1]->getTitle())->toBe("Master");
});


