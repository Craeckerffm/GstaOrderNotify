<?php

namespace GstaOrderNotify\Message;

use Shopware\Core\Checkout\Cart\Event\CheckoutOrderPlacedEvent;
use Shopware\Core\Framework\Context;
use Symfony\Component\HttpFoundation\ParameterBag;


abstract class AbstractOrderNotifyMessage
{
    private $order;
    private $event;
    protected $configService;

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

    public function getContext(): Context
    {
        return $this->event->getContext();
    }

    public function getSalesChannelId()
    {
        return $this->event->getSalesChannelId();
    }


    abstract function getMessageText(): string;

}
