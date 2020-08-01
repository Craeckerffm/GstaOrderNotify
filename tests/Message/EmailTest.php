<?php

namespace GstaOrderNotify\Test\Message\ValueObjects;

use GstaOrderNotify\Message\Email;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class EmailTest extends TestCase
{

    public function test_it_accepts_and_returns_Email_as_String()
    {
        $email = new Email('test@test.de');
        $this->assertEquals('test@test.de', $email->asString());
    }

    public function test_it_throws_if_invalid_email_provided()
    {
        $this->expectException(InvalidArgumentException::class);
        new Email('test@testde');
    }
}
