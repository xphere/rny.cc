<?php

namespace Berny\Bundle\FrontBundle\Model;

class Url
{
    protected $url;
    protected $shortUrl;

    public function __construct($url, $shortUrl = null)
    {
        $this->url = (string) $url;
        $this->shortUrl = null === $shortUrl ? null : (string)$shortUrl;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getShortUrl()
    {
        return $this->shortUrl;
    }
}
