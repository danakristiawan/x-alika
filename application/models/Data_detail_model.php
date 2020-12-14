<?php

class Data_detail_model extends CI_Model
{
    public function getDataDetail($id = null, $limit = 0, $offset = 0)
    {
        if ($id === null) {
            return $this->db->get('data_detail', $limit, $offset)->result_array();
        } else {
            return $this->db->get_where('data_detail', ['id' => $id])->row_array();
        }
    }

    public function findDataDetail($keyword1 = null, $keyword2 = null, $limit = 0, $offset = 0)
    {
        $this->db->where('nip', $keyword1);
        $this->db->where('tahun', $keyword2);
        $this->db->order_by('bulan', 'ASC');
        return $this->db->get('data_detail', $limit, $offset)->result_array();
    }

    public function createDataDetail($data)
    {
        $this->db->insert('data_detail', $data);
        return $this->db->affected_rows();
    }

    public function updateDataDetail($data, $id)
    {
        $this->db->update('data_detail', $data, ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function deleteDataDetail($id)
    {
        $this->db->delete('data_detail', ['id' => $id]);
        return $this->db->affected_rows();
    }

    public function getTahun($nip)
    {
        return $this->db->query("SELECT DISTINCT tahun FROM data_detail WHERE nip='$nip' ORDER BY tahun DESC")->result_array();
    }
    public function getJenis($nip, $thn)
    {
        return $this->db->query("SELECT DISTINCT jenis FROM data_detail WHERE nip='$nip' AND tahun='$thn' ORDER BY jenis DESC")->result_array();
    }

    public function getDetail($nip, $thn, $jns, $bln)
    {
        return $this->db->query("SELECT * FROM data_detail WHERE nip='$nip' AND tahun='$thn' AND jenis='$jns' AND bulan='$bln' ORDER BY tanggal ASC")->result_array();
    }
}
