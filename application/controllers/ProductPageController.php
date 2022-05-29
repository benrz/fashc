<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ProductPageController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ProductModel');
		$this->load->model('customer_model');
	}

	public function index()
	{
		$itemID = $this->uri->segment(3);
		$itemName = $this->uri->segment(4);
		$data['itemDetails'] = $this->ProductModel->getItemDetail($itemID, $itemName);
		$categoryID = $data['itemDetails'][0]['itemCategoryID'];
		$data['relatedItem'] = $this->ProductModel->getAllItem($categoryID, NULL, NULL);
		$data['itemCategory'] = $this->ProductModel->getItemCategory();
		$data['rating_comment'] = $this->customer_model->getRating($itemID);
		// print_r($data['rating_comment']);
		$data['comment'] = $this->customer_model->getComment($itemID);

		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$user_id = $data['user']['user_id'];
		$data['user_id'] = $user_id;
		$data['customerLikedItems'] = $this->ProductModel->getCustomerLikedItems($user_id, NULL);
		$data['shoppingCartList'] = $this->ProductModel->getItemFromShoppingCart($user_id);
		$data['shoppingCartTotalPrice'] = $this->ProductModel->getTotalPriceFromShoppingCart($user_id)->totalPrice;

		if ($this->ProductModel->getItemPrice(0, $itemID) != $this->ProductModel->getItemPrice(1, $itemID)) {
			$data['itemPrice'] = $this->ProductModel->getItemPrice(0, $itemID)->itemPrice . ' ~ ' . $this->ProductModel->getItemPrice(1, $itemID)->itemPrice;
		} else {
			$data['itemPrice'] = $this->ProductModel->getItemPrice(0, $itemID)->itemPrice;
		}

		$data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
		$data['css'] = $this->load->view('include/css.php', NULL, TRUE);
		$data['HeaderView'] = $this->load->view('pages/HeaderView.php', $data, TRUE);
		$data['FooterView'] = $this->load->view('pages/FooterView.php', NULL, TRUE);

		$this->load->view('pages/ProductPageView.php', $data);
	}

	public function customerLikedItems($itemID = '', $user_id = '')
	{
		$user_id = $this->input->post('user_id');
		$itemID = $this->input->post('itemID');

		if (count($this->ProductModel->getCustomerLikedItems($user_id, $itemID)) != 0) {
			$this->ProductModel->deleteCustomerLikedItems($user_id, $itemID);
		} else {
			$this->ProductModel->addCustomerLikedItems($user_id, $itemID);
		}
		echo "success";
	}

	public function kirimKomen()
	{
		$itemID = $this->uri->segment(3);
        $this->db->query("SET sql_mode = '' ");
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$isi_komentar = $this->input->post('isi_komentar');
		$rating = $this->input->post('rating');

		$this->db->query("INSERT INTO comment(itemID, CommentStatus, CommentName, CommentEmail, CommentIsi) VALUES('$itemID', '0', '$nama','$email','$isi_komentar')");
		
		$this->db->where('itemID', $itemID);
		$this->db->set("itemRating", "(itemRating + $rating)/2", FALSE);
		$this->db->update('itemData');

		redirect('ProductPageController/index/' . $itemID);
	}

}
