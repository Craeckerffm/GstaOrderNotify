<?php

namespace GstaOrderNotify\Message;

class TelegramOrderMessage extends AbstractOrderNotifyMessage
{
    function getMessageText(): string
    {
       return "Neue Bestellung von {$this->getCustomerName()} im Wert von {$this->getTotalPrice()}";
    }
}
