<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductModel extends CI_Model {
    // CREATE
    function addCustomerLikedItems($user_id, $itemID){
        $this->db->query("SET sql_mode = '' ");
        $this->db->from('customerlikeditems');
        $this->db->where('itemID', $itemID);
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        if($query->num_rows() == 0){
            $data = array(
                'user_id' => $user_id,
                'itemID' => $itemID
            );

            $this->db->insert('customerlikeditems',$data);
        
            $this->db->where('itemID', $data['itemID']);
            $this->db->set('itemLike', 'itemLike + 1', FALSE);
            $this->db->update('itemData');
        }
    }

    function addItemToShoppingCart($shoppingData){
        $this->db->insert('shoppingcart', $shoppingData);
    }

    // READ
    function getItemDetail($itemID, $itemName){
        $this->db->query("SET sql_mode = '' ");
        $this->db->select('itemData.*, itemDetail.*, itemsize.itemSizeName, itemColor.itemColorName');
        $this->db->from('itemDetail');
        $this->db->join('itemData', 'itemDetail.itemID = itemData.itemID', 'inner');
        $this->db->join('itemsize', 'itemDetail.itemSizeID = itemsize.itemSizeID', 'inner');
        $this->db->join('itemColor', 'itemDetail.itemColorID = itemColor.itemColorID', 'inner');
        // $this->db->having('itemData.itemName', $itemName);
        $this->db->where('itemDetail.itemID', $itemID);
        
        $this->db->order_by('itemDetail.itemPrice', 'ASC');
        $query = $this->db->get();

        $this->db->where('itemID', $itemID);
        $this->db->set('itemView', 'itemView + 1', FALSE);
        $this->db->update('itemData');

        return $query->result_array();
    }

    function getItemPrice($status, $itemID){
        $this->db->query("SET sql_mode = '' ");
        // Jika status bernilai 1, ambil nilai minimal
        if($status){
            $this->db->select_min('itemPrice');
        }
        else{
            $this->db->select_max('itemPrice');
        }
        $this->db->from('itemDetail');
        $this->db->where('itemID', $itemID);
        $query = $this->db->get();
        return $query->row();
    }

    function getAllItem($categoryID, $limit, $start){
        $this->db->query("SET sql_mode = '' ");
        $this->db->select('itemData.*');
        $this->db->select_min('itemPrice', 'itemMinPrice');
        $this->db->select_max('itemPrice', 'itemMaxPrice');
        $this->db->from('itemDetail');
        $this->db->where('itemAvailability = 1');
        $this->db->join('itemData', 'itemDetail.itemID = itemData.itemID');
        $this->db->group_by('itemData.itemID');
        if($categoryID != NULL){
            $this->db->having('itemData.itemCategoryID', $categoryID);
        }
        $this->db->order_by('itemData.itemID');
        $query = $this->db->limit($limit,$start)->get();
        //$query = $this->db->get();
        return $query->result_array();
    }

    function getItemCategory(){
        $this->db->query("SET sql_mode = '' ");
        $query = $this->db->get('itemCategory');
        return $query->result_array();
    }

    function getCategoryID($categoryName){
        $this->db->query("SET sql_mode = '' ");
        $this->db->select('itemCategoryID');
        $this->db->where('itemCategoryName', $categoryName);
        $this->db->from('itemCategory');

        return $this->db->get();
    }

    function getFlashSale(){		
        $this->db->query("SET sql_mode = '' ");
		$this->db->select('itemData.*, itemDetail.*');
		$this->db->select('flashSale.flashSaleDate');
		$this->db->select('flashSale.flashSaleStartTime');
		$this->db->select('flashSale.flashSaleEndTime');
		$this->db->select_min('itemPrice', 'itemMinPrice');
		$this->db->select_max('itemPrice', 'itemMaxPrice');
		$this->db->from('itemData');
		$this->db->join('flashSaleDetail', 'flashSaleDetail.itemID = itemData.itemID', 'inner');
		$this->db->join('flashSale', 'flashSaleDetail.flashSaleID = flashSale.flashSaleID', 'inner');
		$this->db->join('itemDetail', 'itemDetail.itemID = itemData.itemID', 'inner');

		$this->db->group_by('itemData.itemID');

		
		$query = $this->db->get();
		
        return $query->result_array();
	}
	
	function getProduct($userInput){
        $this->db->query("SET sql_mode = '' ");
		$this->db->select('itemData.*');
        $this->db->select_min('itemPrice', 'itemMinPrice');
        $this->db->select_max('itemPrice', 'itemMaxPrice');
        $this->db->from('itemDetail');
        $this->db->join('itemData', 'itemDetail.itemID = itemData.itemID');
		$this->db->group_by('itemData.itemID');
		
		$this->db->like('itemData.itemName',$userInput);
		$query = $this->db->get();
        return $query->result_array();

	}

    function getCustomerLikedItems($user_id, $itemID){
        $this->db->query("SET sql_mode = '' ");
        $this->db->select('itemID');
        $this->db->from('customerlikeditems');
        if($itemID != NULL){
            $this->db->where('itemID', $itemID);
        }
        else{
            $this->db->where('user_id', $user_id);
        }
        $query = $this->db->get();
        return $query->result_array();
    }

    function getItemFromShoppingCart($user_id){
        $this->db->query("SET sql_mode = '' ");
        $this->db->select('shoppingcart.*, 
                           itemsize.itemSizeName, itemColor.itemColorName, 
                           itemData.itemName, itemData.itemImage, 
                           itemDetail.*, itemDetail.itemPrice');
        $this->db->from('shoppingcart');
        $this->db->join('itemDetail', 'shoppingcart.itemDetailID = itemDetail.itemDetailID', 'inner');
        $this->db->join('itemData', 'itemDetail.itemID = itemData.itemID', 'inner');
        $this->db->join('itemsize', 'itemDetail.itemSizeID = itemsize.itemSizeID', 'inner');
        $this->db->join('itemColor', 'itemDetail.itemColorID = itemColor.itemColorID', 'inner');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    function getTotalPriceFromShoppingCart($user_id){
        $this->db->query("SET sql_mode = '' ");
        $this->db->select('SUM(shoppingcart.itemQuantity * itemDetail.itemPrice) AS totalPrice');
        $this->db->from('shoppingcart');
        $this->db->join('itemDetail', 'shoppingcart.itemDetailID = itemDetail.itemDetailID', 'inner');
        $this->db->where('user_id', $user_id);
        $query = $this->db->get();
        return $query->row();
    }
    
    function getShoppingCartQuantity($shoppingCartID){
        $this->db->query("SET sql_mode = '' ");
        $this->db->select('itemQuantity');
        $this->db->from('shoppingcart');
        $this->db->where('shoppingcartID', $shoppingCartID);
        $query = $this->db->get();
        return $query->row()->itemQuantity;
    }

    function checkShoppingCart($shoppingData){
        $this->db->query("SET sql_mode = '' ");
        $this->db->where('user_id', $shoppingData['user_id']);
        $this->db->where('itemdetailID', $shoppingData['itemdetailID']);
        $query = $this->db->get('shoppingcart');

        if ($query->num_rows() > 0){
            $this->db->where('user_id', $shoppingData['user_id']);
            $this->db->where('itemdetailID', $shoppingData['itemdetailID']);
            $this->db->set('itemQuantity', 'itemQuantity + '.$shoppingData['itemQuantity'], FALSE);
            $this->db->update('shoppingcart');

            return true;
        }
        else{
            return false;
        }
    }

    function checkItemStock($itemDetailID){
        $this->db->query("SET sql_mode = '' ");
        $this->db->select('itemStock');
        $this->db->where('itemDetailID', $itemDetailID);
        $query = $this->db->get('itemDetail');

        return $query->row()->itemStock;
    }

    // UPDATE
    function updateShoppingCart($shoppingCartID, $itemQuantity, $update){
        $this->db->query("SET sql_mode = '' ");
        $this->db->where('shoppingcartID', $shoppingCartID);
        if($update == 1){
            $this->db->set('itemQuantity', 'itemQuantity + '.$itemQuantity, FALSE);
        }
        else if($update == 0){
            $this->db->set('itemQuantity', 'itemQuantity - '.$itemQuantity, FALSE);
        }
        $this->db->update('shoppingcart');

        if($this->getShoppingCartQuantity($shoppingCartID) == 0){
            $this->db->from('shoppingcart');
            $this->db->where('shoppingcartID', $shoppingCartID);
            $this->db->delete();            
        }
    }

    function updateItemDetailStock($itemDetailID, $itemQuantity, $update){
        $this->db->query("SET sql_mode = '' ");
        $this->db->where('itemDetailID', $itemDetailID);
        if($update == 1){
            $this->db->set('itemStock', 'itemStock + '.$itemQuantity, FALSE);
        }
        else if($update == 0){
            $this->db->set('itemStock', 'itemStock - '.$itemQuantity, FALSE);
        }
        $this->db->update('itemDetail');
    }

    // DELETE
    function deleteCustomerLikedItems($user_id, $itemID){
        $this->db->query("SET sql_mode = '' ");
        $this->db->from('customerlikeditems');
        $this->db->where('itemID', $itemID);
        $this->db->where('user_id', $user_id);
        $this->db->delete();
        
        $this->db->where('itemID', $itemID);
        $this->db->set('itemLike', 'itemLike - 1', FALSE);
        $this->db->update('itemData');
    }
}
