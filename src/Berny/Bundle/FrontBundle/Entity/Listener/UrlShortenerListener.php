<?php

namespace Berny\Bundle\FrontBundle\Entity\Listener;

use Berny\Bundle\FrontBundle\Entity\Url;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class UrlShortenerListener implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return [
            Events::postPersist,
        ];
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getObject();
        if ($entity instanceof Url) {
            $em = $args->getEntityManager();
            $metadata = $em->getClassMetadata('BernyFrontBundle:Url');
            if (null === $metadata->getFieldValue($entity, 'shortUrl')) {
                $value = md5($entity->getUrl());
                $metadata->setFieldValue($entity, 'shortUrl', $value);
                $em->persist($entity);
                $em->flush($entity);
            }
        }
    }
}
