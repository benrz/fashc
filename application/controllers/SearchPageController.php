<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SearchPageController extends CI_Controller{	
    public function __construct(){
        parent::__construct();
        $this->load->model('ProductModel');
	}

	public function index(){
		// $categoryID = $this->ProductModel->getCategoryID($this->uri->segment(3))->row('itemCategoryID');
		// $data['itemGroupList'] = $this->ProductModel->getAllItem($categoryID);
		// $data['itemCategoryName'] = $this->uri->segment(3);
		$data['customerLikedItems'] = $this->ProductModel->getCustomerLikedItems(18, NULL); // 18 digantikan dg user_id
		
		$data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
		$data['css'] = $this->load->view('include/css.php', NULL, TRUE);
		$data['HeaderView'] = $this->load->view('pages/HeaderView.php', NULL, TRUE);
		$data['FooterView'] = $this->load->view('pages/FooterView.php', NULL, TRUE);

		$this->load->view('pages/SearchPageView.php', $data);
	}

	public function search(){
	    $this->db->query("SET sql_mode = '' ");
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$user_id = $data['user']['user_id'];
		$data['shoppingCartList'] = $this->ProductModel->getItemFromShoppingCart($user_id);
		$data['shoppingCartTotalPrice'] = $this->ProductModel->getTotalPriceFromShoppingCart($user_id)->totalPrice;

		$data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
		$data['css'] = $this->load->view('include/css.php', NULL, TRUE);
		$data['HeaderView'] = $this->load->view('pages/HeaderView.php', $data, TRUE);
		$data['FooterView'] = $this->load->view('pages/FooterView.php', NULL, TRUE);

		$data['customerLikedItems'] = $this->ProductModel->getCustomerLikedItems(18, NULL);
		$data['userInput'] =  $this->input->post('userInput');
		$data['itemSearchName'] = $this->ProductModel->getProduct($data['userInput']);
		$this->load->view('pages/SearchPageView.php', $data);
	}

}
?>
