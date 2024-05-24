<?php
/**
 * Copyright © Osc All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Osc\Sample\Api\Data;

interface CategorySearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{

    /**
     * Get Category list.
     * @return \Osc\Sample\Api\Data\CategoryInterface[]
     */
    public function getItems();

    /**
     * Set category_id list.
     * @param \Osc\Sample\Api\Data\CategoryInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}

