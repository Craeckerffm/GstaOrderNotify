<?php declare(strict_types=1);

namespace GstaOrderNotify\MessageHandler;

use GstaOrderNotify\Message\EmailOrderMessage;
use GstaOrderNotify\Message\TelegramOrderMessage;
use GstaOrderNotify\Service\EmailSender;
use GstaOrderNotify\Service\TelegramSender;
use Shopware\Core\Framework\MessageQueue\Handler\AbstractMessageHandler;

class OrderMessageHandler extends AbstractMessageHandler
{
    private $emailSender;
    private $telegramSender;

    public function __construct(TelegramSender $telegramSender, EmailSender $emailSender)
    {
        $this->telegramSender = $telegramSender;
        $this->emailSender = $emailSender;
    }

    public function handle($message): void
    {
    }

    /**
     * @param TelegramOrderMessage $message
     */
    public function sendTelegram($message)
    {
        $this->telegramSender->send($message);
    }

    /**
     * @param EmailOrderMessage $message
     */
    public function sendEmail($message){
        $this->emailSender->send($message);
    }

    public static function getHandledMessages(): iterable
    {
        yield TelegramOrderMessage::class => ['method' => 'sendTelegram'];
        yield EmailOrderMessage::class => ['method' => 'sendEmail'];
    }
}
