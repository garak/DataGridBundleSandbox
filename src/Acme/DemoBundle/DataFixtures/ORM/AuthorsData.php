<?php

namespace Acme\DemoBundle\DataFixtures\ORM;

use Acme\DemoBundle\Entity\Author;
use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;

class AuthorsData extends AbstractFixture
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $mickey = new Author();
        $mickey->setName('Mickey');
        $manager->persist($mickey);
        $this->addReference('mickey', $mickey);
        
        $goofy = new Author();
        $goofy->setName('Goofy');
        $manager->persist($goofy);
        $this->addReference('goofy', $goofy);
        
        $donald = new Author();
        $donald->setName('Donald');
        $manager->persist($donald);
        $this->addReference('donald', $donald);
        
        $daisy = new Author();
        $daisy->setName('Daisy');
        $manager->persist($daisy);
        $this->addReference('daisy', $daisy);

        $manager->flush();
    }
}
