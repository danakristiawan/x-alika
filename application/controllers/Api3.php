<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api3 extends RestController
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Monitoring_model', 'monitoring'); //1
        $this->load->model('Data_unit_pegawai_model', 'unit');
        $this->load->model('Data_satker_model', 'satker');
        $this->load->model('Data_profil_model', 'data_profil');
        $this->load->model('Penghasilan_model', 'penghasilan');
        $this->load->model('Data_gaji_model', 'data_gaji');
        $this->load->model('Data_kurang_model', 'data_kurang');
        $this->load->model('Data_makan_model', 'data_makan');
        $this->load->model('Data_lembur_model', 'data_lembur');
        $this->load->model('Data_pegawai_model', 'data_pegawai');
        $this->load->model('Data_keluarga_model', 'data_keluarga');
        $this->load->model('Data_perubahan_model', 'data_perubahan');
        $this->load->model('Data_tukin_model', 'data_tukin');
        $this->load->model('Data_lain_model', 'data_lain');
        $this->load->model('Ref_bulan_model', 'bulan');
        $this->load->model('Ref_spt_tahunan_model', 'spt_tahunan');
        $this->load->model('Data_spt_pegawai_model', 'spt');
    }

    // -----------------------------------
    // monitoring
    // -----------------------------------

    // untuk memanggil data user
    public function sign_in_get()
    {
        $nip = $this->get('nip');
        $data = $this->monitoring->getSignIn($nip);
        $this->response($data, 200);
    }

    // menampilkan daftar pegawai berdasarkan satker
    public function data_pegawai_get()
    {
        $kdsatker = $this->get('kdsatker');
        $limit = $this->get('limit');
        $offset = $this->get('offset');
        $data = $this->monitoring->getPegawai($kdsatker, $limit, $offset);
        $this->response($data, 200);
    }

    // menghitung jumlah pegawai berdasarkan satker
    public function count_pegawai_get()
    {
        $kdsatker = $this->get('kdsatker');
        $data = $this->monitoring->countPegawai($kdsatker);
        $this->response($data, 200);
    }

    // mencari pegawai dalam satu satker
    public function find_pegawai_get()
    {
        $keyword = $this->get('keyword');
        $limit = $this->get('limit');
        $offset = $this->get('offset');
        $kdsatker = $this->get('kdsatker');
        $data = $this->monitoring->findPegawai($keyword, $limit, $offset, $kdsatker);
        $this->response($data, 200);
    }

    // -----------------------------------
    // unit pegawai
    // -----------------------------------

    // untuk menampilkan satker berdasarkan nip
    public function kode_satker_get()
    {
        $nip = $this->get('nip');
        $data = $this->unit->getPegawai($nip);
        $this->response($data, 200);
    }

    // -----------------------------------
    // data satker
    // -----------------------------------

    // menghitung jumlah satker
    public function count_data_satker_get()
    {
        $data = $this->satker->countDataSatker();
        $this->response($data, 200);
    }

    // menampilkan dan mencari satker
    public function data_satker_get()
    {
        $id = $this->get('id');
        $keyword = $this->get('keyword');
        $limit = $this->get('limit');
        $offset = $this->get('offset');
        if ($keyword) {
            $data = $this->satker->findDataSatker($keyword, $limit, $offset);
        } else {
            $data = $this->satker->getDataSatker($id, $limit, $offset);
        }
        $this->response($data, 200);
    }

    // menampilkan detail satker untuk penandatanganan
    public function data_detail_satker_get()
    {
        $kdsatker = $this->get('kdsatker');
        $data = $this->satker->getSatker($kdsatker);
        $this->response($data, 200);
    }

    // -----------------------------------
    // data pegawai
    // -----------------------------------

    // menampilkan data detail pegawai
    public function data_detail_pegawai_get()
    {
        $nip = $this->get('nip');
        $data = $this->data_pegawai->getPegawai($nip);
        $this->response($data, 200);
    }

    // -----------------------------------
    // ref bulan
    // -----------------------------------

    // menampilkan ref bulan
    public function data_bulan_get()
    {
        $bln = $this->get('bln');
        $data = $this->bulan->getBulan($bln);
        $this->response($data, 200);
    }

    // -----------------------------------
    // ref spt tahunan
    // -----------------------------------

    public function data_ref_spt_get()
    {
        $thn = $this->get('thn');
        $data = $this->spt_tahunan->getTarif($thn);
        $this->response($data, 200);
    }

    // -----------------------------------
    // spt
    // -----------------------------------

    // menampilkan rapel tukin
    public function data_rapel_get()
    {
        $nip = $this->get('nip');
        $bln = $this->get('bln');
        $thn = $this->get('thn');
        $data = $this->spt->getRapel($nip, $bln, $thn);
        $this->response($data, 200);
    }

    public function data_spt_pegawai_get()
    {
        $nip = $this->get('nip');
        $thn = $this->get('thn');
        $data = $this->spt->getSptPegawai($nip, $thn);
        $this->response($data, 200);
    }

    public function data_tahun_spt_get()
    {
        $nip = $this->get('nip');
        $data = $this->spt->getTahun($nip);
        $this->response($data, 200);
    }

    public function data_view_gaji_get()
    {
        $nip = $this->get('nip');
        $thn = $this->get('thn');
        $data = $this->spt->getViewGaji($nip, $thn);
        $this->response($data, 200);
    }

    public function data_view_kurang_get()
    {
        $nip = $this->get('nip');
        $thn = $this->get('thn');
        $data = $this->spt->getViewKurang($nip, $thn);
        $this->response($data, 200);
    }

    public function data_view_tukin_get()
    {
        $nip = $this->get('nip');
        $thn = $this->get('thn');
        $data = $this->spt->getViewTukin($nip, $thn);
        $this->response($data, 200);
    }

    public function data_view_rapel_get()
    {
        $nip = $this->get('nip');
        $thn = $this->get('thn');
        $data = $this->spt->getViewRapel($nip, $thn);
        $this->response($data, 200);
    }

    // -----------------------------------
    // data keluarga
    // -----------------------------------

    // menampilkan data detail keluarga
    public function data_keluarga_get()
    {
        $nip = $this->get('nip');
        $data = $this->data_keluarga->getKeluarga($nip);
        $this->response($data, 200);
    }

    // -----------------------------------
    // data profil
    // -----------------------------------

    // menampilkan profil kantor
    public function data_profil_get()
    {
        $kdsatker = $this->get('kdsatker');
        $tahun = $this->get('tahun');
        $data = $this->data_profil->getProfil($kdsatker, $tahun);
        $this->response($data, 200);
    }

    // -----------------------------------
    // data perubahan
    // -----------------------------------

    public function data_perubahan_get()
    {
        $nip = $this->get('nip');
        $thn = $this->get('thn');
        $data = $this->data_perubahan->getPerubahan($nip, $thn);
        $this->response($data, 200);
    }

    public function data_tahun_perubahan_get()
    {
        $nip = $this->get('nip');
        $data = $this->data_perubahan->getTahun($nip);
        $this->response($data, 200);
    }

    // -----------------------------------
    // penghasilan
    // -----------------------------------
    public function data_penghasilan_get()
    {
        $nip = $this->get('nip');
        $thn = $this->get('thn');
        $data = $this->penghasilan->getPenghasilan($nip, $thn);
        $this->response($data, 200);
    }

    public function data_tahun_penghasilan_get()
    {
        $nip = $this->get('nip');
        $data = $this->penghasilan->getTahun($nip);
        $this->response($data, 200);
    }

    public function data_penghasilan_tahunan_get()
    {
        $nip = $this->get('nip');
        $thn = $this->get('thn');
        $data = $this->penghasilan->getPenghasilanTahunan($nip, $thn);
        $this->response($data, 200);
    }

    // -----------------------------------
    // data gaji
    // -----------------------------------
    public function data_tahun_gaji_get()
    {
        $nip = $this->get('nip');
        $data = $this->data_gaji->getTahun($nip);
        $this->response($data, 200);
    }

    public function data_gaji_get()
    {
        $nip = $this->get('nip');
        $thn = $this->get('thn');
        $data = $this->data_gaji->getGaji($nip, $thn);
        $this->response($data, 200);
    }

    public function data_bulan_gaji_get()
    {
        $nip = $this->get('nip');
        $bulan = $this->get('bln');
        $tahun = $this->get('thn');
        $data = $this->data_gaji->getBulanGaji($nip, $bulan, $tahun);
        $this->response($data, 200);
    }

    public function view_bulan_gaji_get()
    {
        $nip = $this->get('nip');
        $bulan = $this->get('bln');
        $tahun = $this->get('thn');
        $data = $this->data_gaji->getViewBulanGaji($nip, $bulan, $tahun);
        $this->response($data, 200);
    }

    // -----------------------------------
    // data kurang
    // -----------------------------------
    public function data_kurang_get()
    {
        $nip = $this->get('nip');
        $thn = $this->get('thn');
        $data = $this->data_kurang->getKurang($nip, $thn);
        $this->response($data, 200);
    }

    public function data_bulan_kurang_get()
    {
        $nip = $this->get('nip');
        $bulan = $this->get('bulan');
        $tahun = $this->get('tahun');
        $data = $this->data_kurang->getBulanKurang($nip, $bulan, $tahun);
        $this->response($data, 200);
    }

    // -----------------------------------
    // data makan
    // -----------------------------------
    public function data_tahun_makan_get()
    {
        $nip = $this->get('nip');
        $data = $this->data_makan->getTahun($nip);
        $this->response($data, 200);
    }

    public function data_makan_get()
    {
        $nip = $this->get('nip');
        $thn = $this->get('thn');
        $data = $this->data_makan->getMakan($nip, $thn);
        $this->response($data, 200);
    }

    public function data_bulan_makan_get()
    {
        $nip = $this->get('nip');
        $bulan = $this->get('bln');
        $tahun = $this->get('thn');
        $data = $this->data_makan->getBulanMakan($nip, $bulan, $tahun);
        $this->response($data, 200);
    }

    public function data_pph_makan_get()
    {
        $nip = $this->get('nip');
        $tahun = $this->get('thn');
        $data = $this->data_makan->getPph($nip, $tahun);
        $this->response($data, 200);
    }

    // -----------------------------------
    // data lembur
    // -----------------------------------
    public function data_tahun_lembur_get()
    {
        $nip = $this->get('nip');
        $data = $this->data_lembur->getTahun($nip);
        $this->response($data, 200);
    }

    public function data_lembur_get()
    {
        $nip = $this->get('nip');
        $thn = $this->get('thn');
        $data = $this->data_lembur->getLembur($nip, $thn);
        $this->response($data, 200);
    }

    public function data_bulan_lembur_get()
    {
        $nip = $this->get('nip');
        $bulan = $this->get('bln');
        $tahun = $this->get('thn');
        $data = $this->data_lembur->getBulanLembur($nip, $bulan, $tahun);
        $this->response($data, 200);
    }

    public function data_pph_lembur_get()
    {
        $nip = $this->get('nip');
        $tahun = $this->get('thn');
        $data = $this->data_lembur->getPph($nip, $tahun);
        $this->response($data, 200);
    }

    // -----------------------------------
    // data tunjangan kinerja
    // -----------------------------------
    public function data_tahun_tukin_get()
    {
        $nip = $this->get('nip');
        $data = $this->data_tukin->getTahun($nip);
        $this->response($data, 200);
    }

    public function data_jenis_tukin_get()
    {
        $nip = $this->get('nip');
        $thn = $this->get('thn');
        $data = $this->data_tukin->getJenis($nip, $thn);
        $this->response($data, 200);
    }

    public function data_tukin_get()
    {
        $nip = $this->get('nip');
        $thn = $this->get('thn');
        $jns = $this->get('jns');
        $data = $this->data_tukin->getTukin($nip, $thn, $jns);
        $this->response($data, 200);
    }

    public function data_bulan_tukin_get()
    {
        $nip = $this->get('nip');
        $bulan = $this->get('bln');
        $tahun = $this->get('thn');
        $data = $this->data_tukin->getBulanTukin($nip, $bulan, $tahun);
        $this->response($data, 200);
    }

    // -----------------------------------
    // data pembayaran lainnya
    // -----------------------------------
    public function data_tahun_lain_get()
    {
        $nip = $this->get('nip');
        $data = $this->data_lain->getTahun($nip);
        $this->response($data, 200);
    }

    public function data_jenis_lain_get()
    {
        $nip = $this->get('nip');
        $thn = $this->get('thn');
        $data = $this->data_lain->getJenis($nip, $thn);
        $this->response($data, 200);
    }

    public function data_lain_get()
    {
        $nip = $this->get('nip');
        $thn = $this->get('thn');
        $jns = $this->get('jns');
        $data = $this->data_lain->getLain($nip, $thn, $jns);
        $this->response($data, 200);
    }

    public function data_detail_lain_get()
    {
        $nip = $this->get('nip');
        $bln = $this->get('bln');
        $thn = $this->get('thn');
        $jns = $this->get('jns');
        $data = $this->data_lain->getDetail($nip, $bln, $thn, $jns);
        $this->response($data, 200);
    }

    public function data_pph_lain_get()
    {
        $nip = $this->get('nip');
        $tahun = $this->get('thn');
        $data = $this->data_lain->getPph($nip, $tahun);
        $this->response($data, 200);
    }

    // -----------------------------------
    // monitoring wilayah
    // -----------------------------------
    public function data_kenaikan_pangkat_get()
    {
        $kdsatker = $this->get('kdsatker');
        $limit = $this->get('limit');
        $offset = $this->get('offset');
        $data = $this->monitoring->getPegawaiKp($kdsatker, $limit, $offset);
        $this->response($data, 200);
    }

    public function count_kenaikan_pangkat_get()
    {
        $kdsatker = $this->get('kdsatker');
        $data = $this->monitoring->countPegawaiKp($kdsatker);
        $this->response($data, 200);
    }

    public function find_kenaikan_pangkat_get()
    {
        $keyword = $this->get('keyword');
        $limit = $this->get('limit');
        $offset = $this->get('offset');
        $kdsatker = $this->get('kdsatker');
        $data = $this->monitoring->findPegawaiKp($keyword, $limit, $offset, $kdsatker);
        $this->response($data, 200);
    }

    public function data_anak_dewasa_get()
    {
        $kdsatker = $this->get('kdsatker');
        $limit = $this->get('limit');
        $offset = $this->get('offset');
        $data = $this->monitoring->getAnakDewasa($kdsatker, $limit, $offset);
        $this->response($data, 200);
    }

    public function count_anak_dewasa_get()
    {
        $kdsatker = $this->get('kdsatker');
        $data = $this->monitoring->countAnakDewasa($kdsatker);
        $this->response($data, 200);
    }

    public function find_anak_dewasa_get()
    {
        $keyword = $this->get('keyword');
        $limit = $this->get('limit');
        $offset = $this->get('offset');
        $kdsatker = $this->get('kdsatker');
        $data = $this->monitoring->findAnakDewasa($keyword, $limit, $offset, $kdsatker);
        $this->response($data, 200);
    }

    public function data_tugas_belajar_get()
    {
        $kdsatker = $this->get('kdsatker');
        $limit = $this->get('limit');
        $offset = $this->get('offset');
        $data = $this->monitoring->getTugasBelajar($kdsatker, $limit, $offset);
        $this->response($data, 200);
    }

    public function count_tugas_belajar_get()
    {
        $kdsatker = $this->get('kdsatker');
        $data = $this->monitoring->countTugasBelajar($kdsatker);
        $this->response($data, 200);
    }

    public function find_tugas_belajar_get()
    {
        $keyword = $this->get('keyword');
        $limit = $this->get('limit');
        $offset = $this->get('offset');
        $kdsatker = $this->get('kdsatker');
        $data = $this->monitoring->findTugasBelajar($keyword, $limit, $offset, $kdsatker);
        $this->response($data, 200);
    }

    public function data_hukuman_disiplin_get()
    {
        $kdsatker = $this->get('kdsatker');
        $limit = $this->get('limit');
        $offset = $this->get('offset');
        $data = $this->monitoring->getHukumanDisiplin($kdsatker, $limit, $offset);
        $this->response($data, 200);
    }

    public function count_hukuman_disiplin_get()
    {
        $kdsatker = $this->get('kdsatker');
        $data = $this->monitoring->countHukumanDisiplin($kdsatker);
        $this->response($data, 200);
    }

    public function find_hukuman_disiplin_get()
    {
        $keyword = $this->get('keyword');
        $limit = $this->get('limit');
        $offset = $this->get('offset');
        $kdsatker = $this->get('kdsatker');
        $data = $this->monitoring->findHukumanDisiplin($keyword, $limit, $offset, $kdsatker);
        $this->response($data, 200);
    }
}
