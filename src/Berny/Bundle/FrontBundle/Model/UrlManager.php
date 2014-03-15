<?php

namespace Berny\Bundle\FrontBundle\Model;

use Doctrine\Common\Persistence\ObjectManager;

class UrlManager
{
    protected $om;

    public function __construct(ObjectManager $objectManager)
    {
        $this->om = $objectManager;
    }

    public function getShortenedUrl($uriString)
    {
        $url = new Url($uriString);
        $this->om->persist($url);
        $this->om->flush($url);

        return $url;
    }
}
