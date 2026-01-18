<?php

namespace common\services;

interface SmsSenderInterface
{
    /**
     * @param string $phone
     * @param string $message
     * @return bool
     */
    public function send(string $phone, string $message): bool;
}
