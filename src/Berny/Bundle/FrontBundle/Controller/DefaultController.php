<?php

namespace Berny\Bundle\FrontBundle\Controller;

use Berny\Bundle\FrontBundle\Entity;
use Berny\Bundle\FrontBundle\Model;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $form = $this->createForm('rnycc_urlshortener')->add('save', 'submit');

        if ($form->handleRequest($request)->isValid()) {
            $url = $this->get('rnycc.url_shortener.handler')->process($form);
            $this->addSuccessMessage($url);

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

    protected function addSuccessMessage(Model\Url $url)
    {
        $this->get('session')->getFlashBag()->add('success', $url);
    }
}
