<?php declare(strict_types=1);

namespace GstaOrderNotify\Subscriber;

use GstaOrderNotify\Service\DispatchHelper;
use Shopware\Core\Checkout\Cart\Event\CheckoutOrderPlacedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


class OrderPlacedSubscriber implements EventSubscriberInterface
{

    private $dispatchHelper;

    public function __construct(DispatchHelper $dispatchHelper)
    {
        $this->dispatchHelper = $dispatchHelper;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            CheckoutOrderPlacedEvent::class => 'onOrderPlaced',
        ];
    }

    public function onOrderPlaced(CheckoutOrderPlacedEvent $event)
    {
        $this->dispatchHelper->startDispatch($event);
    }
}
