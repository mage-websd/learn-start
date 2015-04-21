<?php

class SM_ImportData_Model_Flag extends Mage_Core_Model_Abstract
{
    protected $_tableName = '';
    protected $_write = '';
    protected $_read = '';
    protected $_originalId = '';
    protected $_destinationId = '';
    protected $_type = '';
    protected $_id = NULL;
    protected $_comparisonList = array();

    public function _construct()
    {
        $this->_init('sm_importdata/flag', 'id');
        $resource = Mage::getSingleton('core/resource');
        $this->_write = $resource->getConnection('core_write');
        $this->_read = $resource->getConnection('core_read');
        $this->_tableName = $resource->getTableName('sm_importdata/flag');
    }

    public function setId($id)
    {
        $this->_id = $id;
        return $this;
    }
    public function setOriginal($originalId)
    {
        $this->_originalId = $originalId;
        return $this;
    }

    public function setDestination($destinationId)
    {
        $this->_destinationId = $destinationId;
        return $this;
    }

    public function setType($type)
    {
        $this->_type = $type;
        return $this;
    }

    public function getImported()
    {
        $query = "SELECT * FROM `$this->_tableName` WHERE `type` = '$this->_type' ORDER BY `id` DESC";
        $type = $this->_type;
        $this->clearFlagObject();
        $result = $this->_read->fetchAll($query);
        $importedData = array(0);

        foreach ($result as $row) {
            if ($row['destination_id']) {
                $importedData[] = $row['original_id'];
                if ($type == 1) {
                    $this->setComparisonList(array($row['original_id'] => $row['destination_id']));
                }
            } else {
                $this->deleteFlag($row['id']);
            }
        }

        return $importedData;
    }

    public function setComparisonList($comparisonList)
    {
        $this->_comparisonList = $comparisonList;
    }

    public function getComparisonList()
    {
        return $this->_comparisonList;
    }

    public function getDestinationCategory()
    {
        if($this->_comparisonList[$this->_originalId]) {
            return $this->_comparisonList[$this->_originalId];
        }

    }

    public function loadFlag($value, $type, $by = 'id')
    {
        $select = "SELECT * FROM $this->_tableName WHERE $by = '$value' AND `type` = '$type'";
        $result = $this->_read->fetchRow($select);
        if (!empty($result)) {
            $this->setId($result['id']);
            $this->setOriginal($result['original_id']);
            $this->setDestination($result['destination_id']);
            $this->setType($result['type']);
        }
        return $this;
    }

    public function saveFlag()
    {
        $flagData = array(
            'id' => $this->_id,
            'original_id' => $this->_originalId,
            'destination_id' => $this->_destinationId,
            'type' => $this->_type
        );

        if($this->_id) {
            $flagData = array_merge($flagData, array('id' => $this->_id));
        }
        if($this->_originalId) {
            $flagData = array_merge($flagData, array('original_id' => $this->_originalId));
        }
        if($this->_destinationId) {
            $flagData = array_merge($flagData, array('destination_id' => $this->_destinationId));
        }
        if($this->_type) {
            $flagData = array_merge($flagData, array('type' => $this->_type));
        }

        if($this->_id) {
            $this->_write->update($this->_tableName, $flagData, $this->_write->quoteInto('id=?', $this->_id));
        } else {
            $this->_write->insert($this->_tableName, $flagData);
        }

        $this->clearFlagObject();
    }

    public function clearAll()
    {
        $this->_write->query("DELETE FROM $this->_tableName");
    }

    protected function clearFlagObject()
    {
        $this->setId('');
        $this->setOriginal('');
        $this->setDestination('');
        $this->setType('');
    }

    public function deleteFlag($value, $by = 'id')
    {
        $this->_write->delete($this->_tableName, array($this->_read->quoteInto("$by=?", $value)));
    }
}
 