<?php

namespace Berny\Bundle\FrontBundle\Shortener;

use Berny\Bundle\FrontBundle\Model\Url;
use Berny\Bundle\FrontBundle\Model\UrlShortener;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\EntityManager;

class Shrinker implements UrlShortener
{
    /** @var EntityManager */
    protected $em;
    /** @var UrlShortener */
    protected $innerShortener;

    public function __construct(EntityManager $em, UrlShortener $shortener)
    {
        $this->em = $em;
        $this->innerShortener = $shortener;
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
        $length = $this->em->getRepository('BernyFrontBundle:Url')->matching($criteria)->count();

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
