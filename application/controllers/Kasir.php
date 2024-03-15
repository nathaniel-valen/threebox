<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kasir extends CI_Controller
{
    public function index() {
        $data['title'] = "Dashboard";
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kasir/index', $data);
        $this->load->view('templates/footer');
    }
    
    // =============================================================== FUNCTION BOOKING ===============================================================
    public function booking($id_bioskop) {
        $data['title'] = "Jadwal Bioskop";
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $this->db->select('jadwal.*, film.judul as nama_film');
        $this->db->from('jadwal');
        $this->db->join('film', 'jadwal.film_id = film.id');
        $this->db->where('jadwal.id_bioskop', $id_bioskop);
        $data['jadwal'] = $this->db->get()->result_array();

        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kasir/booking', $data);
        $this->load->view('templates/footer');
    }
    // =============================================================== FUNCTION BOOKING END ===============================================================
    public function bioskop(){
        $data['title'] = "Menu Management Bioskop";
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $data['bioskop'] = $this->db->get('bioskop')-> result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kasir/bioskop', $data);
        $this->load->view('templates/footer');

    }

}