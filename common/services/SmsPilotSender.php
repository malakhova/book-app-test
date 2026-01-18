<?php

namespace common\services;

use common\services\SmsSenderInterface;

class SmsPilotSender implements SmsSenderInterface
{
    /**
     * @inheritDoc
     */
    public function send($phone, $message): bool
    {
        //todo реализация
        return true;
    }
}
