<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 * @package App\Entity
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User implements UserInterface, \Serializable
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
    protected $email;

    /**
     * @var string
     * @ORM\Column()
     */
    protected $firstname;

    /**
     * @var string
     * @ORM\Column()
     */
    protected $lastname;

    /**
     * @var string
     * @ORM\Column()
     */
    protected $password;

    /**
     * @ORM\Column("boolean")
     */
    protected $isAuthor = false;

    /**
     * @ORM\ManyToOne(targetEntity="Article")
     */
    protected $articles;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }

    /**
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }

    /**
     * @return boolean
     */
    public function isIsAuthor()
    {
        return $this->isAuthor;
    }

    /**
     * @param boolean $isAuthor
     */
    public function setIsAuthor($isAuthor)
    {
        $this->isAuthor = $isAuthor;
    }

    /**
     * @return mixed
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * @param mixed $articles
     */
    public function setArticles($articles)
    {
        $this->articles = $articles;
    }

    // Fixme


    public function getRoles()
    {
        $roles = ['ROLE_USER'];

        if ($this->isIsAuthor()) {
            $roles[] = 'ROLE_AUTHOR';
        }

        return $roles;
    }

    public function getSalt()
    {
        return;
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
        return;
    }

    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->email,
            $this->firstname,
            $this->lastname,
            $this->isAuthor,
            $this->password,
        ));
    }

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->email,
            $this->firstname,
            $this->lastname,
            $this->isAuthor,
            $this->password,
        ) = unserialize($serialized);
    }

    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }
}
