<?php

namespace Hitmeister\Component\Api\Endpoints\ReturnUnits;

use Hitmeister\Component\Api\Endpoints\AbstractEndpoint;
use Hitmeister\Component\Api\Endpoints\Interfaces\IdAware;
use Hitmeister\Component\Api\Endpoints\Traits\BodyTransfer;
use Hitmeister\Component\Api\Endpoints\Traits\EmptyParamWhiteList;
use Hitmeister\Component\Api\Endpoints\Traits\RequestPatch;
use Hitmeister\Component\Api\Endpoints\Traits\UriPatternId;
use Hitmeister\Component\Api\Transfers\ReturnUnitClarifyTransfer;

/**
 * Class Clarify
 *
 * @category PHP-SDK
 * @package  Hitmeister\Component\Api\Endpoints\ReturnUnits
 * @author   Oleksandr Dombrovskyi <oleksandr.dombrovskyi@real-digital.de>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://www.hitmeister.de/api/v1/
 */
class Clarify extends AbstractEndpoint implements IdAware
{
    use RequestPatch;
    use UriPatternId;
    use EmptyParamWhiteList;
    use BodyTransfer;

    /**
     * @param ReturnUnitClarifyTransfer $transfer
     */
    public function setTransfer(ReturnUnitClarifyTransfer $transfer)
    {
        $this->transfer = $transfer;
    }

    /**
     * {@inheritdoc}
     */
    protected function getUriPattern()
    {
        return 'return-units/%d/clarify/';
    }
}
