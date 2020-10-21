<?php

namespace App\Controllers;

class Login extends BaseController
{
    public function index()
    {
        return View('login/index');
    }

    public function validasiuser()
    {
        if ($this->request->isAJAX()) {
            $uid = $this->request->getVar('uid');
            $pass = $this->request->getVar('pass');

            $validation = \Config\Services::validation();

            $valid = $this->validate([
                'uid' => [
                    'label' => 'User ID',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ],
                'pass' => [
                    'label' => 'Password',
                    'rules' => 'required',
                    'errors' => [
                        'required' => '{field} tidak boleh kosong'
                    ]
                ]
            ]);

            if (!$valid) {
                $msg = [
                    'error' => [
                        'uid' => $validation->getError('uid'),
                        'pass' => $validation->getError('pass'),
                    ]
                ];
            } else {
                $db = \Config\Database::connect();
                $users = $db->table('users');
                $cekuser = $users->getWhere(['userid' => $uid]);

                if (count($cekuser->getResult()) > 0) {
                    $resultuser = $cekuser->getRow();

                    $password_hash = $resultuser->userpass;

                    if (password_verify($pass, $password_hash)) {
                        $array_session = [
                            'login' => true,
                            'iduser' => $uid,
                            'namauser' => $resultuser->usernama,
                            'fotouser' => $resultuser->userfoto
                        ];
                        $this->session->set($array_session);

                        $msg = [
                            'sukses' => 'Login Berhasil'
                        ];
                    } else {
                        $msg = [
                            'error' => [
                                'pass' => 'Password anda salah',
                            ]
                        ];
                    }
                } else {
                    $msg = [
                        'error' => [
                            'uid' => 'User ID tidak ditemukan',
                        ]
                    ];
                }
            }

            echo json_encode($msg);
        }
    }

    function keluar()
    {
        $this->session->destroy();

        return redirect()->to('/login/index');
    }
}