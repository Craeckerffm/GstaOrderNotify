<?php


namespace GstaOrderNotify\Service;


use GstaOrderNotify\Message\EmailOrderMessage;
use GstaOrderNotify\Message\TelegramOrderMessage;
use Shopware\Core\Checkout\Cart\Event\CheckoutOrderPlacedEvent;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Symfony\Component\HttpFoundation\ParameterBag;
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
    public function dispatch($event)
    {
        $config = new ParameterBag();
        $config->set('botId', $this->systemConfig->get("GstaOrderNotify.config.botId"));
        $config->set('channelId', $this->systemConfig->get("GstaOrderNotify.config.channelId"));

        $config->set('email', $this->systemConfig->get("GstaOrderNotify.config.email"));

        if ($this->systemConfig->get('GstaOrderNotify.config.telegramEnable')) $this->bus->dispatch(new TelegramOrderMessage($event, $config));
        if ($this->systemConfig->get('GstaOrderNotify.config.emailEnable')) $this->bus->dispatch(new EmailOrderMessage($event, $config));
    }
}
