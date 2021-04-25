<?php

namespace App\EventSubscriber\UpdatedAt;

use App\Entity\Category;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;

class CategorySubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityUpdatedEvent::class => ['setCategory'],
        ];
    }

    public function setCategory(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();

        
        if (!($entity instanceof Category)) {
            return;
        }

        $entity->setUpdatedAt(new \DateTime('Europe/Monaco'));
    }
}
