<?php

namespace GstaOrderNotify\Message;

use Shopware\Core\Checkout\Cart\Event\CheckoutOrderPlacedEvent;

class OrderMessage
{
    private $content;
   public function __construct(CheckoutOrderPlacedEvent $event)
   {
       $this->content = $event;
   }
   public function getOrderMessage():CheckoutOrderPlacedEvent
   {
       return $this->content;
   }

   public function getCustomerName():string
   {
       return $this->content->getOrder()->getOrderCustomer()->getLastName();
   }

    public function getOrderItems():float
    {
        return $this->content->getOrder()->getPrice()->getTotalPrice();
    }

    public function getOrderDate():float
    {
        return $this->content->getOrder()->getOrderDate()->format('Y-m-d H:i:s');
    }
}
