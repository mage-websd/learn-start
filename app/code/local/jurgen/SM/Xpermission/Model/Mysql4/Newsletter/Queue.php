<?php
/**
 * Newsletter queue saver
 *
 * @category   Mage
 * @package    Mage_Newsletter
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class SM_Xpermission_Model_Mysql4_Newsletter_Queue extends Mage_Newsletter_Model_Mysql4_Queue {
    public function setStores(Mage_Newsletter_Model_Queue $queue) {
        //nếu là Root thì xử lý như trong core ngược lại thì chỉ xóa những store_id trong website mà member quản lý
        if(Mage::getSingleton('admin/session')->getUser()->isRoot()) {
            $this->_getWriteAdapter()
                    ->delete(
                    $this->getTable('queue_store_link'),
                    $this->_getWriteAdapter()->quoteInto('queue_id = ?', $queue->getId())
            );
        }else {
            $_websiteList = Mage::getSingleton('admin/session')->getUser()->getWebsiteId();
            $_storeList = Mage::getModel('core/website')->load($_websiteList)->getStoreIds();
            $_storeList = implode(",", $_storeList);
            //Sua lai menh de where
            $where = " newsletter_queue_store_link.store_id in (".$_storeList.")";
            $this->_getWriteAdapter()->delete($this->getTable('newsletter/queue_store_link'), $where);
        }

        if (!is_array($queue->getStores())) {
            $stores = array();
        } else {
            $stores = $queue->getStores();
        }

        foreach ($stores as $storeId) {
            $data = array();
            $data['store_id'] = $storeId;
            $data['queue_id'] = $queue->getId();
            $this->_getWriteAdapter()->insert($this->getTable('queue_store_link'), $data);
        }

        $this->removeSubscribersFromQueue($queue);

        if(count($stores)==0) {
            return $this;
        }
        $subscribers = Mage::getResourceSingleton('newsletter/subscriber_collection')
                ->addFieldToFilter('store_id', array('in'=>$stores))
                ->useOnlySubscribed()
                ->load();

        $subscriberIds = array();

        foreach ($subscribers as $subscriber) {
            $subscriberIds[] = $subscriber->getId();
        }

        if (count($subscriberIds) > 0) {
            $this->addSubscribersToQueue($queue, $subscriberIds);
        }

        return $this;
    }
}
