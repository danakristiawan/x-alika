<?php

class Monitoring_model extends CI_Model
{
    // memanggil data user berdasarkan nip yg akan digunakan untuk login
    public function getSignIn($nip = null)
    {
        return $this->db->get_where('users', ['nip' => $nip])->row_array();
    }

    // memanggil data pegawai berdasarkan satker
    public function getPegawai($kdsatker = null, $limit = 0, $offset = 0)
    {
        $this->db->order_by('nip', 'ASC');
        return $this->db->get_where('data_unit_pegawai', ['kdsatker' => $kdsatker], $limit, $offset)->result_array();
    }

    // menghitung pegawai berdasarkan satker
    public function countPegawai($kdsatker = null)
    {
        return $this->db->get_where('data_unit_pegawai', ['kdsatker' => $kdsatker])->num_rows();
    }

    // mencari pegawai berdasarkan satker
    public function findPegawai($keyword = null, $limit = 0, $offset = 0, $kdsatker = null)
    {
        $this->db->like('nama', $keyword);
        return $this->db->get_where('data_unit_pegawai', ['kdsatker' => $kdsatker], $limit, $offset)->result_array();
    }

    // menampilkan data untuk monitoring kenaikan pangkat per pegawai
    public function getPegawaiKp($kdsatker = null, $limit = 0, $offset = 0)
    {
        $this->db->select('data_unit_pegawai.*, data_pegawai.kdgapok');
        $this->db->from('data_unit_pegawai');
        $this->db->join('data_pegawai', 'data_pegawai.nip=data_unit_pegawai.nip', 'left');
        $this->db->where('data_unit_pegawai.kdsatker', $kdsatker);
        $this->db->order_by('data_unit_pegawai.nip', 'ASC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result_array();
    }

    public function countPegawaiKp($kdsatker = null)
    {
        $this->db->select('data_unit_pegawai.*, data_pegawai.kdgapok');
        $this->db->from('data_unit_pegawai');
        $this->db->join('data_pegawai', 'data_pegawai.nip=data_unit_pegawai.nip', 'left');
        $this->db->where('data_unit_pegawai.kdsatker', $kdsatker);
        return $this->db->get()->num_rows();
    }

    public function findPegawaiKp($keyword = null, $limit = 0, $offset = 0, $kdsatker = null)
    {
        $this->db->like('data_unit_pegawai.nama', $keyword);
        $this->db->select('data_unit_pegawai.*, data_pegawai.kdgapok');
        $this->db->from('data_unit_pegawai');
        $this->db->join('data_pegawai', 'data_pegawai.nip=data_unit_pegawai.nip', 'left');
        $this->db->where('data_unit_pegawai.kdsatker', $kdsatker);
        $this->db->order_by('data_unit_pegawai.nip', 'ASC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result_array();
    }

    // mencari anak dan mengurutkan dari yang paling dewasa
    public function getAnakDewasa($kdsatker = null, $limit = 0, $offset = 0)
    {
        $this->db->select('data_unit_pegawai.*, data_keluarga.nama AS anak, data_keluarga.tgllhr');
        $this->db->from('data_unit_pegawai');
        $this->db->join('data_keluarga', 'data_keluarga.nip=data_unit_pegawai.nip', 'right');
        $this->db->where(['data_unit_pegawai.kdsatker' => $kdsatker, 'data_keluarga.kdkeluarga' => '3', 'data_keluarga.kddapat' => '1']);
        $this->db->order_by('data_keluarga.tgllhr', 'ASC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result_array();
    }

    public function countAnakDewasa($kdsatker = null)
    {
        $this->db->select('data_unit_pegawai.*, data_keluarga.nama AS anak, data_keluarga.tgllhr');
        $this->db->from('data_unit_pegawai');
        $this->db->join('data_keluarga', 'data_keluarga.nip=data_unit_pegawai.nip', 'right');
        $this->db->where(['data_unit_pegawai.kdsatker' => $kdsatker, 'data_keluarga.kdkeluarga' => '3', 'data_keluarga.kddapat' => '1']);
        return $this->db->get()->num_rows();
    }

    public function findAnakDewasa($keyword = null, $limit = 0, $offset = 0, $kdsatker = null)
    {
        $this->db->like('data_unit_pegawai.nama', $keyword);
        $this->db->select('data_unit_pegawai.*, data_keluarga.nama AS anak, data_keluarga.tgllhr');
        $this->db->from('data_unit_pegawai');
        $this->db->join('data_keluarga', 'data_keluarga.nip=data_unit_pegawai.nip', 'right');
        $this->db->where(['data_unit_pegawai.kdsatker' => $kdsatker, 'data_keluarga.kdkeluarga' => '3', 'data_keluarga.kddapat' => '1']);
        $this->db->order_by('data_keluarga.tgllhr', 'ASC');
        $this->db->limit($limit, $offset);
        return $this->db->get()->result_array();
    }

    // menampilkan data untuk monitoring tugas belajar per pegawai
    public function getTugasBelajar($kdsatker = null, $limit = 0, $offset = 0)
    {
        return $this->db->query("SELECT a.*, b.kdduduk, b.kdgapok FROM data_unit_pegawai a RIGHT JOIN data_pegawai b ON a.nip=b.nip WHERE a.kdsatker='$kdsatker' AND b.kdduduk='02' OR a.kdsatker='$kdsatker' AND b.kdduduk='07' OR a.kdsatker='$kdsatker' AND b.kdduduk='12' ORDER BY a.nip LIMIT $limit OFFSET $offset")->result_array();
    }

    public function countTugasBelajar($kdsatker = null)
    {
        return $this->db->query("SELECT a.*, b.kdduduk, b.kdgapok FROM data_unit_pegawai a RIGHT JOIN data_pegawai b ON a.nip=b.nip WHERE a.kdsatker='$kdsatker' AND b.kdduduk='02' OR a.kdsatker='$kdsatker' AND b.kdduduk='07' OR a.kdsatker='$kdsatker' AND b.kdduduk='12' ORDER BY a.nip")->num_rows();
    }

    public function findTugasBelajar($keyword = null, $limit = 0, $offset = 0, $kdsatker = null)
    {
        return $this->db->query("SELECT a.*, b.kdduduk, b.kdgapok FROM data_unit_pegawai a RIGHT JOIN data_pegawai b ON a.nip=b.nip WHERE a.nama LIKE '%$keyword%' AND a.kdsatker='$kdsatker' AND b.kdduduk='02' OR a.nama LIKE '%$keyword%' AND a.kdsatker='$kdsatker' AND b.kdduduk='07' OR a.nama LIKE '%$keyword%' AND a.kdsatker='$kdsatker' AND b.kdduduk='12' ORDER BY a.nip LIMIT $limit OFFSET $offset")->result_array();
    }

    // menampilkan data untuk monitoring hukuman disiplin per pegawai
    public function getHukumanDisiplin($kdsatker = null, $limit = 0, $offset = 0)
    {
        return $this->db->query("SELECT a.*, b.kdgapok FROM data_unit_pegawai a RIGHT JOIN data_pegawai b ON a.nip=b.nip WHERE a.kdsatker='$kdsatker' AND b.kdduduk='06' ORDER BY a.nip LIMIT $limit OFFSET $offset")->result_array();
    }

    public function countHukumanDisiplin($kdsatker = null)
    {
        return $this->db->query("SELECT a.*, b.kdgapok FROM data_unit_pegawai a RIGHT JOIN data_pegawai b ON a.nip=b.nip WHERE a.kdsatker='$kdsatker' AND b.kdduduk='06' ORDER BY a.nip")->num_rows();
    }

    public function findHukumanDisiplin($keyword = null, $limit = 0, $offset = 0, $kdsatker = null)
    {
        return $this->db->query("SELECT a.*, b.kdgapok FROM data_unit_pegawai a RIGHT JOIN data_pegawai b ON a.nip=b.nip WHERE a.nama LIKE '%$keyword%' AND a.kdsatker='$kdsatker' AND b.kdduduk='06' ORDER BY a.nip LIMIT $limit OFFSET $offset")->result_array();
    }
}
