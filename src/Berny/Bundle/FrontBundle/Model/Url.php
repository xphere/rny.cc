<?php

namespace Berny\Bundle\FrontBundle\Model;

class Url
{
    protected $url;

    public function __construct($url)
    {
        $this->url = (string) $url;
    }

    public function getUrl()
    {
        return $this->url;
    }
}
