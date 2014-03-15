<?php

namespace Berny\Bundle\FrontBundle\Form;

use Berny\Bundle\FrontBundle\Model\UrlManager;
use Symfony\Component\Form\FormInterface;

class UrlShortenerHandler
{
    protected $manager;

    public function __construct(UrlManager $manager)
    {
        $this->manager = $manager;
    }

    public function process(FormInterface $form)
    {
        $plainUrl = $form->get('url')->getData();

        return $this->manager->getShortenedUrl($plainUrl);
    }
}
