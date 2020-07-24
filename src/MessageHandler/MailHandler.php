<?php declare(strict_types=1);

namespace GstaOrderNotify\MessageHandler;
use GstaOrderNotify\Message\OrderMessage;
use GstaOrderNotify\Service\EmailService;
use Monolog\Logger;
use Shopware\Core\Framework\MessageQueue\Handler\AbstractMessageHandler;

class MailHandler extends AbstractMessageHandler
{
    private $service;
    private $logger;

    public function __construct(EmailService $service, Logger $logger)
    {
        $this->service = $service;
        $this->logger = $logger;
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
