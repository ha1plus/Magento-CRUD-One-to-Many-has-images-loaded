<?php
/**
 * Copyright © Osc All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Osc\Sample\Api\Data;

interface CategoryInterface
{

    const CATEGORY_NAME = 'category_name';
    const CATEGORY_ID = 'category_id';

    /**
     * Get category_id
     * @return string|null
     */
    public function getCategoryId();

    /**
     * Set category_id
     * @param string $categoryId
     * @return \Osc\Sample\Category\Api\Data\CategoryInterface
     */
    public function setCategoryId($categoryId);

    /**
     * Get category_name
     * @return string|null
     */
    public function getCategoryName();

    /**
     * Set category_name
     * @param string $categoryName
     * @return \Osc\Sample\Category\Api\Data\CategoryInterface
     */
    public function setCategoryName($categoryName);
}

