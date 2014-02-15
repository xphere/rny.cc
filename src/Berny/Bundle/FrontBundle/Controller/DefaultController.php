<?php

namespace Berny\Bundle\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('BernyFrontBundle:Default:index.html.twig');
    }
}
