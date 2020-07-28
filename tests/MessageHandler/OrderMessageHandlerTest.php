<?php declare(strict_types=1);

namespace GstaOrderNotify\Test\MessageHandler;

use GstaOrderNotify\Message\EmailOrderMessage;
use GstaOrderNotify\Message\TelegramOrderMessage;
use GstaOrderNotify\MessageHandler\OrderMessageHandler;
use GstaOrderNotify\Service\EmailSender;
use GstaOrderNotify\Service\TelegramSender;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;


class OrderMessageHandlerTest extends TestCase
{

    protected $emailSender;
    protected $telegramMessage;
    protected $emailMessage;
    protected $telegramSender;
    protected $handler;

    public function testAllMessagesRegisteredWithHandler(): void
    {
        $handlers = OrderMessageHandler::getHandledMessages();
        $this->assertCount(2, $handlers);
    }

    public function setUp(): void
    {
        $this->emailSender = $this->createMock(EmailSender::class);
        $this->telegramSender = $this->createMock(TelegramSender::class);
        $this->telegramMessage = $this->createMock(TelegramOrderMessage::class);
        $this->emailMessage = $this->createMock(EmailOrderMessage::class);
        $this->handler = new OrderMessageHandler($this->telegramSender, $this->emailSender);
    }

    public function testTelegramSenderGetsCalled()
    {
        $this->telegramSender->expects($this->once())
            ->method('send');
        $this->handler->sendTelegram($this->telegramMessage);
    }
    public function testEmailSenderGetsCalled()
    {
        $this->emailSender->expects($this->once())
            ->method('send');
        $this->handler->sendEmail($this->emailMessage);
    }

    public function testSendTelegramThrowsWithWrongMessage(){
        $this->expectException(InvalidArgumentException::class);
        $this->handler->sendTelegram($this->emailMessage);
    }

    public function testSendEmailThrowsWithWrongMessage(){
        $this->expectException(InvalidArgumentException::class);
        $this->handler->sendEmail($this->telegramMessage);
    }
}
