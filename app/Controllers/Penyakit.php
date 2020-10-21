<?php

namespace App\Controllers;

class Penyakit extends BaseController
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->penyakit = $this->db->table('penyakit');
    }
    public function index()
    {
        $data = [
            'tampildata' =>  $this->penyakit->get()
        ];
        return View('penyakit/data', $data);
    }

    function hapus($no)
    {
        $this->penyakit->delete(['penyakitid' => $no]);
        return redirect()->to('/penyakit/index');
    }

    function tambah()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'data' => View('penyakit/formtambah')
            ];
            echo json_encode($msg);
        }
    }

    function simpan()
    {
        if ($this->request->isAJAX()) {
            $nama = $this->request->getVar('nama');

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nama' => [
                    'label' => 'Nama penyakit',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib di-isi',
                    ]
                ]
            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama' => $validation->getError('nama'),
                    ]
                ];
            } else {
                $this->penyakit->insert([
                    'penyakitnm' => $nama,
                ]);

                $msg = [
                    'sukses' => 'Penyakit baru berhasil ditambahkan'
                ];
            }

            echo json_encode($msg);
        }
    }
}