<?php

namespace App\Controller;

use App\Article\CountViewUpdater;
use App\Article\NewArticleHandler;
use App\Article\UpdateArticleHandler;
use App\Article\ViewArticleHandler;
use App\Entity\Article;
use App\Form\ArticleType;
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
        return $this->render('entity/Article/show.html.twig', array('article' => $article));
    }

    /**
     * @Route(path="/new", name="article_new")
     */
    public function newAction(Request $request)
    {
        // Seul les auteurs doivent avoir access.

        $article = $this->get(\App\Entity\Article::class);
        $form = $this->createForm(MaterialType::class, $article);
        $em = $this->getDoctrine()->getManager();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $em->persist($article);
            $em->flush();
            return $this->redirect($this->generateUrl('article_show'));
        }
        return $this->render('entity/Article/new.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route(path="/update/{slug}", name="article_update")
     */
    public function updateAction()
    {
        // Seul les auteurs doivent avoir access.
        // Seul l'auteur de l'article peut le modifier
    }
}
