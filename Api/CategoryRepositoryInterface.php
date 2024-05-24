<?php
/**
 * Copyright © Osc All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Osc\Sample\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface CategoryRepositoryInterface
{

    /**
     * Save Category
     * @param \Osc\Sample\Api\Data\CategoryInterface $category
     * @return \Osc\Sample\Api\Data\CategoryInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Osc\Sample\Api\Data\CategoryInterface $category
    );

    /**
     * Retrieve Category
     * @param string $categoryId
     * @return \Osc\Sample\Api\Data\CategoryInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($categoryId);

    /**
     * Retrieve Category matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Osc\Sample\Api\Data\CategorySearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Category
     * @param \Osc\Sample\Api\Data\CategoryInterface $category
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Osc\Sample\Api\Data\CategoryInterface $category
    );

    /**
     * Delete Category by ID
     * @param string $categoryId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($categoryId);
}

