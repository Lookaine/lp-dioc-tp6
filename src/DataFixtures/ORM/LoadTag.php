<?php

namespace App\DataFixtures\ORM;

use App\Entity\Tag;
use App\Slug\SlugGenerator;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTag extends Fixture
{

    private $slugify;

    public function load(ObjectManager $manager)
    {
        $this->slugify = new SlugGenerator();
        $tags= [
            new Tag("nicolas", $this->slugify->generate("nicolas")),
            new Tag("jean", $this->slugify->generate("jean")),
            new Tag("maxime", $this->slugify->generate("maxime"))

        ];

        foreach ($tags as $tag) {
            $this->addReference($tag->getName(), $tag);
            $manager->persist($tag);
        }


        $manager->flush();
    }
}
