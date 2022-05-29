<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ShoppingCartController extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('ProductModel');
	}

	public function index()
	{
		is_logged_in();
		//$user_id = $this->input->post('user_id');
        $this->db->query("SET sql_mode = '' ");
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
		$user_id = $data['user']['user_id'];
		// echo $user_id;
		if ($this->input->post('itemDetailIDHidden')) {
			$shoppingData = array(
				'user_id' => $user_id,
				'itemdetailID' => $this->input->post('itemDetailIDHidden'),
				'itemQuantity' => $this->input->post('itemQuantityHidden')
			);

			// Tambah barang ke shoppingcart kalau stock masih tersedia / lebih besar dari jumlah barang yang dibeli
			if ($this->ProductModel->checkItemStock($shoppingData['itemdetailID']) >= $shoppingData['itemQuantity']) {
				// Kalau TRUE, berarti barang dan pemesan yg sama sudah ada, tinggal di update quantity
				// Kalau FALSE, barang dan pemesan yg sama blm ada, tambahin item baru di shoppingcart
				$dataExist = $this->ProductModel->checkShoppingCart($shoppingData);
				if (!$dataExist) {
					$this->ProductModel->addItemToShoppingCart($shoppingData);
				}

				$this->ProductModel->updateItemDetailStock($shoppingData['itemdetailID'], $shoppingData['itemQuantity'], 0);
			}
		}

		$data['shoppingCartList'] = $this->ProductModel->getItemFromShoppingCart($user_id);
		$data['shoppingCartTotalPrice'] = $this->ProductModel->getTotalPriceFromShoppingCart($user_id)->totalPrice;

		$data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
		$data['css'] = $this->load->view('include/css.php', NULL, TRUE);
		$data['HeaderView'] = $this->load->view('pages/HeaderView.php', $data, TRUE);
		$data['FooterView'] = $this->load->view('pages/FooterView.php', NULL, TRUE);

		$this->load->view('pages/ShoppingCartView.php', $data);
	}

	public function updateCart()
	{
		$itemDetailID = $this->input->post('itemDetailID');
		$update = $this->input->post('update');
		$shoppingCartID = $this->input->post('shoppingCartID');

		$this->ProductModel->updateShoppingCart($shoppingCartID, 1, $update);
		$update == 1 ? $update = 0 : $update = 1;
		$this->ProductModel->updateItemDetailStock($itemDetailID, 1, $update);
	}

	public function deleteCart()
	{
		$itemDetailID = $this->input->post('itemDetailID');
		$itemQuantity = $this->input->post('itemQuantity');
		$shoppingCartID = $this->input->post('shoppingCartID');

		$this->ProductModel->updateShoppingCart($shoppingCartID, $itemQuantity, 0);
		$this->ProductModel->updateItemDetailStock($itemDetailID, $itemQuantity, 1);
	}

	public function checkItemStock()
	{
		$itemDetailID = $this->input->post('itemDetailID');
		$itemQuantity = $this->input->post('itemQuantity');

		if ($this->ProductModel->checkItemStock($itemDetailID) >= $itemQuantity) {
			echo "Sufficient";
		} else {
			echo "Insufficient Item Stock";
		}
	}

	public function transaction()
	{
		$hiddenArrayObj = json_decode($this->input->post('hiddenData'));
		$user_id = $this->input->post('user_id');

		foreach ($hiddenArrayObj as $hiddenArray) {
			$this->ProductModel->updateShoppingCart($hiddenArray, $user_id);
		}

		redirect('customer/checkout');
	}
}
