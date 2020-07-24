<?php declare(strict_types=1);

namespace GstaOrderNotify\Subscriber;


use GstaOrderNotify\Message\OrderMessage;
use Shopware\Core\Checkout\Cart\Event\CheckoutOrderPlacedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Messenger\MessageBusInterface;


class OrderPlacedSubscriber implements EventSubscriberInterface
{
    private $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            CheckoutOrderPlacedEvent::class => 'onOrderPlaced',
        ];
    }

    public function onOrderPlaced(CheckoutOrderPlacedEvent $event)
    {
        $t = new OrderMessage($event);
        $this->bus->dispatch($t);
    }
}
