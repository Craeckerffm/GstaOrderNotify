<?php declare(strict_types=1);

namespace GstaOrderNotify\Sender;

use GstaOrderNotify\Message\OrderMessage;
use Shopware\Core\Checkout\Cart\Event\CheckoutOrderPlacedEvent;
use Symfony\Component\Messenger\MessageBusInterface;


class Sender
{
    /*
     * @var MessageBusInterface
     */
    private $bus;

    public function __construct(MessageBusInterface $bus)
    {
        $this->bus = $bus;
    }

    public function startDispatch(CheckoutOrderPlacedEvent $event)
    {
        $message = new OrderMessage($event);
        $this->bus->dispatch($message);
    }

}
