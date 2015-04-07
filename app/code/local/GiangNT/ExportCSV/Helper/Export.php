<?php
/**
 * Created by PhpStorm.
 * User: giangnt
 * Date: 06/04/2015
 * Time: 15:02
 */
class GiangNT_ExportCSV_Helper_Export extends Mage_Core_Helper_Abstract {
    /**
     * Contains current collection
     * @var string
     */
    protected $_list = null;

    /**
     * Sets current collection
     * @param $query
     */
    public function setList($collection)
    {
        $this->_list = $collection;
    }

    /**
     * Get collection
     * @return string
     */
    public function getList()
    {
        return $this->_list;
    }

    /**
     * Returns indexes of the fetched array as headers for CSV
     * @param array $products
     * @return array
     */
    protected function _getCsvHeaders($products)
    {
        $product = current($products);
        $headers = array_keys($product->getData());

        return $headers;
    }

    /**
     * Generates CSV file with product's list according to the collection in the $this->_list
     * @return array
     */
    public function generateMlnList($collection,$file = null, $path = null)
    {
        $this->setList($collection);
        if (!is_null($this->_list)) {
            $items = $this->_list->getItems();
            if (count($items) > 0) {
                $io = new Varien_Io_File();
                if(!$path) {
                    $path = Mage::getBaseDir('var').DS;
                }
                if(!$file) {
                    $file = $path.md5(microtime());
                }
                $io->setAllowCreateFolders(true);
                $io->open(array('path' => $path));
                $io->streamOpen($file, 'w+');
                $io->streamLock(true);

                $io->streamWriteCsv($this->_getCsvHeaders($items));
                foreach ($items as $product) {
                    $io->streamWriteCsv($product->getData());
                }

                return array(
                    'type'  => 'filename',
                    'value' => $file,
                    'rm'    => true // can delete file after use
                );
            }
        }
    }
}