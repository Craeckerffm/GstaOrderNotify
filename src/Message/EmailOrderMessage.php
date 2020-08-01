<?php

namespace GstaOrderNotify\Message;

use Shopware\Core\Checkout\Cart\Event\CheckoutOrderPlacedEvent;

class EmailOrderMessage extends AbstractOrderNotifyMessage
{
    private $email;
    private $subject;

    public function __construct(CheckoutOrderPlacedEvent $event, Email $email, MessageSubject $subject)
    {
        parent::__construct($event);
        $this->email = $email;
        $this->subject = $subject;
    }

    public function getMessageText(): string
    {
        return "Neue Bestellung von {$this->getCustomerName()}";
    }

    public function getEmail():string
    {
        return $this->email->asString();
    }

    public function getSubject():string
    {
        return $this->subject->toString();
    }


}
