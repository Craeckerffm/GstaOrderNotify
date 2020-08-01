<?php declare(strict_types=1);

namespace GstaOrderNotify\Service;

use GstaOrderNotify\Message\TelegramOrderMessage;
use GuzzleHttp\Client;

class TelegramSender implements SenderInterface
{
    /**
     * @param TelegramOrderMessage $message
     */
    public function send($message): void
    {
        $client = new Client();
        $data = [
            'chat_id' => $message->chatId(),
            'text' => $message->getMessageText(),
        ];
        $queryString = http_build_query($data);
        $url = "https://api.telegram.org/bot{$message->botId()}/sendMessage?$queryString";
        $client->request("GET", $url);
    }
}


