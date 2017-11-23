<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 23/11/2017
 * Time: 16:01
 */

namespace OC\PlatformBundle\DataFixture\ORM;


use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\PlatformBundle\Entity\Category;

class LoadCategory implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $names = array(
            'Développement Web',
            'Développement Mobile',
            'Graphisme',
            'Intégration',
            'Réseau'
        );

        foreach ($names as $name) {
            $category = new Category();
            $category->setName($name);

            $manager->persist($category);
        }

        $manager->flush();
    }
}