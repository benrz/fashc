<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();

        //ga bs msuk klo blm login sbg admin
        // if(!$this->session->userdata('email')){ 
        //     redirect('auth');
        // }

        is_logged_in(); //cek uda login atau belom dan cek role ny apa
    }
    public function index()
    {
        $this->db->query("SET sql_mode = '' ");
        $data['title'] = 'Home';
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //ambil data dari session

        // echo 'Selamat Datang ' . $data['user']['name'];

        //$this->load->view('admin/home', $data);
        redirect('CMSController/CMS');
    }
}
