<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ABioskop extends CI_Controller
{
    public function index() {
        $data['title'] = "Dashboard";
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('abioskop/index', $data);
        $this->load->view('templates/footer');
    }
// =============================================================== FUNCTION FILM ===============================================================
public function film() {
    $data['title'] = "Menu Management Film";
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    
    $this->form_validation->set_rules('judulFilm', 'JudulFilm', 'required');
    $this->form_validation->set_rules('durasi', 'Durasi', 'required');
    $this->form_validation->set_rules('image', 'Image', 'callback_upload_image');
    $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');
    
    $data['film'] = $this->db->get('film')->result_array();
    
    if ($this->form_validation->run() == false) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('abioskop/film', $data);
        $this->load->view('templates/footer');
    } else {
        $uploaded_image = $this->upload_image();
        
        if (!$uploaded_image) {
            $this->session->set_flashdata('error_message', '<small><div class="alert alert-danger col-lg-6" role="alert">Failed to upload image.</div></small>');
            redirect('abioskop/film');
        }
        
        $this->db->insert('film', [
            'judul' => $this->input->post('judulFilm'),
            'durasi' => $this->input->post('durasi'),
            'gambar' => $uploaded_image,
            'deskripsi' => $this->input->post('deskripsi')
        ]);
        $this->session->set_flashdata('message', '<small><div class="alert alert-success col-lg-6" role="alert">
        New Film Added successfully!
        </div></small>');
        redirect('abioskop/film');
    }
}

public function upload_image() {
    $config['upload_path'] = './assets/img/film/';
    $config['allowed_types'] = 'gif|jpg|png';
    $config['max_size'] = 50000;

    $this->load->library('upload', $config);

    if ($this->upload->do_upload('image')) {
        return $this->upload->data('file_name');
    } else {
        echo $this->upload->display_errors();
        return FALSE;
    }
}   

// ================================== Hapus Film ==================================
    public function deleteFilm($film_id) {
        // Cek apakah ada jadwal terkait
        $this->db->where('film_id', $film_id);
        $jadwal_count = $this->db->count_all_results('jadwal');

        if ($jadwal_count > 0) {
            // Jika ada jadwal terkait, tampilkan pesan kesalahan
            $this->session->set_flashdata('error_message', '<small><div class="alert alert-success col-lg-6" role="alert"> There is still a movie schedule. Unable to delete movies. </div></small>');
            
        } else {
            // Jika tidak ada jadwal terkait, lanjutkan dengan penghapusan film
            $this->db->where('id', $film_id);
            $this->db->delete('film');
            $this->session->set_flashdata('message', '<small><div class="alert alert-success col-lg-6" role="alert"> Film deleted successfully! </div></small>');
        }

        redirect('abioskop/film');
    }

    public function updateFilm($film_id) {
        // Tangani form submission untuk memperbarui informasi film
        $judulFilm = $this->input->post('judulFilm');
        $durasi = $this->input->post('durasi');
        $deskripsi = $this->input->post('deskripsi');
    
        // Update informasi film di database
        $data = array(
            'judul' => $judulFilm,
            'durasi' => $durasi,
            'deskripsi' => $deskripsi
        );
    
        $this->db->where('id', $film_id);
        $this->db->update('film', $data);
    
        // Set pesan flash data berdasarkan hasil dari operasi update
        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('message', '<small><div class="alert alert-success col-lg-6" role="alert"> Movie information changed successfully </div></small>');
        } else {
            $this->session->set_flashdata('error_message', '<small><div class="alert alert-danger col-lg-6" role="alert"> Failure to renew the movie </div></small>');
        }
    
        // Setelah update, arahkan kembali ke halaman film
        redirect('abioskop/film');
    }
// =============================================================== FUNCTION FILM END ===============================================================

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
            $this->load->view('abioskop/booking', $data);
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
    $this->load->view('abioskop/bioskop', $data);
    $this->load->view('templates/footer');
    
   }

   // ========================================================================== BAGIAN FUNCTION MENU JADWAL ========================================================================== //

public function jadwal() {
    $data['title'] = "Menu Management Jadwal";
    $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();

    $this->form_validation->set_rules('judulFilm', 'JudulFilm', 'required');
    $this->form_validation->set_rules('namaBioskop', 'NamaBioskop', 'required');
    $this->form_validation->set_rules('jamTayang', 'JamTayang', 'required');
    $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
    $this->form_validation->set_rules('idStudio', 'IdStudio', 'required');
    
    $sql = "SELECT jadwal.id_jadwal, bioskop.nama_bioskop, jadwal.id_bioskop, film.id, film.judul, jadwal.id_studio, jadwal.jam_tayang, jadwal.tanggal 
            FROM bioskop 
            LEFT JOIN jadwal ON jadwal.id_bioskop = bioskop.id 
            LEFT JOIN film ON jadwal.film_id = film.id 
            WHERE jadwal.id_bioskop IS NOT NULL";
    
    $data['film'] = $this->db->get('film')->result_array();
    $data['bioskop'] = $this->db->get('bioskop')->result_array();
    
    $data['jadwal'] = $this->db->query($sql)->result_array();



    $isUniqueCombination = true;
    
    if ($this->form_validation->run() == false) {
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('abioskop/jadwal', $data);
        $this->load->view('templates/footer');
    } else {
            $bioskopId = $this->input->post('namaBioskop');
            $studioTerisi = $this->input->post('idStudio');
            $jamTerisi = $this->input->post('jamTayang');
            $tanggalTerisi = $this->input->post('tanggal');
            $studio = $this->input->post('idStudio');
            $totalStudio = $this->db->get_where('bioskop', ['id' => $bioskopId])->row('total_studio');
            // Check if the combination of bioskop, studio, and jam tayang is unique
            $isUniqueCombination = true;

            foreach ($data['jadwal'] as $jadwalItem) {
                if (
                    $jadwalItem['id_bioskop'] == $bioskopId &&
                    $jadwalItem['id_studio'] == $studioTerisi &&
                    $jadwalItem['jam_tayang'] == $jamTerisi && 
                    $jadwalItem['tanggal'] == $tanggalTerisi ) {
                    $isUniqueCombination = false;
                    break; // No need to continue checking if a match is found
                }
            }
            if ($studio <= $totalStudio) {
                if ($isUniqueCombination) {
                    $this->db->insert('jadwal', [
                        'film_id' => $this->input->post('judulFilm'),
                        'id_bioskop' => $this->input->post('namaBioskop'),
                        'jam_tayang' => $this->input->post('jamTayang'),
                        'tanggal' => $this->input->post('tanggal'),
                        'id_studio' => $this->input->post('idStudio')
                    ]);
        
                    $this->session->set_flashdata('message', '<small><div class="alert alert-success col-lg-6" role="alert">
                            New Jadwal added!
                            </div></small>');
                    redirect('abioskop/jadwal');
                } else {
                    $this->session->set_flashdata('error_message', '<small><div class="alert alert-danger col-lg-6" role="alert">
                        Jadwal untuk Bioskop, Studio, dan Jam Tayang tersebut sudah terisi.
                        </div></small>');
                    redirect('abioskop/jadwal');
                }   
            } else{
                $this->session->set_flashdata('error_message', '<small><div class="alert alert-danger col-lg-6" role="alert">
                    Studio di bioskop ini hanya memiliki '. $totalStudio .' studio
                </div></small>');
                redirect('abioskop/jadwal');
            }
    }
}

// ======================================================= HAPUS JADWAL =======================================================
        public function deleteJadwal($jadwal_id) {
            $this->db->where('id_jadwal', $jadwal_id);
            $this->db->delete('jadwal');
            $this->session->set_flashdata('message', '<small><div class="alert alert-success col-lg-6" role="alert">
                Film deleted successfully!
                </div></small>');
            redirect('abioskop/jadwal');
        }

// ======================================================= HAPUS JADWAL END =======================================================

// ======================================================= UPDATE JADWAL =======================================================

        public function updateJadwal($jadwal_id) {
            // Tangani form submission untuk memperbarui informasi film
            $jamTayang = $this->input->post('jamTayang');
            $tanggal = $this->input->post('tanggal');
            $studio = $this->input->post('studio');
        
            // Update informasi film di database
            $data = array(
                'jam_tayang' => $jamTayang,
                'tanggal' => $tanggal,
                'id_studio' => $studio
            );
        
            $this->db->where('id_jadwal', $jadwal_id);
            $this->db->update('jadwal', $data);
        
            // Set pesan flash data berdasarkan hasil dari operasi update
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('message', '<small><div class="alert alert-success col-lg-6" role="alert"> Jadwal updated successfully! </div></small>');
            } else {
                $this->session->set_flashdata('error_message', '<small><div class="alert alert-danger col-lg-6" role="alert"> Failed to update Jadwal </div></small>');
            }
        
            // Setelah update, arahkan kembali ke halaman film
            redirect('abioskop/jadwal');
        }
// ======================================================= UPDATE JADWAL END =======================================================

// ========================================================================== BAGIAN AKHIR FUNCTION MENU JADWAL ========================================================================== //


  
}