<?php

namespace Berny\Bundle\FrontBundle\Model;

use Doctrine\Common\Persistence\ObjectManager;

class UrlManager
{
    protected $om;
    protected $factory;

    public function __construct(ObjectManager $objectManager, UrlFactory $factory)
    {
        $this->om = $objectManager;
        $this->factory = $factory;
    }

    public function getShortenedUrl($uriString)
    {
        $url = $this->factory->createUrl($uriString);
        $this->om->persist($url);
        $this->om->flush($url);

        return $url;
    }
}
