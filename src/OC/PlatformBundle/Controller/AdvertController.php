<?php
// src/OC/PlatformBundle/Controller/AdvertController.php
namespace OC\PlatformBundle\Controller;


use OC\PlatformBundle\OCPlatformBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class AdvertController extends Controller
{
    public function indexAction($page)
    {


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
        $advert = array(
            'title' => 'Recherche développeur Symfony',
            'id' => $id,
            'author' => 'Alexandre',
            'content' => "Nous recherchons un développeur Symfony débutant sur Lyon",
            'date' => new \DateTime()
        );
        return $this->render('OCPlatformBundle:Advert:view.html.twig', array('advert' => $advert));
    }

    public function addAction(Request $request)
    {
        if ($request->isMethod('POST')) {
            $request ->getSession()->addFlash()->add('notice', 'Annonce bien enregistée.');

            return $this->redirectToRoute('oc_platform_view',array('id' => 5));
        }

        return $this->render('OCPlatformBundle:Advert:add.html.twig');
    }

    public function editAction ($id, Request $request)
    {
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