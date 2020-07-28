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
        $conf = $message->getConfig();
        $client = new Client();
        $data = [
            'chat_id' => $conf->get('channelId'),
            'text' => $message->getMessageText(),
        ];
        $queryString = http_build_query($data);
        $url = "https://api.telegram.org/bot{$conf->get('botId')}/sendMessage?$queryString";
        $client->request("GET", $url);
    }
}


