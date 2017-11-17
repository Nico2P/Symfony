<?php

namespace OC\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class CoreController extends Controller
{
    public function indexAction()
    {
        return $this->render('OCCoreBundle:core:index.html.twig');
    }

    public function contactAction(Request $request)
    {
        $session = $request->getSession();
        $session->getFlashBag()->add('info', 'page non disponible');

        return $this->redirectToRoute('oc_core_home');
    }
}
