<?php

namespace App\EventSubscriber\UpdatedAt;

use App\Entity\Challenge;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;

class ChallengeSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityUpdatedEvent::class => ['setChallenge'],
        ];
    }

    public function setChallenge(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();

        
        if (!($entity instanceof Challenge)) {
            return;
        }

        $entity->setUpdatedAt(new \DateTime('Europe/Monaco'));
    }
}
