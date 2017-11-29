<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class ArticleStat
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="articleStat")
 */
class ArticleStat
{
    const CREATE = 'create';
    const UPDATE = 'update';
    const VIEW = 'view';

    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    /**
     * @var string
     * @ORM\Column()
     */
    protected $action;

    /**
     * @ORM\OneToMany(targetEntity="Article", mappedBy="articleStat", cascade={"persist"})
     */
    protected $article;

    /**
     * @ORM\Column("DateTime")
     */
    protected $date;

    /**
     * @ORM\Column("integer")
     */
    protected $ip;

    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="articleStat", cascade={"persist"})
     */
    protected $user;

    /**
     * ArticleStat constructor.
     * @param string $action
     * @param $article
     * @param $date
     */
    public function __construct($action, $article, $date)
    {
        $this->action = $action;
        $this->article = $article;
        $this->date = $date;
    }


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @return mixed
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @return int
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }



    // Uniquement des getter et un constructeur
}
