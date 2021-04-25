<?php

namespace App\EventSubscriber\UpdatedAt;

use App\Entity\Session;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;

class SessionSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityUpdatedEvent::class => ['setSession'],
        ];
    }

    public function setSession(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();

        
        if (!($entity instanceof Session)) {
            return;
        }

        $entity->setUpdatedAt(new \DateTime('Europe/Monaco'));
    }
}
