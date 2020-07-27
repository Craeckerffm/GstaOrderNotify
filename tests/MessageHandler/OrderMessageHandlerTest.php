<?php declare(strict_types=1);

namespace GstaOrderNotify\Test\MessageHandler;

use GstaOrderNotify\MessageHandler\OrderMessageHandler;
use PHPUnit\Framework\TestCase;


class OrderHandlerTest extends TestCase
{
    public function testAllMessagesRegisteredWithHandler(): void
    {
        $handlers = OrderMessageHandler::getHandledMessages();
        $this->assertCount(2, $handlers);
    }
}
