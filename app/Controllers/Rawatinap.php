<?php

namespace App\Controllers;

class Rawatinap extends BaseController
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->rawat = $this->db->table('rawatinap');
        $this->kamar = $this->db->table('kamar');
        $this->pasien = $this->db->table('pasien');
        $this->penyakit = $this->db->table('penyakit');
    }
    public function data()
    {
        $query = $this->rawat->join('pasien', 'pasienno=rawatpasienno')->join('kamar', 'kamarkode=rawatkamarkode')->join('penyakit', 'penyakitid=rawatpenyakitid')->get();
        $data = [
            'tampildata' => $query
        ];
        return View('rawat/data', $data);
    }
    public function input()
    {
        $koderawat = date('dmY') . '-' . rand(1, 9999);
        $data = [
            'datakamar' => $this->kamar->get(),
            'datapenyakit' => $this->penyakit->get(),
            'koderawat' => $koderawat
        ];
        return View('rawat/input', $data);
    }

    public function caripasien()
    {
        if ($this->request->isAJAX()) {
            $data = [
                'tampildata' => $this->pasien->get()
            ];
            $msg = [
                'data' => View('rawat/modalcaripasien', $data)
            ];

            echo json_encode($msg);
        }
    }

    public function simpan()
    {
        if ($this->request->isAJAX()) {
            $kode = $this->request->getVar('kode');
            $tgl = $this->request->getVar('tgl');
            $nopasien = $this->request->getVar('nopasien');
            $penyakit = $this->request->getVar('penyakit');
            $kamar = $this->request->getVar('kamar');

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'tgl' => [
                    'label' => 'Tgl.Rawat Inap',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib di-isi',
                    ]
                ],
                'nopasien' => [
                    'label' => 'Pasien',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} Harus di-isi',
                    ]
                ],
                'penyakit' => [
                    'label' => 'Nama Penyakit',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih',
                    ]
                ],
                'kamar' => [
                    'label' => 'Kamar',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} harus dipilih',
                    ]
                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'tgl' => $validation->getError('tgl'),
                        'nopasien' => $validation->getError('nopasien'),
                        'penyakit' => $validation->getError('penyakit'),
                        'kamar' => $validation->getError('kamar'),
                    ]
                ];
            } else {
                // cek status kamar
                $cekkamar = $this->kamar->getWhere(['kamarkode' => $kamar]);
                $row_kamar = $cekkamar->getRow();

                if ($row_kamar->kamarstt == 1) {
                    $msg = [
                        'errorkamar' => 'Maaf Kamar Sedang Ter-isi, coba kamar yang lain'
                    ];
                } else {
                    $this->rawat->insert([
                        'rawatkode' => $kode,
                        'rawattgl' => $tgl,
                        'rawatpasienno' => $nopasien,
                        'rawatpenyakitid' => $penyakit,
                        'rawatkamarkode' => $kamar
                    ]);

                    // update status kamar
                    $this->kamar->where('kamarkode', $kamar);
                    $this->kamar->update([
                        'kamarstt' => 1
                    ]);

                    $msg = [
                        'sukses' => 'Data berhasil disimpan'
                    ];
                }
            }

            echo json_encode($msg);
        }
    }

    function hapus()
    {
        if ($this->request->isAJAX()) {
            $kode = $this->request->getVar('kode');
            $kodekamar = $this->request->getVar('kodekamar');

            // update status kamar
            $this->kamar->where('kamarkode', $kodekamar);
            $this->kamar->update([
                'kamarstt' => 0
            ]);


            $this->rawat->delete(['rawatkode' => $kode]);

            $msg = ['sukses' => 'Data rawat inap berhasil terhapus'];

            echo json_encode($msg);
        }
    }
}