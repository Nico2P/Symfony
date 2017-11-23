<?php
// src/OC/PlatformBundle/Controller/AdvertController.php
namespace OC\PlatformBundle\Controller;


use OC\PlatformBundle\Entity\Advert;
use OC\PlatformBundle\Entity\AdvertSkill;
use OC\PlatformBundle\Entity\Application;
use OC\PlatformBundle\Entity\Image;
use OC\PlatformBundle\OCPlatformBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller
{
    public function indexAction($page)
    {
        //Test service
        // $mailer = $this->container->get('mailer');
        // Test service

        if ($page < 1) {
            throw new NotFoundHttpException('Page "' .$page. '"inexistante.');
        }

        $listAdverts = array(
            array(
                'title' => 'Recherche développeur Symfony',
                'id' => 1,
                'author' => 'Alexandre',
                'content' => "Nous recherchons un développeur Symfony débutant sur Lyon",
                'date' => new \DateTime()),
            array(
                'title' => 'Mission webmaster',
                'id' => 2,
                'author' => 'hugo',
                'content' => "Recherche webmaster",
                'date' => new \DateTime()),
            array(
                'title' => 'Stage webdesigner',
                'id' => 3,
                'author' => 'Mathieu',
                'content' => "stage webdesigner",
                'date' => new \DateTime()),

        );

        return $this->render('OCPlatformBundle:Advert:index.html.twig', array('listAdverts' => $listAdverts));
    }


    public function viewAction($id)
    {

        $em = $this->getDoctrine()->getManager();

        $advert = $em->getRepository('OCPlatformBundle:Advert')->find($id);

        if (null === $advert) {
            throw new NotFoundHttpException("L'annonce d'id" .$id." n'existe pas.");
        }

        $listApplications = $em->getRepository('OCPlatformBundle:Application')->findBy(array('advert' => $advert));

        $listAdvertSkills = $em->getRepository('OCPlatformBundle:AdvertSkill')->findBy(array('advert' => $advert));



        return $this->render('OCPlatformBundle:Advert:view.html.twig', array(
            'advert' => $advert,
            'listApplication' => $listApplications,
            'listAdvertSkills' => $listAdvertSkills
        ));
    }

    public function addAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $advert = new Advert();
        $advert->setTitle('Recherche développeur Symfony');
        $advert->setAuthor('Alexandre');
        $advert->setContent('Recherche développeur Symphony débutant sur lyon.');

        $listSkills = $em->getRepository('OCPlatformBundle:Skill')->findAll();

        foreach ($listSkills as $skill) {
            $advertSkill = new AdvertSkill();

            $advertSkill->setAdvert($advert);
            $advertSkill->setSkill($skill);
            $advertSkill->setLevel('Expert');

            $em->persist($advertSkill);
        }


        $em->persist($advert);
        $em->flush();

        if ($request->isMethod('POST')) {
            $request ->getSession()->addFlash()->add('notice', 'Annonce bien enregistée.');

            return $this->redirectToRoute('oc_platform_view',array('id' => $advert->getId()));
        }

        return $this->render('OCPlatformBundle:Advert:add.html.twig', array('advert' => $advert));
    }

    public function editAction ($id, Request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $advert = $em->getRepository('OCPlatformBundle:Advert')->find($id);

        if (null === $advert) {
            throw new  NotFoundHttpException("L'annonce d'id " .$id. " n'existe pas");
        }

        $listCategories = $em->getRepository('OCPlatformBundle:Category')->findAll();

        foreach ($listCategories as $category) {
            $advert->addCategory($category);
        }

        $em->flush();


        if ($request->isMethod('POST')) {
            $request->getSession()->addFlash->add('notice', 'Annonce bien modifiée');

            return $this->redirectToRoute('oc_platform_view', array ('id' => 5));
        }

        $advert = array(
            'title' => 'Recherche développeur Symfony',
            'id' => $id,
            'author' => 'Alexandre',
            'content' => "Nous recherchons un développeur Symfony débutant sur Lyon",
            'date' => new \DateTime()
        );

        return $this->render('OCPlatformBundle:Advert:edit.html.twig', array('advert' =>$advert));
    }

    public  function deleteAction($id)
    {
        // recuperation annonce et delete en bdd

        $em = $this->getDoctrine()->getManager();

        $advert = $em->getRepository('OCPlatformBundle:Advert')->find($id);

        if (null === $advert) {
            throw new  NotFoundHttpException("L'annonce d'id " .$id. " n'existe pas");
        }

        foreach ($advert->getCategories() as $category) {
            $advert->removeCategory($category);
        }

        $em->flush();

        return $this->render('OCPlatformBundle:Advert:delete.html.twig');
    }

    public function menuAction($limit)
    {
        $listAdverts = array(
            array('id' => 2, 'title' => 'Recherche développeur Symfony'),
            array('id' => 5, 'title' => 'Mission Webmaster'),
            array('id' => 9, 'title' => 'Stage Webdesingner')
        );

        return $this->render('OCPlatformBundle:Advert:menu.html.twig', array('listAdverts' => $listAdverts));

    }


}