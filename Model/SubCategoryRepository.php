<?php
/**
 * Copyright © Osc All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Osc\Sample\Model;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Osc\Sample\Api\Data\SubCategoryInterface;
use Osc\Sample\Api\Data\SubCategoryInterfaceFactory;
use Osc\Sample\Api\Data\SubCategorySearchResultsInterfaceFactory;
use Osc\Sample\Api\SubCategoryRepositoryInterface;
use Osc\Sample\Model\ResourceModel\SubCategory as ResourceSubCategory;
use Osc\Sample\Model\ResourceModel\SubCategory\CollectionFactory as SubCategoryCollectionFactory;

class SubCategoryRepository implements SubCategoryRepositoryInterface
{

    /**
     * @var ResourceSubCategory
     */
    protected $resource;

    /**
     * @var CollectionProcessorInterface
     */
    protected $collectionProcessor;

    /**
     * @var SubCategory
     */
    protected $searchResultsFactory;

    /**
     * @var SubCategoryCollectionFactory
     */
    protected $subCategoryCollectionFactory;

    /**
     * @var SubCategoryInterfaceFactory
     */
    protected $subCategoryFactory;


    /**
     * @param ResourceSubCategory $resource
     * @param SubCategoryInterfaceFactory $subCategoryFactory
     * @param SubCategoryCollectionFactory $subCategoryCollectionFactory
     * @param SubCategorySearchResultsInterfaceFactory $searchResultsFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        ResourceSubCategory $resource,
        SubCategoryInterfaceFactory $subCategoryFactory,
        SubCategoryCollectionFactory $subCategoryCollectionFactory,
        SubCategorySearchResultsInterfaceFactory $searchResultsFactory,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->resource = $resource;
        $this->subCategoryFactory = $subCategoryFactory;
        $this->subCategoryCollectionFactory = $subCategoryCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @inheritDoc
     */
    public function save(SubCategoryInterface $subCategory)
    {
        try {
            $this->resource->save($subCategory);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the subCategory: %1',
                $exception->getMessage()
            ));
        }
        return $subCategory;
    }

    /**
     * @inheritDoc
     */
    public function get($subCategoryId)
    {
        $subCategory = $this->subCategoryFactory->create();
        $this->resource->load($subCategory, $subCategoryId);
        if (!$subCategory->getId()) {
            throw new NoSuchEntityException(__('SubCategory with id "%1" does not exist.', $subCategoryId));
        }
        return $subCategory;
    }

    /**
     * @inheritDoc
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->subCategoryCollectionFactory->create();
        
        $this->collectionProcessor->process($criteria, $collection);
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        
        $items = [];
        foreach ($collection as $model) {
            $items[] = $model;
        }
        
        $searchResults->setItems($items);
        $searchResults->setTotalCount($collection->getSize());
        return $searchResults;
    }

    /**
     * @inheritDoc
     */
    public function delete(SubCategoryInterface $subCategory)
    {
        try {
            $subCategoryModel = $this->subCategoryFactory->create();
            $this->resource->load($subCategoryModel, $subCategory->getSubcategoryId());
            $this->resource->delete($subCategoryModel);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the SubCategory: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * @inheritDoc
     */
    public function deleteById($subCategoryId)
    {
        return $this->delete($this->get($subCategoryId));
    }
}

