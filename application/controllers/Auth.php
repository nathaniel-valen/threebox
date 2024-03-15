<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller

{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('form_validation');
    }

    public function index() {
        $data['title'] = "My Profile";
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        // Mengambil data film dari tabel dalam database
        $data['film'] = $this->db->get('film')->result_array();
        $data['coming'] = $this->db->get('film_coming')->result_array();
        $data['bioskop'] = $this->db->get('bioskop')->result_array();
        
        // Memuat view beserta data yang sudah diambil
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar-awal');
        $this->load->view('templates/topbar-awal', $data);
        $this->load->view('index', $data);
        $this->load->view('templates/footer');
    }



    public function login()
    {
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Threebox - Login';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/login.php');
            $this->load->view('templates/auth_footer');
        } else {
            // validasi sukses, masuk ke proses verifikasi
            $this->_login();
        }
    }

    private function _login()
    {
        $username = htmlspecialchars($this->input->post('username'));
        $password = $this->input->post('password');

        $user = $this->db->get_where('user', ['username' => $username])->row_array();
        // jika usernya ada
        if ($user) {
            // jika usernya aktif
            if ($user['is_active'] == 1) {
                // cek password
                if (password_verify($password, $user['password'])) {
                    $data = [
                        'username' => $user['username'],
                        'role_id' => $user['role_id']
                    ];
                    $this->session->set_userdata($data);
                    if($user['role_id'] == 1) {
                        redirect('apusat');
                    } else if ($user['role_id'] == 2) {
                        redirect('abioskop');
                    } else if($user['role_id'] == 3 ) {
                        redirect('kasir');
                    } else {
                        redirect('user');
                    }
                } else {
                    $this->session->set_flashdata('message', '<small><div class="alert alert-danger" role="alert">
                    Wrong password!
                    </div></small>');
                    redirect('auth/login');
                }
            } else {
                $this->session->set_flashdata('message', '<small><div class="alert alert-danger" role="alert">
                This Username has not been activated!
                </div></small>');
                redirect('auth/login');
            }
        } else {
            $this->session->set_flashdata('message', '<small><div class="alert alert-danger" role="alert">
            Username is not registered
            </div></small>');
            redirect('auth/login');
        }
    }

    public function registration()
    {
        $this->form_validation->set_rules('name', 'Fullname', 'required|trim');
        $this->form_validation->set_rules('username', 'Username', 'required|trim|is_unique[user.username]', [
            'is_unique' => 'This username has already been registered.'
        ]);
        $this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[3]|matches[password2]', [
            'matches' => 'Passwords do not match!',
            'min_length' => 'Password too short!'
        ]);
        $this->form_validation->set_rules('password2', 'Password Confirmation', 'required|trim|matches[password1]');
    
        $this->form_validation->set_rules('jenisKelamin', 'Jenis Kelamin', 'required|trim|callback_validate_jenis_kelamin');
    
        if ($this->form_validation->run() == false) {
            $data['title'] = 'Threebox - Registration';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration.php');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('name', true)),
                'username' => htmlspecialchars($this->input->post('username', true)),
                'jenis_kelamin' => htmlspecialchars($this->input->post('jenisKelamin', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
                'role_id' => 4,
                'is_active' => 1,
                'date_created' => time()
            ];
    
            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<small><div class="alert alert-success" role="alert">
            Congratulations! Your account has been created. Please login.
            </div></small>');
            redirect('auth/login');
        }
    }

    
    
    public function validate_jenis_kelamin($value)
    {
        if ($value != 'Laki-Laki' && $value != 'Perempuan') {
            $this->form_validation->set_message('validate_jenis_kelamin', 'KAMI #antiLGBT');
            return false;
        } else {
            return true;
        }
    }
    
    
    public function logout() {
        $this->session->unset_userdata('username');
        $this->session->unset_userdata('role_id');
        $this->session->set_flashdata('message', '<small><div class="alert alert-success" role="alert">
        You have been logged
        </div></small>');
        redirect('auth/login');
    }
}
