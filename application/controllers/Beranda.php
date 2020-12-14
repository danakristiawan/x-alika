<?php

class Beranda extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_pegawai_model', 'data_pegawai');
        $this->load->model('Data_keluarga_model', 'data_keluarga');
    }

    public function index()
    {
        $nip = $this->session->userdata('nip');
        $data['pegawai'] = $this->data_pegawai->getPegawai($nip);
        $data['keluarga'] = $this->data_keluarga->getKeluarga($nip);

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('beranda/index', $data);
        $this->load->view('template/footer');
    }
}
