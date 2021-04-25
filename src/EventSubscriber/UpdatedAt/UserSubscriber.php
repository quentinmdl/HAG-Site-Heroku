<?php

namespace App\EventSubscriber\UpdatedAt;

use App\Entity\User;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;

class UserSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityUpdatedEvent::class => ['setUser'],
        ];
    }

    public function setUser(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();

        
        if (!($entity instanceof User)) {
            return;
        }

        $entity->setUpdatedAt(new \DateTime('Europe/Monaco'));
    }
}
