<?php
namespace Osc\Sample\Controller\Adminhtml\SubCategory;

use Magento\Backend\App\Action;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Filesystem;
use Magento\Backend\App\Action\Context; // Import Context class here
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\App\Filesystem\DirectoryList; // Import DirectoryList class here

class ImageTempUpload extends Action implements \Magento\Framework\App\Action\HttpPostActionInterface
{
    private Filesystem\Directory\WriteInterface $mediaDirectory;

    public function __construct(
        Context $context, // Use correct class here
        Filesystem $filesystem,
        private UploaderFactory $uploaderFactory,
        private StoreManagerInterface $storeManager
    ) {
        $this->mediaDirectory = $filesystem->getDirectoryWrite(DirectoryList::MEDIA);
        parent::__construct($context);
    }

    public function execute(): ResultInterface
    {
        $jsonResult = $this->resultFactory->create(ResultFactory::TYPE_JSON);

        try {
            $fileUploader = $this->uploaderFactory->create(['fileId' => 'subcategory_image']);
            $fileUploader->setAllowedExtensions(['jpg', 'jpeg', 'png']);
            $fileUploader->setAllowRenameFiles(true);
            $fileUploader->setAllowCreateFolders(true);
            $fileUploader->setFilesDispersion(false);
            $imgPath = 'tmp/subcategory/images';
            $result = $fileUploader->save($this->mediaDirectory->getAbsolutePath($imgPath));
            $mediaUrl = $this->storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
            $fileName = ltrim(str_replace('\\', '/', $result['file']), '/');

            $result['url'] = $mediaUrl . $imgPath  . '/' . $fileName;
            return $jsonResult->setData($result);
        } catch (\Magento\Framework\Exception\LocalizedException $exception) {
            return  $jsonResult->setData(['error' => $exception->getMessage()]);
        } catch (\PHPUnit\Exception $e) {
            return  $jsonResult->setData(['error' => $e->getMessage()]);
        }
    }
}
