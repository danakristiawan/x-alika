<?php

class Penghasilan_tahunan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Penghasilan_model', 'penghasilan');
    }

    public function index($thn = null)
    {
        if (!isset($thn)) $thn = date('Y');
        $nip = $this->session->userdata('nip');
        $data['tahun'] = $this->penghasilan->getTahun($nip);
        $data['thn'] = $thn;
        $data['penghasilan'] = $this->penghasilan->getPenghasilanTahunan($nip, $thn);

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('penghasilan_tahunan/index', $data);
        $this->load->view('template/footer');
    }
}
