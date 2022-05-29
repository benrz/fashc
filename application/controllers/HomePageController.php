<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class HomePageController extends CI_Controller{	
    public function __construct(){
        parent::__construct();
        $this->load->model('ProductModel');
	}
	
	public function index(){
		// $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();

		$data['itemCategory'] = $this->ProductModel->getItemCategory();
		$data['flashSales'] = $this->ProductModel->getFlashSale();

		$data['data'] = $this->ProductModel->getAllItem(NULL, NULL, NULL);
		$data['customerLikedItems'] = $this->ProductModel->getCustomerLikedItems(18, NULL); // BennyRichardson digantikan dg user_id

		//$user_id = $this->input->post('user_id');
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$user_id = $data['user']['user_id'];
		$data['user_id'] = $user_id;
		$data['shoppingCartList'] = $this->ProductModel->getItemFromShoppingCart($user_id);
		$data['shoppingCartTotalPrice'] = $this->ProductModel->getTotalPriceFromShoppingCart($user_id)->totalPrice;

		$data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
		$data['css'] = $this->load->view('include/css.php', NULL, TRUE);
		$data['HeaderView'] = $this->load->view('pages/HeaderView.php', $data, TRUE);
		$data['FooterView'] = $this->load->view('pages/FooterView.php', NULL, TRUE);

		$config['base_url'] = base_url('HomePageController/index');
		$config['total_rows'] = count($data['data']); //total row
        $config['per_page'] = 16;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
		$config["num_links"] = floor($choice);
		
        $config['full_tag_open']    = '<div class="pagination-style mt-30 text-center"><ul>';
        $config['full_tag_close']   = '</ul></div>';
        $config['num_tag_open']     = '<li>';
        $config['num_tag_close']    = '</li>';
        $config['cur_tag_open']     = '<li class="active"><span class="page-link">';
		$config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
		
        $config['next_tag_open']    = '<li class="page-item">';
        $config['next_tagl_close']  = '</li>';
        $config['prev_tag_open']    = '<li class="page-item">';
        $config['prev_tagl_close']  = '</li>';

		$this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['itemAll'] = $this->ProductModel->getAllItem(NULL, $config["per_page"], $data['page']);           
		$data['pagination'] = $this->pagination->create_links();
		
		$this->load->view('pages/HomePageView.php', $data);
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
}
