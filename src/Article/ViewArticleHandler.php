<?php

namespace App\Article;

use App\Entity\Article;
use App\Entity\ArticleStat;
use Doctrine\Bundle\DoctrineBundle\Registry;

class ViewArticleHandler
{
    public function handle(Article $article)
    {
        // Appel le service de mise à jour de vue d'un article.
        // Log également un article stat avec pour action view.

    }
}
