<?php

namespace App\Controllers;

class Pasien extends BaseController
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
        $this->pasien = $this->db->table('pasien');
    }
    public function index()
    {
        $data = [
            'tampildata' =>  $this->pasien->get()
        ];
        return View('pasien/data', $data);
    }

    function hapus($no)
    {
        $this->pasien->delete(['pasienno' => $no]);
        return redirect()->to('/pasien/index');
    }

    function tambah()
    {
        if ($this->request->isAJAX()) {
            $msg = [
                'data' => View('pasien/formtambah')
            ];
            echo json_encode($msg);
        }
    }

    function simpan()
    {
        if ($this->request->isAJAX()) {
            $nik = $this->request->getVar('nik');
            $nama = $this->request->getVar('nama');
            $jenkel = $this->request->getVar('jenkel');
            $alamat = $this->request->getVar('alamat');
            $telp = $this->request->getVar('telp');

            $nopasien = rand(1, 999999);

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nik' => [
                    'label' => 'NIK',
                    'rules' => 'required|min_length[16]|max_length[16]',
                    'errors' => [
                        'required' => '{field} wajib di-isi',
                        'min_length' => '{field} harus minimal {param} karakter',
                        'max_length' => '{field} harus maksimal {param} karakter',
                    ]
                ],
                'nama' => [
                    'label' => 'Nama Pasien',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib di-isi',
                    ]
                ],
                'alamat' => [
                    'label' => 'Alamat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib di-isi',
                    ]
                ],
                'jenkel' => [
                    'label' => 'Jenis Kelamin',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib di-pilih',
                    ]
                ],
                'telp' => [
                    'label' => 'No.Telp/HP',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib di-isi',
                    ]
                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nik' => $validation->getError('nik'),
                        'nama' => $validation->getError('nama'),
                        'alamat' => $validation->getError('alamat'),
                        'jenkel' => $validation->getError('jenkel'),
                        'telp' => $validation->getError('telp'),
                    ]
                ];
            } else {
                $this->pasien->insert([
                    'pasienno' => $nopasien,
                    'pasiennoktp' => $nik,
                    'pasiennama' => $nama,
                    'pasienalamat' => $alamat,
                    'pasienjk' => $jenkel,
                    'pasientelp' => $telp
                ]);

                $msg = [
                    'sukses' => 'Pasien baru berhasil ditambahkan'
                ];
            }

            echo json_encode($msg);
        }
    }

    function update()
    {
        if ($this->request->isAJAX()) {

            $no = $this->request->getVar('no');
            $nik = $this->request->getVar('nik');
            $nama = $this->request->getVar('nama');
            $jenkel = $this->request->getVar('jenkel');
            $alamat = $this->request->getVar('alamat');
            $telp = $this->request->getVar('telp');

            $nopasien = rand(1, 999999);

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'nik' => [
                    'label' => 'NIK',
                    'rules' => 'required|min_length[16]|max_length[16]',
                    'errors' => [
                        'required' => '{field} wajib di-isi',
                        'min_length' => '{field} harus minimal {param} karakter',
                        'max_length' => '{field} harus maksimal {param} karakter',
                    ]
                ],
                'nama' => [
                    'label' => 'Nama Pasien',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib di-isi',
                    ]
                ],
                'alamat' => [
                    'label' => 'Alamat',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib di-isi',
                    ]
                ],
                'jenkel' => [
                    'label' => 'Jenis Kelamin',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib di-pilih',
                    ]
                ],
                'telp' => [
                    'label' => 'No.Telp/HP',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} wajib di-isi',
                    ]
                ]

            ]);
            if (!$valid) {
                $msg = [
                    'error' => [
                        'nik' => $validation->getError('nik'),
                        'nama' => $validation->getError('nama'),
                        'alamat' => $validation->getError('alamat'),
                        'jenkel' => $validation->getError('jenkel'),
                        'telp' => $validation->getError('telp'),
                    ]
                ];
            } else {
                $this->pasien->where('pasienno', $no);
                $this->pasien->update([
                    'pasiennoktp' => $nik,
                    'pasiennama' => $nama,
                    'pasienalamat' => $alamat,
                    'pasienjk' => $jenkel,
                    'pasientelp' => $telp
                ]);

                $msg = [
                    'sukses' => 'Pasien baru berhasil diUpdate'
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
                'row' => $this->pasien->getWhere(['pasienno' => $no])
            ];

            $msg = [
                'data' => View('pasien/formedit', $data)
            ];
            echo json_encode($msg);
        }
    }
}