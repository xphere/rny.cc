<?php

namespace Berny\Bundle\FrontBundle\Shortener;

use Berny\Bundle\FrontBundle\Model\Url;
use Berny\Bundle\FrontBundle\Model\UrlShortener;

class Decorator implements UrlShortener
{
    /** @var UrlShortener */
    protected $inner;

    public function __construct(UrlShortener $shortener)
    {
        $this->inner = $shortener;
    }

    public function shortenUrl(Url $url)
    {
        return $this->inner->shortenUrl($url);
    }
}
