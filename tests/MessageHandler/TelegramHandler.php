<?php declare(strict_types=1);

namespace GstaOrderNotify\Test\MessageHandler;




use GstaOrderNotify\MessageHandler\OrderMessageHandler;
use PHPUnit\Framework\TestCase;


class TelegramHandlerTest extends TestCase
{

    public function TelegramHandlerTest(): void
    {
        $handlers = OrderMessageHandler::getHandledMessages();
        $this->assertCount(1, $handlers);

    }


}
