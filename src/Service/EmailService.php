<?php declare(strict_types=1);

namespace GstaOrderNotify\Service;

use GstaOrderNotify\Message\OrderMessage;
use Monolog\Logger;
use Shopware\Core\Content\MailTemplate\Service\MailServiceInterface;
use Shopware\Core\System\SystemConfig\SystemConfigService;
use Symfony\Component\HttpFoundation\ParameterBag;


class EmailService
{
    private $logger;
    private $mailService;
    private $config;

    public function __construct(MailServiceInterface $mailService, Logger $logger, SystemConfigService $config)
    {
        $this->logger = $logger;
        $this->mailService = $mailService;
        $this->config = $config;
    }

    public function send(OrderMessage $message)
    {
        $name = $message->getCustomerName();
        $s = $message->getTotalPrice();
        $summe = "<h1>Gesamtsumme: $s</h1>";
        $data = new ParameterBag();
        $data->set(
            'recipients',
            [
                $this->config->get('GstaOrderNotify.config.email') => 'Shop Owner',
            ]
        );
        $data->set('senderName', 'Ihr Onlineshop');
        $data->set('contentHtml', $summe);
        $data->set('contentPlain', $summe );
        $data->set('subject', "Neue Bestellung von $name");
        $data->set('salesChannelId', $message->getSalesChannelId());
        $this->mailService->send(
            $data->all(),
            $message->getContext()
        );
    }
}
