<?php
/**
 * Copyright © Osc All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Osc\Sample\Model\SubCategory;

use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Framework\Filesystem\Driver\File\Mime;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Osc\Sample\Model\ResourceModel\SubCategory\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Filesystem\Directory\ReadInterface;
use Magento\Framework\Filesystem;
use Magento\Framework\App\Filesystem\DirectoryList;

class DataProvider extends AbstractDataProvider
{
    private ReadInterface $mediaDirectory;
    private StoreManagerInterface $storeManager;
    /**
     * @var array
     */
    protected $loadedData;
    /**
     * @inheritDoc
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param StoreManagerInterface $storeManager
     * @param Mime $mime
     * @param Filesystem $filesystem
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        StoreManagerInterface $storeManager,
        private Mime $mime,
        private Filesystem $filesystem,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        $this->mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
        $this->storeManager = $storeManager;
        $this->mime = $mime;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @inheritDoc
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $model) {
            $subCategoryData = $model->getData();
            $image = $subCategoryData['subcategory_image'];

            $imgDir = 'tmp/subcategory/images';
            $baseUrl = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
            $fullImagePath = $this->mediaDirectory->getAbsolutePath($imgDir) . '/' . $image;

            if ($this->mediaDirectory->isExist($fullImagePath)) {
                $stat = $this->mediaDirectory->stat($fullImagePath);
                $imageUrl = $baseUrl . $imgDir . '/' . $image;
                $subCategoryData['subcategory_image'] = [
                    [
                        'url' => $imageUrl,
                        'name' => $image,
                        'size' => $stat['size'],
                        'type' => $this->mime->getMimeType($fullImagePath)
                    ]
                ];
            } else {
                $subCategoryData['subcategory_image'] = [
                    [
                        'url' => '',
                        'name' => '',
                        'size' => 0,
                        'type' => 'unknown'
                    ]
                ];
            }

            $this->loadedData[$model->getId()] = $subCategoryData;
        }
        $data = $this->dataPersistor->get('osc_sample_subcategory');

        if (!empty($data)) {
            $model = $this->collection->getNewEmptyItem();
            $model->setData($data);
            $this->loadedData[$model->getId()] = $model->getData();
            $this->dataPersistor->clear('osc_sample_subcategory');
        }

        return $this->loadedData;
    }
}
