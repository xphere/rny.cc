<?php

namespace Berny\Bundle\FrontBundle\Form;

use Symfony\Component\Form\FormInterface;

class UrlShortenerHandler
{
    public function process(FormInterface $form)
    {
        return $form->get('url')->getData();
    }
}
