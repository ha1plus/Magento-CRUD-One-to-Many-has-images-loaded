<?php

namespace Osc\Sample\Model\Config\Source;

use Magento\Framework\Data\OptionSourceInterface;
use Osc\Sample\Model\ResourceModel\Category\CollectionFactory as CategoryCollectionFactory;

class CategoryOptions implements OptionSourceInterface
{
    protected $categoryCollectionFactory;

    public function __construct(CategoryCollectionFactory $categoryCollectionFactory)
    {
        $this->categoryCollectionFactory = $categoryCollectionFactory;
    }

    public function toOptionArray()
    {
        $collection = $this->categoryCollectionFactory->create()
            ->addFieldToSelect(['category_id', 'category_name']); // Ensure these fields exist

        $options = [];

        foreach ($collection as $category) {
            $options[] = [
                'value' => $category->getData('category_id'), // Use getData() to fetch attributes
                'label' => $category->getData('category_name') // Use getData() to fetch attributes
            ];
        }

        return $options;
    }
}
