<?php

namespace App\Controller;

use App\Article\CountViewUpdater;
use App\Article\NewArticleHandler;
use App\Article\UpdateArticleHandler;
use App\Article\ViewArticleHandler;
use App\Entity\Article;
use App\Form\ArticleType;
use Doctrine\ORM\EntityManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route(path="/article")
 */
class ArticleController extends Controller
{
    /**
     * @Route(path="/show/{slug}", name="article_show")
     */
    public function showAction($slug)
    {
        $em = $this->getDoctrine()->getManager();
        $repo = $em->getRepository(Article::class);
        $article = $repo->find($slug);
        return $this->render('Article/show.html.twig', array('article' => $article));
    }

    /**
     * @Route(path="/new", name="article_new")
     */
    public function newAction(Request $request, NewArticleHandler $newArticleHandler)
    {
        // Seul les auteurs doivent avoir access.

        $article = $this->get(\App\Entity\Article::class);
        $form = $this->createForm(ArticleType::class, $article);
        $em = $this->getDoctrine()->getManager();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $user = $this->get('token')->getToken()->getUser();
            $newArticleHandler->handle($article,$user);
            $em->persist($article);
            $em->flush();
            return $this->redirect($this->generateUrl('article_show'));
        }
        return $this->render('Article/new.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route(path="/update/{slug}", name="article_update")
     */
    public function updateAction(Request $request, NewArticleHandler $newArticleHandler, $slug)
    {
        // Seul les auteurs doivent avoir access.
        // Seul l'auteur de l'article peut le modifier

        $article = $this->get(\App\Entity\Article::class)->findBy($slug);
        $form = $this->createForm(ArticleType::class, $article);
        $em = $this->getDoctrine()->getManager();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $user = $this->get('token')->getToken()->getUser();
            $newArticleHandler->handle($article,$user);
            $em->persist($article);
            $em->flush();
            return $this->redirect($this->generateUrl('article_show'));
        }
        return $this->render('Article/new.html.twig', array('form' => $form->createView()));
    }
}
