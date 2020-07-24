<?php

namespace GstaOrderNotify\Message;

use Shopware\Core\Checkout\Cart\Event\CheckoutOrderPlacedEvent;
use Shopware\Core\Framework\Context;
use Shopware\Core\System\SystemConfig\SystemConfigService;


abstract class AbstractOrderNotifyMessage
{
    private $order;
    private $event;
    protected $senderConfig;
    protected $configService;

    public function __construct(CheckoutOrderPlacedEvent $event, SystemConfigService $configService)
    {
        $this->order = $event->getOrder();
        $this->event = $event;
        $this->configService = $configService;
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

    abstract function setConfig(): array;

    public function getConfig(): array
    {
        return $this->senderConfig;
    }

}
