<?php

namespace App\Controllers;

class Kamar extends BaseController
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->kamar = $this->db->table('kamar');
    }
    public function index()
    {
        $data = [
            'tampildata' =>  $this->kamar->get()
        ];
        return View('kamar/data', $data);
    }

    function hapus($no)
    {
        $this->kamar->delete(['kamarkode' => $no]);
        return redirect()->to('/kamar/index');
    }

    function tambah()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'data' => View('kamar/formtambah')
            ];
            echo json_encode($msg);
        }
    }

    function simpan()
    {
        if ($this->request->isAJAX()) {
            $kode = $this->request->getVar('kode');
            $nama = $this->request->getVar('nama');

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'kode' => [
                    'label' => 'Kode Kamar',
                    'rules' => 'required|min_length[5]|max_length[5]|is_unique[kamar.kamarkode]',
                    'errors' => [
                        'required' => '{field} wajib di-isi',
                        'min_length' => '{field} harus minimal {param} karakter',
                        'max_length' => '{field} harus maksimal {param} karakter',
                        'is_unique' => '{field} sudah terdaftar, silahkan coba kode yang lain'
                    ]
                ],
                'nama' => [
                    'label' => 'Nama Kamar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib di-isi',
                    ]
                ],

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'kode' => $validation->getError('kode'),
                        'nama' => $validation->getError('nama'),
                    ]
                ];
            } else {
                $this->kamar->insert([
                    'kamarkode' => $kode,
                    'kamarnm' => $nama,
                ]);

                $msg = [
                    'sukses' => 'Data Kamar berhasil ditambahkan'
                ];
            }

            echo json_encode($msg);
        }
    }

    function update()
    {
        if ($this->request->isAJAX()) {
            $kode = $this->request->getVar('kode');
            $nama = $this->request->getVar('nama');

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nama' => [
                    'label' => 'Nama Kamar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib di-isi',
                    ]
                ],

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nama' => $validation->getError('nama'),
                    ]
                ];
            } else {
                $this->kamar->where('kamarkode', $kode);
                $this->kamar->update([
                    'kamarnm' => $nama,
                ]);

                $msg = [
                    'sukses' => 'Data Kamar berhasil diupdate'
                ];
            }

            echo json_encode($msg);
        }
    }

    function formedit()
    {
        if ($this->request->isAJAX()) {
            $no = $this->request->getVar('no');

            $data = [
                'row' => $this->kamar->getWhere(['kamarkode' => $no])
            ];

            $msg = [
                'data' => View('kamar/formedit', $data)
            ];
            echo json_encode($msg);
        }
    }
}