<?php

namespace App\Article;

use App\Entity\Article;
use App\Entity\ArticleStat;
use App\Entity\User;
use App\Slug\SlugGenerator;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class NewArticleHandler
{
    public function handle(Article $article, User $user): void
    {

        // Slugify le titre et ajoute l'utilisateur courant comme auteur de l'article
        // Log également un article stat avec pour action create.
        $slugGenerator = New SlugGenerator();
        $articlelog = new ArticleStatsLogger();
        $slug = ($slugGenerator->generate($article->getTitle()));
        $article->setSlug($slug);
        $article->setAuthor($user);
        $article->setCreatedAt(new \DateTime());
        $article->setUpdatedAt(new \DateTime());
        $articlelog->log($article,"create");

    }
}
