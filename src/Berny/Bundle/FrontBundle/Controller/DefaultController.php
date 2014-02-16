<?php

namespace Berny\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $form = $this->createForm('rnycc_urlshortener')->add('save', 'submit');

        if ($form->handleRequest($request) && $form->isSubmitted()) {
            return $this->redirect($this->generateUrl('berny_front_homepage'));
        }

        return $this->render('BernyFrontBundle:Default:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
