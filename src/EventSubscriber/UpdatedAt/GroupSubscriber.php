<?php

namespace App\EventSubscriber\UpdatedAt;

use App\Entity\Group;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;

class GroupSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityUpdatedEvent::class => ['setGroup'],
        ];
    }

    public function setGroup(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();

        
        if (!($entity instanceof Group)) {
            return;
        }

        $entity->setUpdatedAt(new \DateTime('Europe/Monaco'));
    }
}
