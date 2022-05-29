<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CMSModel extends CI_Model {
    // CREATE
        function addProduct($data){
            if($data['newData'] == 'accept'){
                $item = array(
                    'itemName' => $data['itemName'],
                    'itemDescription' => $data['itemDescription'],
                    'itemAge' => $data['itemAge'],
                    'itemCategoryID' => $data['itemCategoryID'],
                    'itemImage' => $data['itemImage'],
                );
                $this->db->insert('itemData',$item);
            }
            else{
                $item = array(
                    'itemID' => $data['itemID'],
                    'itemSizeID' => $data['itemSizeID'],
                    'itemColorID' => $data['itemColorID'],
                    'itemPrice' => $data['itemPrice'],
                    'itemStock' => $data['itemStock'],
                );
                $this->db->insert('itemDetail',$item);
            }
        }

        function addFlashSaleData($data){
            $this->db->query("SET sql_mode = '' ");
            $this->db->insert('flashSale',$data);
        }

        function addFlashSaleDetailData($data){
            $this->db->insert('flashSaleDetail',$data);
        }

    // READ
        function getProductData($type){
            $this->db->select('itemData.*, itemCategory.itemCategoryName');
            $this->db->where('itemAge', $type);
            // $this->db->where('itemAvailability', 1);
            $this->db->from('itemData');
            $this->db->join('itemCategory', 'itemData.itemCategoryID = itemCategory.itemCategoryID', 'inner');
            
            $query = $this->db->get();
            return $query->result_array();
        }

        function getCustomerData(){
            $this->db->select('user.*, role.role');
            $this->db->from('user');
            $this->db->join('role', 'user.role_id = role.role_id', 'inner');
            $query = $this->db->get();

            return $query->result_array();
        }

        function getTransactionData($transactionID){
            $this->db->select('user.*, transaction.*, status.status');
            $this->db->from('transaction');
            
            if($transactionID != NULL){
                $this->db->where('transactionID', $transactionID);
            }

            $this->db->join('user', 'transaction.user_id = user.user_id', 'inner');
            $this->db->join('status', 'transaction.transactionStatus = status.status_id', 'inner');
            $query = $this->db->get();

            return $query->result_array();
        }

        function getItem($itemID){
            $this->db->select('itemData.*, itemCategory.itemCategoryName');
            $this->db->from('itemData');

            if($itemID != NULL){
                $this->db->where('itemID', $itemID);
                // $this->db->where('itemAvailability', 1);    
            }
            $this->db->join('itemCategory', 'itemData.itemCategoryID = itemCategory.itemCategoryID');
            $query = $this->db->get();
            return $query->result_array();
        }

        function getCategoryList(){
            $this->db->query("SET sql_mode = '' ");
            $query = $this->db->get('itemCategory');
            return $query->result_array();
        }
        
        function getSizeList(){
            $query = $this->db->get('itemsize');
            return $query->result_array();
        }
        
        function getColorList(){
            $this->db->query("SET sql_mode = '' ");
            $query = $this->db->get('itemColor');
            return $query->result_array();
        }

        function getItemDetail($itemID, $itemDetailID){
            $this->db->select('itemData.*, itemDetail.*, itemColor.itemColorName, itemsize.itemSizeName, itemCategory.itemCategoryName');
            $this->db->from('itemDetail');
            if($itemID != NULL){
                $this->db->where('itemDetail.itemID', $itemID);
            }
            else{
                $this->db->where('itemDetail.itemDetailID', $itemDetailID);
            }
            // $this->db->where('itemDetailAvailability', 1);
            $this->db->join('itemData', 'itemDetail.itemID = itemData.itemID');
            $this->db->join('itemsize', 'itemDetail.itemSizeID = itemsize.itemSizeID');
            $this->db->join('itemColor', 'itemDetail.itemColorID = itemColor.itemColorID');
            $this->db->join('itemCategory', 'itemData.itemCategoryID = itemCategory.itemCategoryID');
            
            $query = $this->db->get();
            return $query->result_array();
        }

        function getTransactionDetail($transactionID){
            $this->db->select('
                itemName, itemAge, itemImage, itemCategory.itemCategoryName, itemData.itemID,
                itemSize.itemSizeName, itemColor.itemColorName, itemDetail.itemDetailID,
                transactiondetail.itemQuantity, transactiondetail.itemPrice
            ');
            $this->db->from('transactiondetail');
            $this->db->where('transactionID', $transactionID);
            $this->db->join('itemDetail', 'itemDetail.itemDetailID = transactiondetail.itemDetailID');
            $this->db->join('itemData', 'itemData.itemID = itemDetail.itemID');
            $this->db->join('itemSize', 'itemDetail.itemSizeID = itemSize.itemSizeID');
            $this->db->join('itemColor', 'itemDetail.itemColorID = itemColor.itemColorID');
            $this->db->join('itemCategory', 'itemData.itemCategoryID = itemCategory.itemCategoryID');
            
            $query = $this->db->get();
            return $query->result_array();
        }

        function getStatusList(){
            $query = $this->db->get('status');
            return $query->result_array();
        }

        function getFlashSaleData($flashSaleID){
            $this->db->from('flashSale');
            
            if($flashSaleID != NULL){
                $this->db->where('flashSaleID', $flashSaleID);
            }
            $query = $this->db->get();

            return $query->result_array();
        }
        
        function getFlashSaleDetail($flashSaleID){
            $this->db->select('
                flashSaleDetail.*, flashSale.*, itemData.*, itemCategory.itemCategoryName
            ');
            $this->db->from('flashSaleDetail');
            $this->db->where('flashSale.flashSaleID', $flashSaleID);
            $this->db->join('flashSale', 'flashSale.flashSaleID = flashSaleDetail.flashSaleID');
            $this->db->join('itemData', 'itemData.itemID = flashSaleDetail.itemID');
            $this->db->join('itemCategory', 'itemCategory.itemCategoryID = itemData.itemCategoryID');
            
            $query = $this->db->get();
            return $query->result_array();
        }

        function checkItemExistence($flashSaleID, $itemID){
            $this->db->query("SET sql_mode = '' ");
            $this->db->where('flashSaleID',$flashSaleID);
            $this->db->where('itemID',$itemID);
            $query = $this->db->get('flashSaleDetail');
            if ($query->num_rows() > 0){
                return true;
            }
            else{
                return false;
            }
        }
    // UPDATE
        function updateItemByID($data){
            $this->db->query("SET sql_mode = '' ");
            $this->db->where('itemID', $data['itemID']);
            $setData = array(
                'itemAvailability' => $data['itemAvailability'],
                'itemName'         => $data['itemName'],
                'itemCategoryID'   => $data['itemCategoryID'],
                'itemAge'          => $data['itemAge'],
                'itemDescription'  => $data['itemDescription'],
                'itemDiscount'     => $data['itemDiscount'],
                // 'itemImage'        => $data['itemImage'],
            );
            $this->db->set($setData);
            $this->db->update('itemData');

            $this->db->where('itemID', $data['itemID']);
            if($data['itemAvailability'] == 0){
                $this->db->set('itemDetailAvailability', $data['itemAvailability']);
            }
            else{
                $this->db->where('itemStock >', 0);        
                $this->db->set('itemDetailAvailability', $data['itemAvailability']);
            }
            $this->db->update('itemDetail');
        }

        function updateItemDetailByDetailID($data){
            $this->db->where('itemDetailID', $data['itemDetailID']);
            if($data['itemStock'] > 0){
                $this->db->set('itemDetailAvailability', $data['itemDetailAvailability']);
            }
            else{
                $this->db->set('itemDetailAvailability', 0);
            }
            $this->db->set('itemSizeID', $data['itemSizeID']);
            $this->db->set('itemColorID', $data['itemColorID']);
            $this->db->set('itemPrice', $data['itemPrice']);
            $this->db->set('itemStock', $data['itemStock']);
            
            $this->db->update('itemDetail');
        }

        function updateStatus($data){
            $this->db->where('transactionID', $data['transactionID']);
            $this->db->set('transactionStatus', $data['transactionStatus']);
            $this->db->update('transaction');
        }

        function updateFlashSaleData($data){
            $this->db->query("SET sql_mode = '' ");
            $this->db->where('flashSaleID', $data['flashSaleID']);
            $this->db->set('flashSaleDate', $data['flashSaleDate']);
            $this->db->set('flashSaleStartTime', $data['flashSaleStartTime']);
            $this->db->set('flashSaleEndTime', $data['flashSaleEndTime']);
            $this->db->update('flashSale');
        }

	// DELETE
		function deleteFlashSaleDetailByID($flashSaleDetailID){           
                $this->db->where('flashSaleDetailID', $flashSaleDetailID);
                $this->db->delete('flashSaleDetail');
        }

        function deleteFlashSaleByID($flashSaleID){
            $this->db->query("SET sql_mode = '' ");
            if($flashSaleID != NULL){            
                $this->db->where('flashSaleID', $flashSaleID);
                $this->db->delete('flashSaleDetail');

                $this->db->where('flashSaleID', $flashSaleID);
                $this->db->delete('flashSale');
            }
            else{
                date_default_timezone_set("Asia/Jakarta");
                $this->db->select('flashSaleID');
                $this->db->where('flashSaleDate <', date('Y-m-d'));
                $this->db->where('flashSaleEndTime <=', date('H:i'));
                $query = $this->db->get('flashSale')->result_array();
                
                foreach($query as $data){
                    $this->db->where('flashSaleID', $data['flashSaleID']);
                    $this->db->delete('flashSaleDetail');

                    $this->db->where('flashSaleID', $data['flashSaleID']);
                    $this->db->delete('flashSale');
    
                }
            }
        }
        // function deleteItemDetailByID($itemID, $itemDetailID){            
        //     if($itemID != NULL){
        //         $this->db->where('itemID', $itemID);
        //     }
        //     else{
        //         $this->db->where('itemDetailID', $itemDetailID);
        //     }
        //     $this->db->set('itemDetailAvailability', 0);
        //     $this->db->update('itemDetail');
        // }
        
        // function deleteItemByID($itemID){
        //     $this->deleteItemDetailByID($itemID, NULL);            
        //     $this->db->where('itemID', $itemID);
            
        //     $this->db->set('itemAvailability', 0);
        //     $this->db->update('itemData');
        // }
}
