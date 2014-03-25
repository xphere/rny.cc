<?php

namespace Berny\Bundle\FrontBundle\Entity\Listener;

use Berny\Bundle\FrontBundle\Entity\Url;
use Berny\Bundle\FrontBundle\Model\UrlShortener;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class UrlShortenerListener implements EventSubscriber
{
    /** @var UrlShortener */
    protected $shortener;

    public function getSubscribedEvents()
    {
        return [
            Events::postPersist,
        ];
    }

    public function __construct(UrlShortener $shortener)
    {
        $this->shortener = $shortener;
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        if ($entity instanceof Url) {
            $em = $args->getEntityManager();
            $metadata = $em->getClassMetadata('BernyFrontBundle:Url');
            if (null === $metadata->getFieldValue($entity, 'shortUrl')) {
                $value = $this->shortener->shortenUrl($entity);
                $metadata->setFieldValue($entity, 'shortUrl', $value);
                $em->persist($entity);
                $em->flush($entity);
            }
        }
    }
}
