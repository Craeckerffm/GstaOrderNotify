<?php


namespace GstaOrderNotify\Message;


use InvalidArgumentException;

class MessageSubject
{
    private $subject;

    public function __construct($subject)
    {
        if(!is_string($subject) ) throw new InvalidArgumentException('String expected');
        $this->subject = $subject;
    }

    public function toString(): string
    {
        return $this->subject;
    }
}
