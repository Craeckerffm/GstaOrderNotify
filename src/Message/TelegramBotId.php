<?php


namespace GstaOrderNotify\Message;


class TelegramBotId
{
    private $id;

    public function __construct($id)
{
    // TODO Implement Check
    $this->id = $id;
}
public function fromString(): string
{
    return $this->id;
}
}
