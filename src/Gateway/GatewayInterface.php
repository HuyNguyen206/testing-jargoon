<?php

namespace App\Gateway;

interface GatewayInterface
{
    const TEST = 'ssd';
    public function create();
}
