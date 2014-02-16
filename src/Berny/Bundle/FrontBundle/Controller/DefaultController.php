<?php

namespace Berny\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $form = $this->createForm('rnycc_urlshortener');
        $form->add('save', 'submit');

        return $this->render('BernyFrontBundle:Default:index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
