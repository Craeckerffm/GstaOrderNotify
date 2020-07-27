<?php

namespace GstaOrderNotify\Message;

class EmailOrderMessage extends AbstractOrderNotifyMessage
{
    function getMessageText(): string
    {
        return "Neue Bestellung von {$this->getCustomerName()}";
    }

    function getSubject(): string
    {
        return "Neue Bestellung eingegangen";
    }
}
