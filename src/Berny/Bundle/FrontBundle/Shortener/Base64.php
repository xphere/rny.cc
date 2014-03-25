<?php

namespace Berny\Bundle\FrontBundle\Shortener;

use Berny\Bundle\FrontBundle\Model\Url;
use Berny\Bundle\FrontBundle\Model\UrlShortener;

class Base64 implements UrlShortener
{
    public function shortenUrl(Url $url)
    {
        return base64_encode(md5($url->getUrl()));
    }
}
