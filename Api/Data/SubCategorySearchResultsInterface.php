<?php
/**
 * Copyright © Osc All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Osc\Sample\Api\Data;

interface SubCategorySearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get SubCategory list.
     * @return \Osc\Sample\Api\Data\SubCategoryInterface[]
     */
    public function getItems();

    /**
     * Set subcategory_id list.
     * @param \Osc\Sample\Api\Data\SubCategoryInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

