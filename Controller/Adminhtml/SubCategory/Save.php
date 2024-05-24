<?php
namespace Osc\Sample\Controller\Adminhtml\SubCategory;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Psr\Log\LoggerInterface;
use  Magento\Framework\App\Request\DataPersistorInterface;
class Save extends Action
{
    protected $uploaderFactory;
    protected $logger;
    protected $filesystem;
    protected $dataPersistor;

    public function __construct(
        Context $context,
        \Magento\MediaStorage\Model\File\UploaderFactory $uploaderFactory,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor,
        \Psr\Log\LoggerInterface $logger,
        \Magento\Framework\Filesystem $filesystem
    ) {
        $this->uploaderFactory = $uploaderFactory;
        $this->dataPersistor = $dataPersistor;
        $this->logger = $logger;
        $this->filesystem = $filesystem;
        parent::__construct($context);
    }


    public function execute()
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('subcategory_id');

            // Load the model
            $model = $this->_objectManager->create(\Osc\Sample\Model\SubCategory::class)->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Subcategory no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            if(!empty($data['subcategory_image'][0]['name']) && isset($data['subcategory_image'][0]['tmp_name'])) {
                $data['subcategory_image'] = $data['subcategory_image'][0]['name'];
            } else {
                unset($data['subcategory_image']);
            }
            // Set data to the model
            $model->setData($data);

            try {
                // Save the model
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Subcategory.'));
            } catch (\Exception $e) {
                $this->logger->critical($e);
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Subcategory.'));
            }

            // Redirect
            if ($this->getRequest()->getParam('back')) {
                return $resultRedirect->setPath('*/*/edit', ['subcategory_id' => $model->getId()]);
            }
            return $resultRedirect->setPath('*/*/');
        }
        return $resultRedirect->setPath('*/*/');
    }
}
