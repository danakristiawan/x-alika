<?php

class Gaji extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->model('Data_gaji_model', 'data_gaji');
        $this->load->model('Data_kurang_model', 'data_kurang');
    }

    public function index($thn = null, $jns = null)
    {
        if (!isset($thn)) $thn = date('Y');
        if (!isset($jns)) $jns = '0';
        $nip = $this->session->userdata('nip');
        $data['tahun'] = $this->data_gaji->getTahun($nip);

        // cek apakah ada data kekurangan gaji apa tidak
        if ($this->data_kurang->getKurang($nip, $thn)) {
            $data['jenis'] = [
                ['jenis' => '0'],
                ['jenis' => '1']
            ];
        } else {
            $data['jenis'] = [
                ['jenis' => '0']
            ];
        }

        $data['thn'] = $thn;
        $data['jns'] = $jns;

        // cek apakah yand diminta jns = 0 apa jns = 1
        if ($jns === '0') {
            $data['gaji'] = $this->data_gaji->getGaji($nip, $thn);
        } else {
            $data['gaji'] = $this->data_kurang->getKurang($nip, $thn);
        }

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('gaji/index', $data);
        $this->load->view('template/footer');
    }
}
