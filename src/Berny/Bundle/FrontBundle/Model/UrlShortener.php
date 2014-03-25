<?php

namespace Berny\Bundle\FrontBundle\Model;

interface UrlShortener
{
    public function shortenUrl(Url $url);
} 
