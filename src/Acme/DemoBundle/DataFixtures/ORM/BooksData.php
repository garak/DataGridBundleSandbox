<?php

namespace Acme\DemoBundle\DataFixtures\ORM;

use Acme\DemoBundle\Entity\Book;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class BooksData extends AbstractFixture implements DependentFixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $comedy = new Book();
        $comedy
            ->setTitle('Divina Commedia')
            ->addAuthor($this->getReference('mickey'))
            ->addAuthor($this->getReference('goofy'))
        ;
        $manager->persist($comedy);
        
        $wp = new Book();
        $wp
            ->setTitle('War and Peace')
            ->addAuthor($this->getReference('mickey'))
        ;
        $manager->persist($wp);
        
        $g2tg = new Book();
        $g2tg
            ->setTitle('Guide to the Galaxy')
            ->addAuthor($this->getReference('daisy'))
        ;
        $manager->persist($g2tg);
        
        $manager->flush();
    }

    /**
     * {@inheritDoc}
     */
    public function getDependencies()
    {
        return array(
            'Acme\DemoBundle\DataFixtures\ORM\AuthorsData',
        );
    }
}
