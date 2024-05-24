<?php
namespace Osc\Sample\Controller\Adminhtml\SubCategory;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\JsonFactory;
use Magento\Framework\Filesystem;
use Magento\MediaStorage\Model\File\UploaderFactory;

class Upload extends Action
{
    protected $jsonFactory;
    protected $fileUploaderFactory;
    protected $filesystem;

    public function __construct(
        Context $context,
        JsonFactory $jsonFactory,
        UploaderFactory $fileUploaderFactory,
        Filesystem $filesystem
    ) {
        parent::__construct($context);
        $this->jsonFactory = $jsonFactory;
        $this->fileUploaderFactory = $fileUploaderFactory;
        $this->filesystem = $filesystem;
    }

    public function execute()
    {
        $result = $this->jsonFactory->create();
        try {
            $uploader = $this->fileUploaderFactory->create(['fileId' => 'subcategory_image']);
            $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);
            $uploader->setAllowRenameFiles(true);
            $uploader->setFilesDispersion(false);

            $mediaDirectory = $this->filesystem->getDirectoryRead(DirectoryList::MEDIA);
            $target = $mediaDirectory->getAbsolutePath('subcategory/images/');
            $result = $uploader->save($target);

            if ($result) {
                $result['url'] = $mediaDirectory->getUrl('subcategory/images/') . $result['file'];
                $result['file'] = 'subcategory/images/' . $result['file'];
            }
            return $result->setData($result);
        } catch (\Exception $e) {
            return $result->setData(['error' => $e->getMessage(), 'errorcode' => $e->getCode()]);
        }
    }
}
