<?php

namespace GstaOrderNotify\Message;

use DateTimeInterface;
use Shopware\Core\Checkout\Cart\Event\CheckoutOrderPlacedEvent;
use Shopware\Core\Framework\Context;

class OrderMessage
{
    private $order;
    private $event;

    public function __construct(CheckoutOrderPlacedEvent $event)
    {
        $this->order = $event->getOrder();
        $this->event = $event;
    }

    public function getCustomerName(): string
    {
        return $this->order->getOrderCustomer()->getLastName();
    }

    public function getTotalPrice(): float
    {
        return $this->order->getPrice()->getTotalPrice();
    }

    public function getOrderDate(): DateTimeInterface
    {
        return $this->order->getOrderDateTime();
    }
    public function getContext(): Context
    {
        return $this->event->getContext();
    }
    public function getSalesChannelId()
    {
        return $this->event->getSalesChannelId();
    }
}
