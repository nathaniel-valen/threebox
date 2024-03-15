<?php
defined('BASEPATH') or exit('No direct script access allowed');

class APusat extends CI_Controller
{
    // ====================================== BAGIAN FUNCTION INDEX ====================================== //

    public function index()
    {
        $data['title'] = "Dashboard";
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('apusat/index', $data);
        $this->load->view('templates/footer');
    }

    // ====================================== BAGIAN AKHIR INDEX ====================================== //

    // ========================================================================== FUNCTION MENU BIOSKOP ========================================================================== //
    public function bioskop()
    {
        $data['title'] = "Menu Management Bioskop";
        $data['user'] = $this->db->get_where('user', ['username' =>
        $this->session->userdata('username')])->row_array();

        $data['bioskop'] = $this->db->get('bioskop')->result_array();

        $this->form_validation->set_rules('namaBioskop', 'NamaBioskop', 'required');
        $this->form_validation->set_rules('lokasi', 'Lokasi', 'required');
        $this->form_validation->set_rules('totalStudio', 'TotalStudio', 'required');
        $this->form_validation->set_rules('idBioskop', 'ID Bioskop', 'required|is_unique[bioskop.id]');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('apusat/bioskop', $data);
            $this->load->view('templates/footer');
        } else {
            $this->db->insert('bioskop', [
                'id' => $this->input->post('idBioskop'),
                'nama_bioskop' => $this->input->post('namaBioskop'),
                'lokasi' => $this->input->post('lokasi'),
                'total_studio' => $this->input->post('totalStudio')
            ]);
            $this->session->set_flashdata('message', '<small><div class="alert alert-success col-lg-6" role="alert"> New Bioskop added! </div></small>');
            redirect('apusat/bioskop');
        }
    }

    public function deleteBioskop($id)
    {
        // Pastikan terlebih dahulu bahwa data dengan ID yang diberikan ada dalam database
        $bioskop = $this->db->get_where('bioskop', ['id' => $id])->row_array();
        if (!$bioskop) {
            // Tampilkan pesan atau arahkan pengguna ke halaman yang sesuai jika data tidak ditemukan
            // Contoh:
            redirect('apusat/bioskop');
        }

        // Lakukan pengecekan apakah ada jadwal terkait bioskop yang akan dihapus
        $this->db->where('id_bioskop', $id);
        $jadwal_count = $this->db->count_all_results('jadwal');

        if ($jadwal_count > 0) {
            // Jika ada jadwal terkait, tampilkan pesan kesalahan dan arahkan pengguna kembali ke halaman bioskop
            $this->session->set_flashdata('message', '<small><div class="alert alert-danger col-lg-6" role="alert">Failed to delete bioskop. There are associated schedules.</div></small>');
            redirect('apusat/bioskop');
        } else {
            // Jika tidak ada jadwal terkait, lanjutkan dengan penghapusan data bioskop
            $this->db->where('id', $id);
            $this->db->delete('bioskop');

            // Set flashdata untuk menampilkan pesan berhasil saat penghapusan data sukses
            $this->session->set_flashdata('message', '<small><div class="alert alert-success col-lg-6" role="alert">Bioskop deleted successfully!</div></small>');
            redirect('apusat/bioskop');
        }
    }


    public function updateBioskop($id)
    {
        // Pastikan terlebih dahulu bahwa data dengan ID yang diberikan ada dalam database
        $bioskop = $this->db->get_where('bioskop', ['id' => $id])->row_array();
        if (!$bioskop) {
            // Tampilkan pesan atau arahkan pengguna ke halaman yang sesuai jika data tidak ditemukan
            // Contoh:
            redirect('apusat/bioskop');
        }

        // Set aturan validasi untuk input yang diharapkan saat pembaruan data bioskop
        $this->form_validation->set_rules('editNamaBioskop', 'Nama Bioskop', 'required');
        $this->form_validation->set_rules('editLokasi', 'Lokasi', 'required');
        $this->form_validation->set_rules('editTotalStudio', 'Total Studio', 'required|numeric');

        if ($this->form_validation->run() == false) {
            // Jika validasi gagal, tampilkan kembali halaman bioskop dengan pesan kesalahan
            $data['title'] = "Menu Management Bioskop";
            $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
            $data['bioskop'] = $this->db->get('bioskop')->result_array();
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Failed to update bioskop. Please fill in all required fields.</div>');
            redirect('apusat/bioskop');
        } else {
            // Jika validasi berhasil, lakukan pembaruan data bioskop ke dalam database
            $updatedData = [
                'nama_bioskop' => $this->input->post('editNamaBioskop'),
                'lokasi' => $this->input->post('editLokasi'),
                'total_studio' => $this->input->post('editTotalStudio')
            ];

            $this->db->where('id', $id);
            $this->db->update('bioskop', $updatedData);
            if ($this->db->affected_rows() > 0) {
                $this->session->set_flashdata('message', '<small><div class="alert alert-success col-lg-6" role="alert"> Bioskop information changed successfully </div></small>');
            } else {
                $this->session->set_flashdata('error_message', '<small><div class="alert alert-danger col-lg-6" role="alert"> Failure to renew bioskop </div></small>');
            }
            // Set flashdata untuk menampilkan pesan berhasil saat pembaruan data sukses
            // $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Bioskop data updated successfully!</div>');
            redirect('apusat/bioskop');
        }
    }




    // ========================================================================== BAGIAN AKHIR FUNCTION MENU BIOSKOP ========================================================================== //

    // ========================================================================== BAGIAN FUNCTION MENU KARYAWAN ========================================================================== //

    // ====================================== FUNCTION MENAMPILKAN DASHBOARD KARYAWAN ====================================== //
    public function karyawan()
    {
        $data['title'] = "Menu Management Karyawan";
        $data['user'] = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();


        $this->db->select('user.*, user_role.role');
        $this->db->from('user');
        $this->db->join('user_role', 'user.role_id = user_role.id');
        $this->db->where('user.role_id !=', 4);
        $data['dataKaryawan'] = $this->db->get()->result_array();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('apusat/karyawan', $data);
        $this->load->view('templates/footer');
    }

    // ====================================== FUNCTION REGISTRASI KARYAWAN ====================================== //

    public function regisKaryawan()
    {
        $this->form_validation->set_rules('namaKaryawan', 'Nama Lengkap', 'required|trim');
        $this->form_validation->set_rules('userName', 'Username', 'required|trim|is_unique[user.username]', [
            'is_unique' => 'Username ini sudah terdaftar.'
        ]);
        $this->form_validation->set_rules('password', 'Password', 'required');

        $this->form_validation->set_rules('jenisKelamin', 'Jenis Kelamin', 'required|trim'); // Mengasumsikan bahwa Anda memiliki field bernama jenisKelamin di dalam formulir HTML

        $data['karyawan'] = $this->db->get('user')->result_array();

        $data['userRole'] = $this->db->get('user_role')->result_array();


        if ($this->form_validation->run() == false) {
            $data['title'] = 'Threebox - Registrasi';
            $this->load->view('templates/auth_header', $data);
            $this->load->view('auth/registration.php');
            $this->load->view('templates/auth_footer');
        } else {
            $data = [
                'name' => htmlspecialchars($this->input->post('namaKaryawan', true)),
                'username' => htmlspecialchars($this->input->post('userName', true)),
                'jenis_kelamin' => htmlspecialchars($this->input->post('jenisKelamin', true)),
                'image' => 'default.jpg',
                'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
                'role_id' => intval($this->input->post('role')),
                'is_active' => 1,
                'date_created' => time()
            ];

            $this->db->insert('user', $data);
            $this->session->set_flashdata('message', '<small><div class="alert alert-success col-lg-6" role="alert">
            Congratulations! Your account has been successfully created. Please login.
            </div></small>');
            redirect('Apusat/karyawan');
        }
    }

    // ====================================== FUNCTION DELETE KARYAWAN ====================================== //

    public function deleteKaryawan($karyawan_id)
    {
        $this->db->where('id', $karyawan_id);
        $this->db->delete('user');
        $this->session->set_flashdata('message', '<small><div class="alert alert-success col-lg-6" role="alert">
            karyawan deleted successfully!
            </div></small>');
        redirect('apusat/karyawan');
    }

    // ====================================== FUNCTION EDIT ROLE KARYAWAN ====================================== //

    public function updateKaryawan($karyawan_id)
    {
        $newRole = $this->input->post('role');

        $this->db->where('id', $karyawan_id);
        $this->db->update('user', array('role_id' => $newRole));

        if ($this->db->affected_rows() > 0) {
            $this->session->set_flashdata('message', '<small><div class="alert alert-success col-lg-6" role="alert"> Karyawan information changed successfully </div></small>');
        } else {
            $this->session->set_flashdata('error_message', '<small><div class="alert alert-danger col-lg-6" role="alert"> Failure to renew Karyawan </div></small>');
        }
        redirect('apusat/karyawan');
    }

    // ====================================== BAGIAN AKHIR FUNCTION MENU KARYAWAN ====================================== //

    public function film()
    {
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
            $this->load->view('apusat/film', $data);
            $this->load->view('templates/footer');
        } else {
            $uploaded_image = $this->upload_image();

            if (!$uploaded_image) {
                $this->session->set_flashdata('error_message', '<small><div class="alert alert-danger col-lg-6" role="alert">Failed to upload image.</div></small>');
                redirect('apusat/film');
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
            redirect('apusat/film');
        }
    }

    public function upload_image()
    {
        $config['upload_path'] = './assets/img/film/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 50000;
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);

        if ($this->upload->do_upload('image')) {
            return $this->upload->data('file_name');
        } else {
            echo $this->upload->display_errors();
            return FALSE;
        }
    }

    // ================================== Hapus Film ==================================
    public function deleteFilm($film_id)
    {
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

        redirect('apusat/film');
    }

    public function updateFilm($film_id)
    {
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
        redirect('apusat/film');
    }


    // ========================================================================== BAGIAN FUNCTION MENU JADWAL ========================================================================== //

    public function jadwal()
    {
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
            $this->load->view('apusat/jadwal', $data);
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
                    $jadwalItem['tanggal'] == $tanggalTerisi
                ) {
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
                    redirect('apusat/jadwal');
                } else {
                    $this->session->set_flashdata('error_message', '<small><div class="alert alert-danger col-lg-6" role="alert">
                        Jadwal untuk Bioskop, Studio, dan Jam Tayang tersebut sudah terisi.
                        </div></small>');
                    redirect('apusat/jadwal');
                }
            } else {
                $this->session->set_flashdata('error_message', '<small><div class="alert alert-danger col-lg-6" role="alert">
                    Studio di bioskop ini hanya memiliki ' . $totalStudio . ' studio
                </div></small>');
                redirect('apusat/jadwal');
            }
        }
    }

    // ======================================================= HAPUS JADWAL =======================================================
    public function deleteJadwal($jadwal_id)
    {
        $this->db->where('id_jadwal', $jadwal_id);
        $this->db->delete('jadwal');
        $this->session->set_flashdata('message', '<small><div class="alert alert-success col-lg-6" role="alert">
                Film deleted successfully!
                </div></small>');
        redirect('apusat/jadwal');
    }

    // ======================================================= HAPUS JADWAL END =======================================================

    // ======================================================= UPDATE JADWAL =======================================================

    public function updateJadwal($jadwal_id)
    {
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
        redirect('apusat/jadwal');
    }
    // ======================================================= HAPUS JADWAL END =======================================================

    // ========================================================================== BAGIAN AKHIR FUNCTION MENU JADWAL ========================================================================== //


}
