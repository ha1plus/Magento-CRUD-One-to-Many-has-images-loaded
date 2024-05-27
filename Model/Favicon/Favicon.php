<?php

namespace Osc\Sample\Model\Favicon;

use Magento\Theme\Model\Favicon\Favicon as ParentClass;

class Favicon extends ParentClass
{
    /**
     * Get updated Favicon Icon
     *
     * @return string
     */
    public function getDefaultFavicon()
    {
        return 'Osc_Sample::favicon.png';
    }
}
