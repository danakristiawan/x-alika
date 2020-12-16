<?php

use Spipu\Html2Pdf\Html2Pdf;

class Penghasilan_tahun_ini extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_logged_in();
        $this->load->helper('terbilang');
        $this->load->model('Penghasilan_model', 'penghasilan');
        $this->load->model('Data_satker_model', 'satker');
        $this->load->model('Data_unit_pegawai_model', 'unit');
        $this->load->model('Data_gaji_model', 'gaji');
        $this->load->model('Data_kurang_model', 'kurang');
        $this->load->model('Data_makan_model', 'makan');
        $this->load->model('Data_lembur_model', 'lembur');
        $this->load->model('Data_tukin_model', 'tukin');
        $this->load->model('Data_spt_pegawai_model', 'spt');
        $this->load->model('Data_profil_model', 'profil');
        $this->load->model('Ref_bulan_model', 'bulan');
        $this->load->model('Data_pegawai_model', 'pegawai');
    }

    public function index()
    {
        $nip = $this->session->userdata('nip');
        $thn = '2019';
        // $thn = date('Y');
        $data['penghasilan'] = $this->penghasilan->getPenghasilanTahunIni($nip, $thn);

        $this->load->view('template/header');
        $this->load->view('template/sidebar');
        $this->load->view('penghasilan_tahun_ini/index', $data);
        $this->load->view('template/footer');
    }

    public function surat($bln = null, $thn = null)
    {
        if (!isset($bln)) $bln = date('m');
        if (!isset($thn)) $thn = date('Y');

        $nip = $this->session->userdata('nip');
        $thn = '2019';
        $kdsatker = $this->unit->getPegawai($nip)['kdsatker'];

        $data['satker'] = $this->satker->getSatker($kdsatker);
        $data['gaji'] = $this->gaji->getBulanGaji($nip, $bln, $thn);
        $data['kurang'] = $this->kurang->getBulanKurang($nip, $bln, $thn);
        $data['makan'] = $this->makan->getBulanMakan($nip, $bln, $thn);
        $data['lembur'] = $this->lembur->getBulanLembur($nip, $bln, $thn);
        $data['tukin'] = $this->tukin->getBulanTukin($nip, $bln, $thn);
        $data['rapel'] = $this->spt->getRapel($nip, $bln, $thn);
        $data['profil'] = $this->profil->getProfil($kdsatker, $thn);
        $data['bulan'] = $this->bulan->getBulan($bln);
        $data['pegawai'] = $this->pegawai->getPegawai($nip);

        ob_start();
        $this->load->view('penghasilan_tahun_ini/surat', $data);
        $html = ob_get_clean();

        $html2pdf = new Html2Pdf('P', 'A4', 'en', false, 'UTF-8', array(10, 10, 10, 10));
        $html2pdf->addFont('Arial');
        $html2pdf->pdf->SetTitle('SKP');
        $html2pdf->writeHTML($html);
        $html2pdf->output('skp-' . $bln . $thn . '.pdf');
    }

    public function daftar()
    {
    }
}
