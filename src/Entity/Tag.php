<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Tag
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="tag")
 */
class Tag
{
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
    protected $name;
    /**
     * @var string
     * @ORM\Column()
     */
    protected $slug;

    /**
     * Tag constructor.
     * @param string $name
     * @param string $slug
     */
    public function __construct($name, $slug)
    {
        $this->name = $name;
        $this->slug = $slug;
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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }



    // Uniquement des getter et un constructeur
}
