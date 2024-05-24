<?php
/**
 * Copyright © Osc All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Osc\Sample\Model\ResourceModel\SubCategory;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{

    /**
     * @inheritDoc
     */
    protected $_idFieldName = 'subcategory_id';

    /**
     * @inheritDoc
     */
    protected function _construct()
    {
        $this->_init(
            \Osc\Sample\Model\SubCategory::class,
            \Osc\Sample\Model\ResourceModel\SubCategory::class
        );
    }
    protected function _initSelect()
    {
        parent::_initSelect();

        // Join with category_table
        $this->getSelect()->joinLeft(
            ['category_table' => $this->getTable('osc_sample_category')],
            'main_table.category_id = category_table.category_id',
            ['category_name']
        );
//        echo $this->getSelect()->__toString();
//        $data = $this->getData();
//        var_dump($data);
//        die();

        return $this;
    }
}

