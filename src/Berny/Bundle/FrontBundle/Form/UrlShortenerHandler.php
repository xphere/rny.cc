<?php

namespace Berny\Bundle\FrontBundle\Form;

use Berny\Bundle\FrontBundle\Model\UrlManager;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Selectable;
use Symfony\Component\Form\FormInterface;

class UrlShortenerHandler
{
    protected $manager;
    protected $selectable;

    public function __construct(UrlManager $manager, Selectable $selectable)
    {
        $this->manager = $manager;
        $this->selectable = $selectable;
    }

    public function process(FormInterface $form)
    {
        $plainUrl = $form->get('url')->getData();
        if ($url = $this->searchUrl($plainUrl)) {
            return $url;
        }

        return $this->manager->getShortenedUrl($plainUrl);
    }

    protected function searchUrl($plainUrl)
    {
        $criteria = Criteria::create();
        $criteria
            ->setMaxResults(1)
            ->where(
                $criteria->expr()
                    ->eq('url', $plainUrl)
            );
        $urls = $this->selectable->matching($criteria);

        return $urls->isEmpty() ? null : $urls->first();
    }
}
