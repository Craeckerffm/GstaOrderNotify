<?php declare(strict_types=1);

namespace GstaOrderNotify\MessageHandler;

use GstaOrderNotify\Message\OrderMessage;
use GstaOrderNotify\Service\TelegramService;
use Shopware\Core\Framework\MessageQueue\Handler\AbstractMessageHandler;

class TelegramHandler extends AbstractMessageHandler
{
    private $service;

    public function __construct(TelegramService $service)
    {
        $this->service = $service;
    }

    /**
     * @param OrderMessage $message
     */
    public function handle($message): void
    {
    $this->service->send($message);
    }

    public static function getHandledMessages(): iterable
    {
        return [OrderMessage::class];
    }
}
