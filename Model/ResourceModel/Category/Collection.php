<?php
/**
 * Copyright © Osc All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Osc\Sample\Model\ResourceModel\Category;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'category_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Osc\Sample\Model\Category::class,
            \Osc\Sample\Model\ResourceModel\Category::class
        );
    }
}

