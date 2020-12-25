<?php
defined('BASEPATH') or exit('No direct script access allowed');

use chriskacerguis\RestServer\RestController;

class Api extends RestController
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('Data_pegawai_model', 'data_pegawai');
        $this->load->model('Data_makan_model', 'data_makan');
    }

    // -----------------------------------
    // data_pegawai*
    // -----------------------------------
    public function data_pegawai_get()
    {
        $id = $this->get('id');
        $keyword = $this->get('keyword');
        $limit = $this->get('limit');
        $offset = $this->get('offset');
        if ($keyword) {
            $data = $this->data_pegawai->findDataPegawai($keyword, $limit, $offset);
        } else {
            $data = $this->data_pegawai->getDataPegawai($id, $limit, $offset);
        }
        $this->response($data, 200);
    }

    public function data_pegawai_post()
    {
        $nmpeg = $this->post('nmpeg');
        $alamat = $this->post('alamat');
        $data = [
            'nmpeg' => $nmpeg,
            'alamat' => $alamat
        ];
        if ($nmpeg === null | $nmpeg === "") {
            $this->response([
                'status' => false,
                'message' => 'No data were added'
            ], 404);
        } else {
            $this->data_pegawai->createDataPegawai($data);
            $this->response([
                'status' => true,
                'message' => 'Data was successfully added'
            ], 200);
        }
    }

    public function data_pegawai_put()
    {
        $id = $this->put('id');
        $data = [
            'nmpeg' => $this->put('nmpeg'),
            'alamat' => $this->put('alamat')
        ];
        if ($id === null | $id === "") {
            $this->response([
                'status' => false,
                'message' => 'No data were changed'
            ], 404);
        } else {
            $this->data_pegawai->updateDataPegawai($data, $id);
            $this->response([
                'status' => true,
                'message' => 'Data was successfully changed'
            ], 200);
        }
    }

    public function data_pegawai_delete()
    {
        $id = $this->delete('id');
        if ($id === null | $id === "") {
            $this->response([
                'status' => false,
                'message' => 'No data were deleted'
            ], 404);
        } else {
            $this->data_pegawai->deleteDataPegawai($id);
            $this->response([
                'status' => true,
                'message' => 'Data was successfully deleted'
            ], 200);
        }
    }

    // -----------------------------------
    // data_makan
    // -----------------------------------
    public function data_makan_get()
    {
        $id = $this->get('id');
        $keyword1 = $this->get('keyword1');
        $keyword2 = $this->get('keyword2');
        $limit = $this->get('limit');
        $offset = $this->get('offset');
        if ($keyword1) {
            $data = $this->data_makan->findDataMakan($keyword1, $keyword2, $limit, $offset);
        } else {
            $data = $this->data_makan->getDataMakan($id, $limit, $offset);
        }
        $this->response($data, 200);
    }

    public function data_makan_post()
    {
        $data = [
            'nip' => $this->post('nip'),
            'bulan' => $this->post('bulan'),
            'tahun' => $this->post('tahun'),
            'kdsatker' => $this->post('kdsatker'),
            'kdanak' => $this->post('kdanak'),
            'kdsubanak' => $this->post('kdsubanak'),
            'kdgol' => $this->post('kdgol'),
            'jmlhari' => $this->post('jmlhari'),
            'tarif' => $this->post('tarif'),
            'pph' => $this->post('pph'),
            'bruto' => $this->post('bruto'),
            'netto' => $this->post('netto')
        ];
        if ($this->post('nip') === null | $this->post('nip') === "") {
            $this->response([
                'status' => false,
                'message' => 'No data were added'
            ], 404);
        } else {
            $this->data_makan->createDataMakan($data);
            $this->response([
                'status' => true,
                'message' => 'Data was successfully added'
            ], 200);
        }
    }

    public function data_makan_put()
    {
        $id = $this->put('id');
        $data = [
            'nip' => $this->put('nip'),
            'bulan' => $this->put('bulan'),
            'tahun' => $this->put('tahun'),
            'kdsatker' => $this->put('kdsatker'),
            'kdanak' => $this->put('kdanak'),
            'kdsubanak' => $this->put('kdsubanak'),
            'kdgol' => $this->put('kdgol'),
            'jmlhari' => $this->put('jmlhari'),
            'tarif' => $this->put('tarif'),
            'pph' => $this->put('pph'),
            'bruto' => $this->put('bruto'),
            'netto' => $this->put('netto')
        ];
        if ($id === null | $id === "") {
            $this->response([
                'status' => false,
                'message' => 'No data were changed'
            ], 404);
        } else {
            $this->data_makan->updateDataMakan($data, $id);
            $this->response([
                'status' => true,
                'message' => 'Data was successfully changed'
            ], 200);
        }
    }

    public function data_makan_delete()
    {
        $id = $this->delete('id');
        if ($id === null | $id === "") {
            $this->response([
                'status' => false,
                'message' => 'No data were deleted'
            ], 404);
        } else {
            $this->data_makan->deleteDataMakan($id);
            $this->response([
                'status' => true,
                'message' => 'Data was successfully deleted'
            ], 200);
        }
    }
}
