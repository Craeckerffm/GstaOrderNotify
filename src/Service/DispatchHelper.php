<?php


namespace GstaOrderNotify\Service;


use GstaOrderNotify\Message\Email;
use GstaOrderNotify\Message\EmailOrderMessage;
use GstaOrderNotify\Message\MessageSubject;
use GstaOrderNotify\Message\TelegramBotId;
use GstaOrderNotify\Message\TelegramChatId;
use GstaOrderNotify\Message\TelegramOrderMessage;
use Shopware\Core\Checkout\Cart\Event\CheckoutOrderPlacedEvent;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Symfony\Component\Messenger\MessageBusInterface;

class DispatchHelper
{

    private $bus;
    private $systemConfig;

    public function __construct(MessageBusInterface $bus, SystemConfigService $systemConfig)
    {
        $this->bus = $bus;
        $this->systemConfig = $systemConfig;
    }

    /**
     * @param CheckoutOrderPlacedEvent $event
     */
    public function startDispatch($event)
    {
        $telegramChatId = new TelegramChatId($this->systemConfig->get("GstaOrderNotify.config.channelId"));
        $telegramBot = new TelegramBotId($this->systemConfig->get("GstaOrderNotify.config.botId"));
        $email = new Email($this->systemConfig->get("GstaOrderNotify.config.email"));
        $subject = new MessageSubject('Neue Bestellung');

        if ($this->systemConfig->get('GstaOrderNotify.config.telegramEnable')) {
            $this->bus->dispatch(new TelegramOrderMessage($event, $telegramBot, $telegramChatId));
        }

        if ($this->systemConfig->get('GstaOrderNotify.config.emailEnable')) {
            $this->bus->dispatch(new EmailOrderMessage($event, $email, $subject));
        }
    }
}
