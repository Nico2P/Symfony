<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 23/11/2017
 * Time: 17:17
 */

namespace OC\PlatformBundle\DataFixture\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use OC\PlatformBundle\Entity\Skill;

class LoadSkill implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $names = array('PHP', 'Symfony', 'C++', 'Java', 'Photoshop', 'Blender', 'Bloc-note');

        foreach ($names as $name) {
            $skill = new Skill();
            $skill->setName($name);

            $manager->persist($skill);
        }

        $manager->flush();
    }
}