<?php
/**
 * Created by PhpStorm.
 * User: Nico
 * Date: 04/12/2017
 * Time: 13:31
 */

namespace OC\PlatformBundle\Purger;

use Doctrine\ORM\EntityManagerInterface;


class AdvertPurger
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function purge($days)
    {
        $advertRepository = $this->em->getRepository('OCPlatformBundle:Advert');
        $advertSkillRepository = $this->em->getRepository('OCPlatformBundle:AdvertSkill');

        $date = new \DateTime($days. ' days ago');

        $listAdverts = $advertRepository->getAdvertBefore($date);

        foreach ($listAdverts as $advert) {
            $advertSkills = $advertRepository->findBy(array('advert' => $advert));

            foreach ($advertSkills as $advertSkill) {
                $this->em->remove($advertSkill);
            }

            $this->em->remove($advert);
        }
        $this->em->flush();
    }

}