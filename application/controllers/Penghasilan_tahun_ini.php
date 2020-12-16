<?php

class Penghasilan_tahun_ini extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Penghasilan_model', 'penghasilan');
    }

    public function index()
    {
        $nip = $this->session->userdata('nip');
        $tahun = date('Y');
        $data['penghasilan'] = $this->penghasilan->getPenghasilanTahunIni($nip, $tahun);

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('penghasilan_tahun_ini/index', $data);
        $this->load->view('template/footer');
    }

    public function cetak_skp()
    {
    }

    public function cetak_daftar()
    {
    }
}
