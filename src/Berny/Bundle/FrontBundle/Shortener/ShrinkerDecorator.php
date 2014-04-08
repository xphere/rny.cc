<?php

namespace Berny\Bundle\FrontBundle\Shortener;

use Berny\Bundle\FrontBundle\Model\Url;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\Selectable;

class ShrinkerDecorator extends Decorator
{
    /** @var Selectable */
    protected $selectable;

    public function setSelectable(Selectable $selectable)
    {
        $this->selectable = $selectable;
    }

    public function shortenUrl(Url $url)
    {
        $shorten = parent::shortenUrl($url);

        return $this->getShortestAvailable($shorten);
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
