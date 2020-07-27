<?php

namespace GstaOrderNotify\Service;


interface SenderInterface
{

 public function send($message): void;

}
