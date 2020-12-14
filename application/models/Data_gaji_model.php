<?php

class Data_gaji_model extends CI_Model
{
    public function getDataGaji($id = null, $limit = 0, $offset = 0)
    {
        if ($id === null) {
            return $this->db->get('data_gaji', $limit, $offset)->result_array();
        } else {
            return $this->db->get_where('data_gaji', ['id' => $id])->row_array();
        }
    }

    public function findDataGaji($keyword1 = null, $keyword2 = null, $limit = 0, $offset = 0)
    {
        $this->db->where('nip', $keyword1);
        $this->db->where('tahun', $keyword2);
        $this->db->order_by('bulan', 'ASC');
        return $this->db->get('data_gaji', $limit, $offset)->result_array();
    }

    public function createDataGaji($data)
    {
        $this->db->insert('data_gaji', $data);
        return $this->db->affected_rows();
    }

    public function updateDataGaji($data, $id)
    {
        $this->db->update('data_gaji', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteDataGaji($id)
    {
        $this->db->delete('data_gaji', ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function getTahun($nip)
    {
        return $this->db->query("SELECT DISTINCT tahun FROM data_gaji WHERE nip='$nip' ORDER BY tahun DESC")->result_array();
    }

    public function getGaji($nip, $tahun)
    {
        return $this->db->query("SELECT a.*, b.bulan AS nama_bulan FROM data_gaji a LEFT JOIN ref_bulan b ON a.bulan=b.kode WHERE a.nip='$nip' AND a.tahun='$tahun'")->result_array();
    }
}
