<?php

class Tunjangan_kinerja extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_tukin_model', 'data_tukin');
    }

    public function index($thn = null, $jns = null)
    {
        if (!isset($thn)) $thn = date('Y');
        if (!isset($jns)) $jns = '0';
        $nip = $this->session->userdata('nip');
        $data['tahun'] = $this->data_tukin->getTahun($nip);
        $data['jenis'] = $this->data_tukin->getJenis($nip, $thn);
        $data['thn'] = $thn;
        $data['jns'] = $jns;
        $data['tukin'] = $this->data_tukin->getTukin($nip, $thn, $jns);

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('tunjangan_kinerja/index', $data);
        $this->load->view('template/footer');
    }
}
