<?php declare(strict_types=1);

namespace GstaOrderNotify\Service;

use GstaOrderNotify\Message\OrderMessage;
use GuzzleHttp\Client;
use Shopware\Core\System\SystemConfig\SystemConfigService;

class TelegramService
{
    private $config;

    public function __construct(SystemConfigService $config)
    {
        $this->config = $config;
    }

    public function send(OrderMessage $message)
    {
        $c = $message->getCustomerName();
        $item = $message->getTotalPrice();
        $url = "https://api.telegram.org/bot{$this->config->get('GstaOrderNotify.config.botId')}/sendMessage?chat_id={$this->config->get('GstaOrderNotify.config.channelId')}&text=Neue Bestellung von: $c zu folgenden preis: $item und ";
        $client = new Client();
        $client->request("GET", $url);
    }
}




