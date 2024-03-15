<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
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
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/index', $data);
        $this->load->view('templates/footer');
    }

    public function detail() {
        $data['title'] = "Detail Film";
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        // Mengambil data film dari tabel 'film' dalam database
        $data['film'] = $this->db->get('film')->result_array();
        
        // Memuat view beserta data yang sudah diambil
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/detail', $data);
        $this->load->view('templates/footer');
    }

    public function seat() {
        $data['title'] = "Detail Film";
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        
        // Memuat view beserta data yang sudah diambil
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/seat', $data);
        $this->load->view('templates/footer');
    }

    public function booking() {
        $data['title'] = "Booking Film";
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        // Mengambil data film dari tabel 'film' dalam database
        $data['film'] = $this->db->get('film')->result_array();
		$film_id = $this->input->post('film_id'); // Ambil film_id dari $_POST

		$sql = "SELECT jadwal.id_jadwal, bioskop.nama_bioskop, jadwal.id_bioskop, film.id, film.judul, jadwal.id_studio, jadwal.jam_tayang, jadwal.tanggal 
				FROM bioskop 
				LEFT JOIN jadwal ON jadwal.id_bioskop = bioskop.id 
				LEFT JOIN film ON jadwal.film_id = film.id 
				WHERE jadwal.id_bioskop IS NOT NULL AND film.id = $film_id"; // Filter berdasarkan film_id

		$data['jadwal'] = $this->db->query($sql)->result_array();

        // Memuat view beserta data yang sudah diambil
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar');
        $this->load->view('templates/topbar', $data);
        $this->load->view('user/booking', $data);
        $this->load->view('templates/footer');
    }

    public function invoice() {
        $data['title'] = "Booking Film";
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

         // Memuat view beserta data yang sudah diambil
         $this->load->view('templates/header', $data);
         $this->load->view('templates/sidebar');
         $this->load->view('templates/topbar', $data);
         $this->load->view('user/invoice', $data);
         $this->load->view('templates/footer');
    }

}
