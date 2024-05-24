<?php
/**
 * Copyright © Osc All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Osc\Sample\Api\Data;

interface SubCategoryInterface
{

    const SUBCATEGORY_NAME = 'subcategory_name';
    const CATEGORY_ID = 'category_id';
    const SUBCATEGORY_ID = 'subcategory_id';
    const SUBCATEGORY_IMAGE = 'subcategory_image';

    /**
     * Get subcategory_id
     * @return string|null
     */
    public function getSubcategoryId();

    /**
     * Set subcategory_id
     * @param string $subcategoryId
     * @return \Osc\Sample\SubCategory\Api\Data\SubCategoryInterface
     */
    public function setSubcategoryId($subcategoryId);

    /**
     * Get subcategory_name
     * @return string|null
     */
    public function getSubcategoryName();

    /**
     * Set subcategory_name
     * @param string $subcategoryName
     * @return \Osc\Sample\SubCategory\Api\Data\SubCategoryInterface
     */
    public function setSubcategoryName($subcategoryName);

    /**
     * Get subcategory_image
     * @return string|null
     */
    public function getSubcategoryImage();

    /**
     * Set subcategory_image
     * @param string $subcategoryImage
     * @return \Osc\Sample\SubCategory\Api\Data\SubCategoryInterface
     */
    public function setSubcategoryImage($subcategoryImage);

    /**
     * Get category_id
     * @return string|null
     */
    public function getCategoryId();

    /**
     * Set category_id
     * @param string $categoryId
     * @return \Osc\Sample\SubCategory\Api\Data\SubCategoryInterface
     */
    public function setCategoryId($categoryId);
}

