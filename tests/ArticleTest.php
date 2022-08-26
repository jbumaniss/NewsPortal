<?php

use App\Models\Article;

test("NewsData Article model test", function () {
    $article = new Article(
        "2022-07-22 17:00",
        "John Lee",
        "Master",
        "//www.google.com/imgres?imgurl=https%3A%2F%2Fcdn-icons-png.flaticon.com%2F512%2F1354%2F1354217.png&imgrefurl=https%3A%2F%2Fwww.flaticon.com%2Fpremium-icon%2Ftesting_1354217&tbnid=UXlKlh_DmCydAM&vet=12ahUKEwjr4cfV0oz5AhVtx4sKHSB5ApgQMygAegUIARCjAQ..i&docid=m1HRYiJIL59G5M&w=512&h=512&q=icon%20url%20for%20testing&ved=2ahUKEwjr4cfV0oz5AhVtx4sKHSB5ApgQMygAegUIARCjAQ",
        "https",
        "https//image",
        "22-22-22",
        "Lorem"
    );
    expect($article->getSource())->toBe("2022-07-22 17:00")
        ->and($article->getAuthor())->toBe("John Lee")
        ->and($article->getTitle())->toBe("Master")
        ->and($article->getDescription())->toBe(
            "//www.google.com/imgres?imgurl=https%3A%2F%2Fcdn-icons-png.flaticon.com%2F512%2F1354%2F1354217.png&imgrefurl=https%3A%2F%2Fwww.flaticon.com%2Fpremium-icon%2Ftesting_1354217&tbnid=UXlKlh_DmCydAM&vet=12ahUKEwjr4cfV0oz5AhVtx4sKHSB5ApgQMygAegUIARCjAQ..i&docid=m1HRYiJIL59G5M&w=512&h=512&q=icon%20url%20for%20testing&ved=2ahUKEwjr4cfV0oz5AhVtx4sKHSB5ApgQMygAegUIARCjAQ"
        )
        ->and($article->getUrl())->toBe("https")
        ->and($article->getUrlToImage())->toBe("https//image")
        ->and($article->getPublishedAt())->toBe("22-22-22")
        ->and($article->getContent())->toBe("Lorem");
});