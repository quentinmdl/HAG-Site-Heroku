<?php

namespace App\EventSubscriber\UpdatedAt;

use App\Entity\Article;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;

class ArticleSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityUpdatedEvent::class => ['setArticle'],
        ];
    }

    public function setArticle(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();
        
        if (!($entity instanceof Article)) {
            return;
        }

        $entity->setUpdatedAt(new \DateTime('Europe/Monaco'));
    }
}
