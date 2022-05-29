<?php
defined('BASEPATH') or exit('No direct script access allowed');

class shoppingCart extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('customer_model');
    }

    public function index()
    {
        $data['title'] = 'Administrator';
		$data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //ambil data dari session
		
		$data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
		$data['css'] = $this->load->view('include/css.php', NULL, TRUE);
		$data['HeaderView'] = $this->load->view('pages/HeaderView.php', NULL, TRUE);
		$data['FooterView'] = $this->load->view('pages/FooterView.php', NULL, TRUE);

        echo 'Selamat Datang ' . $data['user']['name'];

        $this->load->view('customer/home', $data);
    }

    public function shoppingcart()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //ambil data dari session
		$data['shoppingcart'] = $this->customer_model->ShowShoppingCart($data['user']['user_id']);
		
		$data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
		$data['css'] = $this->load->view('include/css.php', NULL, TRUE);
		$data['HeaderView'] = $this->load->view('pages/HeaderView.php', NULL, TRUE);
		$data['FooterView'] = $this->load->view('pages/FooterView.php', NULL, TRUE);

        $this->load->view('customer/shoppingCart', $data);
        
    }

    public function plusItem()
    {
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //ambil data dari session
		$data['shoppingcart'] = $this->customer_model->ShowShoppingCart($data['user']['user_id']);

        echo "hai";
        $this->load->view('customer/shoppingCart', $data);
    }

    public function hapus($id)
    {
        $this->db->where('shoppingCartID', $id);
        $this->db->delete('shoppingcart');
        redirect('shoppingCart/shoppingcart');
    }

    public function plus($id)
    {
        $item = $this->db->query('SELECT itemQuantity FROM shoppingcart WHERE shoppingcartID =' . $id)->row_array();
        $qty = ($item['itemQuantity'] + 1);

        $this->db->where('shoppingcartID', $id);
        $this->db->set('itemQuantity', $qty);
        $this->db->update('shoppingcart');

        redirect('shoppingCart/shoppingcart');
    }

    public function minus($id)
    {
        $item = $this->db->query('SELECT itemQuantity FROM shoppingcart WHERE shoppingcartID =' . $id)->row_array();
        $qty = ($item['itemQuantity'] - 1);

        $this->db->where('shoppingcartID', $id);
        $this->db->set('itemQuantity', $qty);
        $this->db->update('shoppingcart');

        redirect('shoppingCart/shoppingcart');
    }
}
