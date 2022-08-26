<?php

namespace App\Extensions\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AssetExtension extends AbstractExtension
{
    public function getFunctions(): array
    {
        return [
            new TwigFunction('setCat',[$this, 'setCategory'])
        ];
    }

    public function setCategory(string $path): void
    {
        $_ENV['CATEGORY'] = $path;
    }
}