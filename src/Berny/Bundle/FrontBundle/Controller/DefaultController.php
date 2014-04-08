<?php

namespace Berny\Bundle\FrontBundle\Controller;

use Berny\Bundle\FrontBundle\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $form = $this->createForm('rnycc_urlshortener')->add('save', 'submit');

        if ($form->handleRequest($request)->isValid()) {
            $url = $this->get('rnycc.url_shortener.handler')->process($form);

            return $this->redirect($this->generateUrl('rnycc_frontpage'));
        }

        return $this->render('BernyFrontBundle:Default:index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    public function redirectAction(Entity\Url $url)
    {
        return $this->redirect($url->getUrl());
    }
}
