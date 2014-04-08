<?php

namespace Berny\Bundle\FrontBundle\Shortener;

use Berny\Bundle\FrontBundle\Model\Url;
use Berny\Bundle\FrontBundle\Model\UrlShortener;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Selectable;

class Shrinker implements UrlShortener
{
    /** @var UrlShortener */
    protected $innerShortener;
    /** @var Selectable */
    protected $selectable;

    public function __construct(UrlShortener $shortener)
    {
        $this->innerShortener = $shortener;
    }

    public function setSelectable(Selectable $selectable)
    {
        $this->selectable = $selectable;
    }

    public function shortenUrl(Url $url)
    {
        $value = $this->innerShortener->shortenUrl($url);

        return $this->getShortestAvailable($value);
    }

    protected function getShortestAvailable($shortUrl)
    {
        $criteria = Criteria::create();
        $criteria->where(
            $criteria->expr()
                ->in('shortUrl', $this->getAllPrefixes($shortUrl))
        );
        $length = $this->selectable->matching($criteria)->count();

        return substr($shortUrl, 0, $length + 1);
    }

    protected function getAllPrefixes($value)
    {
        $soFar = '';
        $result = [];
        foreach (str_split($value) as $char) {
            $soFar .= $char;
            $result[] = $soFar;
        }

        return $result;
    }
}
