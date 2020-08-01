<?php


namespace GstaOrderNotify\Message;


use InvalidArgumentException;

class Email
{
    private $email;

    public function __construct(string $email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException();
        }
        $this->email = $email;
    }

    public static function fromString($email): self
    {
        return new self($email);
    }

    public function asString(): string
    {
        return $this->email;
    }


}
