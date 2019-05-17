<?php

namespace Hitmeister\Component\Api\Endpoints\Tickets;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Endpoints\Traits\BodyTransfer;
use Hitmeister\Component\Api\Endpoints\Traits\EmptyParamWhiteList;
use Hitmeister\Component\Api\Endpoints\Traits\RequestPost;
use Hitmeister\Component\Api\Transfers\TicketOpenTransfer;

class Post extends AbstractEndpoint
{
    use RequestPost;
    use EmptyParamWhiteList;
    use BodyTransfer;

    public function setTransfer(TicketOpenTransfer $transfer) {
        $this->transfer = $transfer;
    }

    public function getURI()
    {
        return 'tickets/';
    }
}