<?php declare(strict_types=1);

namespace GstaOrderNotify\Subscriber;


use GstaOrderNotify\Message\EmailOrderMessage;
use GstaOrderNotify\Message\TelegramOrderMessage;
use Shopware\Core\Checkout\Cart\Event\CheckoutOrderPlacedEvent;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\Messenger\MessageBusInterface;


class OrderPlacedSubscriber implements EventSubscriberInterface
{
    private $bus;
    private $systemConfig;

    public function __construct(MessageBusInterface $bus, SystemConfigService $systemConfig)
    {
        $this->bus = $bus;
        $this->systemConfig = $systemConfig;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            CheckoutOrderPlacedEvent::class => 'onOrderPlaced',
        ];
    }

    public function onOrderPlaced(CheckoutOrderPlacedEvent $event)
    {
        $config = new ParameterBag();
        $config->set('botId', $this->systemConfig->get("GstaOrderNotify.config.botId"));
        $config->set('channelId', $this->systemConfig->get("GstaOrderNotify.config.channelId"));

        $config->set('email', $this->systemConfig->get("GstaOrderNotify.config.email"));

        $this->bus->dispatch(new TelegramOrderMessage($event, $config));
        $this->bus->dispatch(new EmailOrderMessage($event, $config));
    }
}
