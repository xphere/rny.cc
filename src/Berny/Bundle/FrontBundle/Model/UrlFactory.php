<?php

namespace Berny\Bundle\FrontBundle\Model;

interface UrlFactory
{
    /**
     * @param string $url
     *
     * @return Url
     */
    public function createUrl($url);
}
