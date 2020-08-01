<?php declare(strict_types=1);

namespace GstaOrderNotify\Service;

use GstaOrderNotify\Message\EmailOrderMessage;
use Shopware\Core\Content\MailTemplate\Service\MailServiceInterface;
use Symfony\Component\HttpFoundation\ParameterBag;

class EmailSender implements SenderInterface
{

    private $mailService;

    public function __construct(MailServiceInterface $mailService)
    {
        $this->mailService = $mailService;
    }

    /**
     * @param EmailOrderMessage $message
     */
    public function send($message): void
    {
        $data = new ParameterBag();
        $data->set(
            'recipients',
            [
                $message->getEmail() => 'Shop Owner',
            ]
        );
        $data->set('senderName', $message->getSubject());
        $data->set('contentHtml', $message->getMessageText());
        $data->set('contentPlain', $message->getMessageText());
        $data->set('subject', $message->getSubject());
        $data->set('salesChannelId', $message->getSalesChannelId());
        $this->mailService->send(
            $data->all(),
            $message->getContext()
        );
    }
}
