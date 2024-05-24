<?php
/**
 * Copyright © Osc All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Osc\Sample\Model;

use Magento\Framework\Model\AbstractModel;
use Osc\Sample\Api\Data\SubCategoryInterface;

class SubCategory extends AbstractModel implements SubCategoryInterface
{

    /**
     * @inheritDoc
     */
    public function _construct()
    {
        $this->_init(\Osc\Sample\Model\ResourceModel\SubCategory::class);
    }

    /**
     * @inheritDoc
     */
    public function getSubcategoryId()
    {
        return $this->getData(self::SUBCATEGORY_ID);
    }

    /**
     * @inheritDoc
     */
    public function setSubcategoryId($subcategoryId)
    {
        return $this->setData(self::SUBCATEGORY_ID, $subcategoryId);
    }

    /**
     * @inheritDoc
     */
    public function getSubcategoryName()
    {
        return $this->getData(self::SUBCATEGORY_NAME);
    }

    /**
     * @inheritDoc
     */
    public function setSubcategoryName($subcategoryName)
    {
        return $this->setData(self::SUBCATEGORY_NAME, $subcategoryName);
    }

    /**
     * @inheritDoc
     */
    public function getSubcategoryImage()
    {
        return $this->getData(self::SUBCATEGORY_IMAGE);
    }

    /**
     * @inheritDoc
     */
    public function setSubcategoryImage($subcategoryImage)
    {
        return $this->setData(self::SUBCATEGORY_IMAGE, $subcategoryImage);
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
}

