<?php declare(strict_types=1);

namespace GstaOrderNotify\Subscriber;

use GstaOrderNotify\Message\OrderMessage;
use GstaOrderNotify\Sender\Sender;
use Shopware\Core\Checkout\Cart\Event\CheckoutOrderPlacedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;



class OrderPlacedSubscriber implements EventSubscriberInterface
{
    private $sender;
    public function __construct(Sender $sender)
    {
        $this->sender = $sender;
    }

    public static function getSubscribedEvents() : array
    {
        return [
         CheckoutOrderPlacedEvent::class => 'onOrderPlaced'
        ];
    }
    public function onOrderPlaced(CheckoutOrderPlacedEvent $event){

      $this->sender->startDispatch($event);
    }
}
