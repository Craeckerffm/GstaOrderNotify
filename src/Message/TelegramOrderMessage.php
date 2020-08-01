<?php

namespace GstaOrderNotify\Message;

use Shopware\Core\Checkout\Cart\Event\CheckoutOrderPlacedEvent;

class TelegramOrderMessage extends AbstractOrderNotifyMessage
{

    private $botId;
    private $chatId;

    public function __construct(CheckoutOrderPlacedEvent $event,TelegramBotId $botId, TelegramChatId $chatId)
    {
        parent::__construct($event);
        $this->botId = $botId;
        $this->chatId = $chatId;
    }

    public function chatId(): string
    {
        return $this->chatId->fromString();
    }

    public function getMessageText(): string
    {
        return "Neue Bestellung von {$this->getCustomerName()} im Wert von {$this->getTotalPrice()}";
    }

    public function botId(): string
    {
        return $this->botId->fromString();
    }
}
