<?php

class Pph_pasal_21_final extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_spt_pegawai_model', 'spt');
        $this->load->model('Data_makan_model', 'makan');
        $this->load->model('Data_lembur_model', 'lembur');
        $this->load->model('Data_lain_model', 'lain');
    }

    public function index($thn = null)
    {
        if (!isset($thn)) $thn = date('Y');
        $nip = $this->session->userdata('nip');
        $data['tahun'] = $this->spt->getTahun($nip);
        $data['thn'] = $thn;
        $data['spt'] = $this->spt->getSptPegawai($nip, $thn);
        $data['makan'] = $this->makan->getPph($nip, $thn);
        $data['lembur'] = $this->lembur->getPph($nip, $thn);
        $data['lain'] = $this->lain->getPph($nip, $thn);

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pph_pasal_21_final/index', $data);
        $this->load->view('template/footer');
    }
}
