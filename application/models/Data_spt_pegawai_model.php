<?php

class Data_spt_pegawai_model extends CI_Model
{
    public function getDataSptPegawai($id = null, $limit = 0, $offset = 0)
    {
        if ($id === null) {
            return $this->db->get('data_spt_pegawai', $limit, $offset)->result_array();
        } else {
            return $this->db->get_where('data_spt_pegawai', ['id' => $id])->row_array();
        }
    }

    public function findDataSptPegawai($keyword = null, $limit = 0, $offset = 0)
    {
        $this->db->like('nip', $keyword);
        return $this->db->get('data_spt_pegawai', $limit, $offset)->result_array();
    }

    public function createDataSptPegawai($data)
    {
        $this->db->insert('data_spt_pegawai', $data);
        return $this->db->affected_rows();
    }

    public function updateDataSptPegawai($data, $id)
    {
        $this->db->update('data_spt_pegawai', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteDataSptPegawai($id)
    {
        $this->db->delete('data_spt_pegawai', ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function getTahun($nip)
    {
        return $this->db->query("SELECT DISTINCT tahun FROM data_spt_pegawai WHERE nip='$nip' ORDER BY tahun DESC")->result_array();
    }

    public function getSptPegawai($nip, $thn)
    {
        return $this->db->query(" SELECT * FROM data_spt_pegawai WHERE nip='$nip' AND tahun='$thn'")->row_array();
    }
}
