<?php

class Pph_pasal_21 extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_spt_pegawai_model', 'spt');
        $this->load->model('Ref_spt_tahunan_model', 'refSpt');
    }

    public function index($thn = null)
    {
        if (!isset($thn)) $thn = date('Y');
        $nip = $this->session->userdata('nip');
        $data['tahun'] = $this->spt->getTahun($nip);
        $data['thn'] = $thn;
        $data['nip'] = $nip;
        $data['peg'] = $this->spt->getSptPegawai($nip, $thn);
        $data['gaji'] = $this->spt->getViewGaji($nip, $thn);
        $data['kurang'] = $this->spt->getViewKurang($nip, $thn);
        $data['tukin'] = $this->spt->getViewTukin($nip, $thn);
        $data['rapel'] = $this->spt->getViewRapel($nip, $thn);
        $data['tarif'] = $this->refSpt->getTarif($thn);

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('pph_pasal_21/index', $data);
        $this->load->view('template/footer');
    }
}
