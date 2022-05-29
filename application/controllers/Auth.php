<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->model('ProductModel');
    }

    public function index()
    {
        $this->db->query("SET sql_mode = '' ");
        $data['js'] = $this->load->view('include/javascript.php', NULL, TRUE);
        $data['css'] = $this->load->view('include/css.php', NULL, TRUE);

        if ($this->session->userdata('email')) {
            redirect(base_url());
        }
        // validasi
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');


        if ($this->form_validation->run() == false) { //run sebuah method jd hrs ada ()
            //panggil view login
            $this->load->view('auth/login', $data);
        } else {
            //validasi sukses pndah method
            $this->_login(); //login di buat private biar nnti ga bs msuk lwt url
        }
    }

    private function _login()
    {
        $this->db->query("SET sql_mode = '' ");
        $email = $this->input->post('email');
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['email' => $email])->row_array(); //select * from table 'user' [where]
        // var_dump($query); //utk cek ada datanya atau ngga
        // die; //berhentiin script smpe di sini

        if ($user) { //user ada
            // jika user aktif
            if ($user['is_active'] == 1) {
                //cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'email' => $user['email'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data); //org yg login psti pny session (bs digunakan untuk security nntinya)
                    if ($user['role_id'] == 1) {
                        redirect('Admin');
                    } else {
                        redirect(base_url());
                    }
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><b>Wrong Password!</b></div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><b>This email has not been activated!</b></div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><b>Email is not registered!</b></div>');
            redirect('auth');
        }
    }

    public function register()
    {
        $this->db->query("SET sql_mode = '' ");
        if ($this->session->userdata('email')) {
            redirect('HomePageController');
        }

        //rule : required , trim (klo ada spasi ga msuk db), is_unique buat bikin field unique, matches biar bs match
        $this->form_validation->set_rules('name', 'Name', 'required|trim');
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[user.email]', [
            'is_unique' => 'This email has already registered!'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]', [
            //klo rule matches dan password ga sama -> ga pke ini jg bs uda ada default nya
            'matches' => 'Password do not match!',
            'min_length' => 'Password too short'
        ]);
        $this->form_validation->set_rules('password2', 'Password', 'required|trim|matches[password1]');

        //if klo regis kosong
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Fasch Online Shop';
            $this->load->view('auth/register', $data);
        } else {
            $email = $this->input->post('email', TRUE);
            $data = [ //harus urut db
                'email' => htmlspecialchars($email),
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT), //enkripsi
                'name' => htmlspecialchars($this->input->post('name', TRUE)), //true utk hindarin XSS
                'image' => 'default.jpg',
                'date_created' => time(), //ambil detik register
                'role_id' => 2,
                'is_active' => 1
            ];

            //siapin token 
            $token = base64_encode(random_bytes(32)); //32 digit random bytes dibungkus encode jd manusia bs baca

            $user_token = [
                'email' => $email,
                'token' => $token,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->db->insert('user_token', $user_token);


            $this->sendEmail($token, 'verify'); //parameter kedua itu fitur 

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><b>Your account has been created. Please Activate your account</b></div>');
            redirect('auth');
        }
    }

    private function sendEmail($token, $type)
    {
        $config = [
            'protocol'  => 'SMTP',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user' => 'fasch.onlineshop@gmail.com',
            'smtp_pass' => 'uaspemweb19',
            'smtp_port' => 465,
            'smtp_crypto' => 'SSL',
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n"
        ];

        // $this->load->library('email');
        $this->email->initialize($config);

        $this->email->from('fasch.onlineshop@gmail.com', 'Fasch Online Shop');
        $this->email->to($this->input->post('email'));

        if ($type == 'verify') {
            $this->email->subject('Account Activation');
            $this->email->message('Click this link to activate your account : <a href ="' . base_url() . 'auth/verify?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '"> Activate </a>'); //urlencode untuk encode ke url jd klo ada spasi bs d translate ke %20 dll
        } else if ($type == 'forgot') {
            $this->email->subject('Reset Password');
            $this->email->message('Click this link to reset your password : <a href ="' . base_url() . 'auth/resetpassword?email=' . $this->input->post('email') . '&token=' . urlencode($token) . '"> Reset Password </a>');
        }
        if (!$this->email->send()) {
            echo $this->email->print_debugger(); //print error
            die;
        } else {
            return true;
        }
        
    }

    public function verify()
    {
        $this->db->query("SET sql_mode = '' ");
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) { //untuk cek email ada d db ga, biar secure
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();

            if ($user_token) { //cek token
                if (time() - $user_token['date_created'] < 86401) { //token berlaku sehari

                    $this->db->set('is_active', 1);
                    $this->db->where('email', $email);
                    $this->db->update('user');

                    $this->db->delete('user_token', ['email' => $email]); //delete token aja

                    $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><b>' . $email . ' has been activated. Please login! </b></div>');
                    redirect('auth');
                } else {
                    $this->db->delete('user', ['email' => $email]); //delete user
                    $this->db->delete('user_token', ['email' => $email]); //delete token

                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><b>Account activation failed! Token expired. </b></div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><b>Account activation failed! Wrong token. </b></div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><b>Account activation failed! Wrong email. </b></div>');
            redirect('auth');
        }
    }

    public function logout()
    {
        $this->db->query("SET sql_mode = '' ");
        //untuk bersihin session
        $this->session->unset_userdata('email');
        $this->session->unset_userdata('role_id');

        $this->session->set_flashdata('message', '<alert class="alert alert-success" role="alert"><b>You have been logged out!</b></alert>');
        redirect(base_url());
    }

    //forgotpassword
    public function forgotPassword()
    {
        $this->db->query("SET sql_mode = '' ");
        $this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Forgot Password';
            $this->load->view('auth/forgot-password', $data);
        } else {
            $email = $this->input->post('email');
            $user = $this->db->get_where('user', ['email' => $email, 'is_active' => 1])->row_array();

            if ($user) {
                $token = base64_encode(random_bytes(32));
                $user_token = [
                    'email' => $email,
                    'token' => $token,
                    'date_created' => time()
                ];

                $this->db->insert('user_token', $user_token);

                $this->sendEmail($token, 'forgot');

                $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><b>Please check your email to reset your password!</b></div>');
                redirect('auth/forgotpassword');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><b>Email is not registered or activated!</b></div>');
                redirect('auth/forgotpassword');
            }
        }
    }

    public function resetPassword()
    {
        $this->db->query("SET sql_mode = '' ");
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        $user = $this->db->get_where('user', ['email' => $email])->row_array();

        if ($user) {
            $user_token = $this->db->get_where('user_token', ['token' => $token])->row_array();
            if ($user_token) {
                if (time() - $user_token['date_created'] < 86401) { //token berlaku sehari
                    $this->session->set_userdata('reset_email', $email);
                    $this->changePassword();
                } else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><b>Reset Password failed! Token expired. </b></div>');
                    redirect('auth');
                }
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><b>Reset password failed! Wrong token.</b></div>');
                redirect('auth');
            }
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert"><b>Reset password failed! Wrong email.</b></div>');
            redirect('auth');
        }
    }

    public function changePassword()
    {
        $this->db->query("SET sql_mode = '' ");
        if (!$this->session->userdata('reset_email')) {
            redirect('auth');
        }

        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[8]|matches[password2]');
        $this->form_validation->set_rules('password2', 'Repeat New Password', 'required|trim|min_length[8]|matches[password1]');

        if ($this->form_validation->run() == false) {
            $data['title'] = 'Change Password';
            $this->load->view('auth/change-password', $data);
        } else {
            $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
            $email = $this->session->userdata('reset_email');

            $this->db->set('password', $password);
            $this->db->where('email', $email);
            $this->db->update('user');

            $this->session->unset_userdata('reset_email');

            $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert"><b>Password has been changed. Please login! </b></div>');
            redirect('auth');
        }
    }

    public function profile($error = '')
    {
        is_logged_in();
        $this->db->query("SET sql_mode = '' ");
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //ambil data dari session
        $data['error'] = $error;

        $this->load->view('auth/profile', $data);
    }

    public function updateProfile()
    {
        is_logged_in();
        $this->db->query("SET sql_mode = '' ");
        $data['user'] = $this->db->get_where('user', ['email' => $this->session->userdata('email')])->row_array(); //ambil data dari session

        $name = $this->input->post('name');

        if ($this->input->post('password1') == null) {
            $password = $this->input->post('pass_lama');
            $value = [
                'name' => $name,
                'password' => $password
            ];

            $this->db->where('email', $data['user']['email']);
            $this->db->update('user', $value);

            $this->session->set_flashdata('update', '<div class="alert alert-success" role="alert"><b>Your account has been edited.</b></div>');
        } else {
            $this->form_validation->set_rules('password1', 'Password', 'trim|min_length[8]|matches[password2]', [
                'matches' => 'Password do not match!',
                'min_length' => 'Password too short'
            ]);
            $this->form_validation->set_rules('password2', 'Password', 'trim|matches[password1]');

            if ($this->form_validation->run() == false) {
                $this->load->view('auth/profile', $data);
                $this->session->set_flashdata('update', '<div class="alert alert-danger" role="alert"><b>Password do not match or Password too short!</b></div>');
            } else {
                $password = password_hash($this->input->post('password1'), PASSWORD_DEFAULT);
                $value = [
                    'name' => $name,
                    'password' => $password
                ];

                $this->db->where('email', $data['user']['email']);
                $this->db->update('user', $value);

                $this->session->set_flashdata('update', '<div class="alert alert-success" role="alert"><b>Your account has been edited.</b></div>');
            }
        }

        redirect('auth/profile');
    }
   
    public function updatePhoto()
    {
        $post = $this->input->post();

        $name = $post['name'];
        $email = $post['email'];

        $config['upload_path']          = './assets/img/profile';
        $config['allowed_types']        = 'gif|jpg|png';
        $config['file_name']            = $name;
        $config['overwrite']            = false;
        $config['max_width']            = 1024;
        $config['max_height']           = 1024;

        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        

        if (!$this->upload->do_upload('photo')) {
            $photo = $post['old-photo'];
        } else {
            $photo = 'assets/img/profile/' . $this->upload->data('file_name');
            $error = $this->upload->display_errors();
            $this->profile($error);
        }
        $this->db->query("SET sql_mode = '' ");
        $this->db->set('image', $photo);
        $this->db->where('email', $email);
        $this->db->update('user');

        redirect('auth/profile');
    }
}
