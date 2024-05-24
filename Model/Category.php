<?php
/**
 * Copyright © Osc All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Osc\Sample\Model;

use Magento\Framework\Model\AbstractModel;
use Osc\Sample\Api\Data\CategoryInterface;

class Category extends AbstractModel implements CategoryInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Osc\Sample\Model\ResourceModel\Category::class);
    }

    /**
     * @inheritDoc
     */
    public function getCategoryId()
    {
        return $this->getData(self::CATEGORY_ID);
    }

    /**
     * @inheritDoc
     */
    public function setCategoryId($categoryId)
    {
        return $this->setData(self::CATEGORY_ID, $categoryId);
    }

    /**
     * @inheritDoc
     */
    public function getCategoryName()
    {
        return $this->getData(self::CATEGORY_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setCategoryName($categoryName)
    {
        return $this->setData(self::CATEGORY_NAME, $categoryName);
    }
}

