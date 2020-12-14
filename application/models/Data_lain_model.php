<?php

class Data_lain_model extends CI_Model
{
    public function getDataLain($id = null, $limit = 0, $offset = 0)
    {
        if ($id === null) {
            return $this->db->get('data_lain', $limit, $offset)->result_array();
        } else {
            return $this->db->get_where('data_lain', ['id' => $id])->row_array();
        }
    }

    public function findDataLain($keyword1 = null, $keyword2 = null, $limit = 0, $offset = 0)
    {
        $this->db->where('nip', $keyword1);
        $this->db->where('tahun', $keyword2);
        $this->db->order_by('bulan', 'ASC');
        return $this->db->get('data_lain', $limit, $offset)->result_array();
    }

    public function createDataLain($data)
    {
        $this->db->insert('data_lain', $data);
        return $this->db->affected_rows();
    }

    public function updateDataLain($data, $id)
    {
        $this->db->update('data_lain', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteDataLain($id)
    {
        $this->db->delete('data_lain', ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function getTahun($nip)
    {
        return $this->db->query("SELECT DISTINCT tahun FROM data_lain WHERE nip='$nip' ORDER BY tahun DESC")->result_array();
    }
    public function getJenis($nip, $thn)
    {
        return $this->db->query("SELECT DISTINCT jenis FROM data_lain WHERE nip='$nip' AND tahun='$thn' ORDER BY jenis DESC")->result_array();
    }

    public function getLain($nip, $thn, $jns)
    {
        return $this->db->query("SELECT a.*, b.bulan AS nama_bulan FROM data_lain a LEFT JOIN ref_bulan b ON a.bulan=b.kode WHERE a.nip='$nip' AND a.tahun='$thn'  AND a.jenis='$jns'")->result_array();
    }
}
