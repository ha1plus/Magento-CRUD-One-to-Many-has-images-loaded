<?php
/**
 * Copyright © Osc All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Osc\Sample\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface SubCategoryRepositoryInterface
{

    /**
     * Save SubCategory
     * @param \Osc\Sample\Api\Data\SubCategoryInterface $subCategory
     * @return \Osc\Sample\Api\Data\SubCategoryInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \Osc\Sample\Api\Data\SubCategoryInterface $subCategory
    );

    /**
     * Retrieve SubCategory
     * @param string $subcategoryId
     * @return \Osc\Sample\Api\Data\SubCategoryInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function get($subcategoryId);

    /**
     * Retrieve SubCategory matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Osc\Sample\Api\Data\SubCategorySearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete SubCategory
     * @param \Osc\Sample\Api\Data\SubCategoryInterface $subCategory
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \Osc\Sample\Api\Data\SubCategoryInterface $subCategory
    );

    /**
     * Delete SubCategory by ID
     * @param string $subcategoryId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($subcategoryId);
}

