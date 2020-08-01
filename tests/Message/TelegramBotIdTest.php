<?php

namespace GstaOrderNotify\Test\Message\ValueObjects;

use GstaOrderNotify\Message\TelegramBotId;
use PHPUnit\Framework\TestCase;

class TelegramBotIdTest extends TestCase
{

    public function test_it_accepts_and_returns_a_string()
    {
        $botId = new TelegramBotId('string');
$this->assertEquals('string', $botId->fromString());
    }
}
