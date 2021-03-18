<?php


Mage::loadFileByClassName('Block_Core_Template');
class Block_Product_Form_Tabs_Media extends Block_Core_Template {

    protected $media = null;

    public function __construct()
    {
        $this->setTemplate('../View/Product/Form/Tabs/Media.php');   
    }

    public function setMedia($media = null)
    {
        if ($this->media) {
            $this->media = $media;
            return $this;
        }
        $media = Mage::getModel('Model_Media');
        $productId = $this->getRequest()->getGet('editId');

        if ($productId) {
            $query = 'SELECT mediaId from media WHERE productId = ' . $productId;
            $mediaArray = $media->fetchRowByQuery($query);
            if ($mediaArray) {
                $media = $media->fetchAll();
            }
            else {
                return false;
            }
        }
        $this->media = $media;
        return $this;
    }
    public function getMedia()
    {
        if(!$this->media) {
            $this->setMedia();
        }
        return $this->media;
    }
    public function getFormUrl()
    {
        return $this->getUrl()->getUrl('saveMedia');
    }
    
}



