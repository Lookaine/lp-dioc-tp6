<?php

namespace App\Article;

use App\Entity\Article;
use App\Entity\ArticleStat;
use App\Slug\SlugGenerator;

class UpdateArticleHandler
{
    public function handle(Article $article)
    {
        // Slugify le titre et met à jour la date de mise à jour de l'article
        // Log également un article stat avec pour action update.

        $slugGenerator = New SlugGenerator();
        $articestatslogger = new ArticleStatsLogger();
        $slug = ($slugGenerator->generate($article->getTitle()));
        $article->setSlug($slug);

        $article->setUpdatedAt(new \DateTime());
        $articestatslogger->log($article,"update");

    }
}
