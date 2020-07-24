<?php

namespace GstaOrderNotify\Message;

class EmailOrderNotifyMessage extends AbstractOrderNotifyMessage
{


    public function setConfig(): array
    {
       return $this->senderConfig = array(["email" => $this->configService->get("GstaOrderNotify.config.email")]);
    }

}
