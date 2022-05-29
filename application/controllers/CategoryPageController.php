<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryPageController extends CI_Controller{	
    public function __construct(){
        parent::__construct();
        $this->load->model('ProductModel');
	}
	
	public function index(){
		$this->db->query("SET sql_mode = '' ");
		$categoryID = $this->ProductModel->getCategoryID($this->uri->segment(3))->row('itemCategoryID');
		$data['itemGroupList'] = $this->ProductModel->getAllItem($categoryID, NULL, NULL);
		$data['itemCategoryName'] = $this->uri->segment(3);
		$data['customerLikedItems'] = $this->ProductModel->getCustomerLikedItems(18, NULL); // 18 digantikan dg user_id

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$user_id = $data['user']['user_id'];
		$data['shoppingCartList'] = $this->ProductModel->getItemFromShoppingCart($user_id);
		$data['shoppingCartTotalPrice'] = $this->ProductModel->getTotalPriceFromShoppingCart($user_id)->totalPrice;
		
		$data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
		$data['css'] = $this->load->view('include/css.php', NULL, TRUE);
		$data['HeaderView'] = $this->load->view('pages/HeaderView.php', $data, TRUE);
		$data['FooterView'] = $this->load->view('pages/FooterView.php', NULL, TRUE);

		$this->load->view('pages/CategoryPageView.php', $data);
	}

	public function customerLikedItems($itemID = '', $user_id = ''){
		$user_id = $this->input->post('user_id');
		$itemID = $this->input->post('itemID');
		
		if(count($this->ProductModel->getCustomerLikedItems($user_id, $itemID)) != 0){
			$this->ProductModel->deleteCustomerLikedItems($user_id, $itemID);
		}
		else{
			$this->ProductModel->addCustomerLikedItems($user_id, $itemID);
		}
		echo "success";
	}

	// public function addCustomerLikedItems($itemID = '', $username = ''){
	// 	$data = array(
	// 		'username' => $this->uri->segment(5),
	// 		'itemID' => $this->uri->segment(3)
	// 	);
	// 	$this->ProductModel->addCustomerLikedItems($data);
	// 	redirect('CategoryPageController/index/'.$this->uri->segment(4));
	// }

	// public function deleteCustomerLikedItems($itemID = '', $username = ''){
	// 	$data = array(
	// 		'username' => $this->uri->segment(5),
	// 		'itemID' => $this->uri->segment(3)
	// 	);
	// 	$this->ProductModel->deleteCustomerLikedItems($data);
	// 	redirect('CategoryPageController/index/'.$this->uri->segment(4));
	// }
}
