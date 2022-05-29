<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Customer extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('customer_model');
    }

    public function index()
    {
        $this->db->query("SET sql_mode = '' ");
        $data['title'] = 'Administrator';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //ambil data dari session
        $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
        $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
        $data['HeaderView'] = $this->load->view('pages/HeaderView.php', NULL, TRUE);
        $data['FooterView'] = $this->load->view('pages/FooterView.php', NULL, TRUE);

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

    public function invoice()
    {
        is_logged_in();
        $id = $this->input->get('id');
        $this->db->query("SET sql_mode = '' ");
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //ambil data dari session
        $data['order'] = $this->customer_model->get_orders($id)->row_array();
        $data['orders'] = $this->customer_model->get_invoicedata($id);
        $data['receiver'] = $this->customer_model->getreceiver($id);
        $data['invoice'] = $this->customer_model->getInvoice($id)->row_array();
        $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
        $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
        $data['HeaderView'] = $this->load->view('pages/HeaderView.php', NULL, TRUE);
        $data['FooterView'] = $this->load->view('pages/FooterView.php', NULL, TRUE);

        // print_r($data['order']);
        $this->load->view('customer/invoice', $data);
    }

    public function trackOrder($error = '')
    {
        is_logged_in();
        $this->db->query("SET sql_mode = '' ");
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['order'] = $this->customer_model->gettrackorder($data['user']['user_id']);
        // $data['orders'] = $this->customer_model->get_orders($data['user']['transactionID']);
        $data['images'] = $this->customer_model->get_images($data['user']['user_id']);
        $data['error'] = $error;
        $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
        $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
        $data['HeaderView'] = $this->load->view('pages/HeaderView.php', NULL, TRUE);
        $data['FooterView'] = $this->load->view('pages/FooterView.php', NULL, TRUE);

        $this->load->view('customer/trackOrder', $data);
    }
    public function checkout($error = '')
    {
        is_logged_in();
        $data['title'] = 'CheckOut';
        $this->db->query("SET sql_mode = '' ");
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //ambil data dari session
        $data['shoppingcart'] = $this->customer_model->ShowShoppingCart($data['user']['user_id']);
        $data['deliveryService'] = $this->customer_model->get_deliveryService();
        $data['paymentMethod'] = $this->customer_model->get_paymentMethod();

        $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
        $data['css'] = $this->load->view('include/css.php', NULL, TRUE);
        $data['HeaderView'] = $this->load->view('pages/HeaderView.php', NULL, TRUE);
        $data['FooterView'] = $this->load->view('pages/FooterView.php', NULL, TRUE);

        $data['provinsi'] = $this->customer_model->view();

        $data['jsArray'] = "var hrg_brg = new Array();\n";

        $data['error'] = $error;

        if ($data['shoppingcart'] == NULL) {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><b>Please choose an item.</b></div>');
            redirect('HomePageController', $data);
        } else {
            echo 'Selamat Datang ' . $data['user']['name'];
            $this->load->view('customer/checkout', $data);
        }
    }


    public function listKota()
    {
        // Ambil data ID Provinsi yang dikirim via ajax post
        $id_provinsi = $this->input->post('provinsiID');

        $kota = $this->customer_model->viewByProvinsi($id_provinsi);

        // Buat variabel untuk menampung tag-tag option nya
        // Set defaultnya dengan tag option Pilih
        $lists = "<option value=''>Pilih</option>";

        foreach ($kota as $data) {
            $lists .= "<option value='" . $data->kotaID . "'>" . $data->kota . "</option>"; // Tambahkan tag option ke variabel $lists
        }

        $callback = array('list_kota' => $lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_kota
        echo json_encode($callback); // konversi varibael $callback menjadi JSON
    }



    public function AddTransaction()
    {
        
        $this->db->query("SET sql_mode = '' ");
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //ambil data dari session
        $data['shoppingcart'] = $this->customer_model->ShowShoppingCart($data['user']['user_id']);

        if ($this->FormValidation()) {
            $name = $this->input->post('name');
            $address = $this->input->post('address');
            $city = $this->input->post('kota');
            // $state = $this->input->post('state');
            $zipcode = $this->input->post('zipcode');
            $deliveryservice = $this->input->post('deliveryservice');
            $total = $this->input->post('totalhidden');

            $paymentmethod = $this->input->post('paymentmethod');


            $this->customer_model->AddReceiver($name, $address, $zipcode, $city, $deliveryservice, $paymentmethod);

            $data['receiver'] = $this->db->query('SELECT * FROM receiver WHERE ReceiverName LIKE "' . $name . '" ORDER BY receiverID DESC LIMIT 1')->row_array();
            $data['promo'] = $this->db->query('SELECT * FROM promo')->result_array();

            $this->customer_model->AddProducttoTransaction($data['user']['user_id'], $data['shoppingcart'], $data['receiver'], $data['promo'], $total);

            $data['transaction'] = $this->customer_model->get_transaction();
            $trns_id = $data['transaction']->transactionID;

            $this->customer_model->AddTransactionDetail($data['shoppingcart'], $trns_id);
            $this->customer_model->AddInvoice($trns_id);

            $this->customer_model->hapus($data['shoppingcart'], $data['user']['user_id']);
            
            redirect('customer/trackOrder');
        } else {
            $this->checkout();
        }
    }

    public function promo($id)
    {
        $this->db->query("SET sql_mode = '' ");
        $data['title'] = 'CheckOut';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //ambil data dari session
        $data['shoppingcart'] = $this->customer_model->ShowShoppingCart($data['user']['user_id']);

        $data['promo'] = $this->customer_model->getpromo();

        $promo = $this->input->post('promo');
        $ada = 0;


        foreach ($data['promo'] as $row) {
            if ($promo == $row['KodePromo']) {
                $disc = $row['PromoDisc'];
                $kodepromo = $row['KodePromo'];
                $ada = 1;
                break;
            }
        }

        if ($ada == 1) {
            $this->session->set_flashdata('promo', $disc);
            $this->session->set_flashdata('kodepromo', $kodepromo);
            $this->db->query('UPDATE shoppingcart SET KodePromo = "' . $promo . '" WHERE shoppingcartID= ' . $id);

            redirect('customer/checkout');
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><b> Can not apply promo. </b></div>');
            redirect('customer/checkout');
        }
    }

    public function BuktiPayment($id)
    {
        is_logged_in();
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array();
        $data['order'] = $this->customer_model->get_orders($data['user']['user_id']);
        $data['shoppingcart'] = $this->customer_model->ShowShoppingCart($data['user']['user_id']);


        $name = $data['user']['name'];

        $config['upload_path'] = './assets/buktipayment';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = $name . '_' . $id;
        $config['max-size'] = 1024;
        $config['max_width'] = 1024;
        $config['max_height'] = 1024;
        $this->load->library('upload', $config);
        $this->upload->initialize($config);


        if (!$this->upload->do_upload('pay')) {
            $error = $this->upload->display_errors();
            $this->trackOrder($error);
        } else {
            $error = '';
            $bukti = 'assets/buktipayment/' .  $this->upload->data('file_name');

            $this->db->where('transactionID', $id);
            $this->db->set('BuktiPayment', $bukti);
            $this->db->update('transaction');

            foreach ($data['shoppingcart'] as $row) {
                $qty = $this->db->query('SELECT itemStock FROM itemDetail i JOIN shoppingcart s USING (itemdetailID) WHERE i.itemDetailID =' .  $row->itemDetailID)->row_array();
                $stock = $qty['itemStock'] - 1;

                $this->db->where('itemDetailID', $row->itemDetailID);
                $this->db->set('itemStock', $stock);
                $this->db->update('itemDetail');
            }
            redirect('customer/trackOrder', $error);
        }
	}
	
    //RULES
    public function FormValidation()
    {
        $rules = array(
            array(
                'field' => 'name',
                'label' => 'name',
                'rules' => 'required|trim',
                'errors' => array(
                    'required' => 'You must provide a string.'
                )
            ),
            array(
                'field' => 'address',
                'label' => 'address',
                'rules' => 'required|trim',
                'errors' => array(
                    'required' => 'You must provide a %s.'
                )
            ),
            array(
                'field' => 'kota',
                'label' => 'kota',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must choose a city.'
                )
            ),
            array(
                'field' => 'provinsi',
                'label' => 'provinsi',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must choose a province.'
                )
            ),
            array(
                'field' => 'deliveryservice',
                'label' => 'deliveryservice',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide a %s.'
                )
            ),
            array(
                'field' => 'paymentmethod',
                'label' => 'paymentmethod',
                'rules' => 'required',
                'errors' => array(
                    'required' => 'You must provide a %s.'
                )
            ),
            array(
                'field' => 'zipcode',
                'label' => 'zipcode',
                'rules' => 'required|trim',
                'errors' => array(
                    'required' => 'You must provide a number.'
                )
            )
        );

        $this->form_validation->set_rules($rules);
        if ($this->form_validation->run() == false) {
            echo "false";
            return false;
        } else {
            return true;
        }
    }
}
