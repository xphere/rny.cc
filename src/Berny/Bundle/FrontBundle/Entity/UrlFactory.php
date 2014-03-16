<?php

namespace Berny\Bundle\FrontBundle\Entity;

use Berny\Bundle\FrontBundle\Model\UrlFactory as UrlFactoryInterface;

class UrlFactory implements UrlFactoryInterface
{
    public function createUrl($url)
    {
        return new Url($url);
    }
}
