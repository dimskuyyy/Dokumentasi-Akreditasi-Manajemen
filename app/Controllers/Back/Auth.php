<?php

namespace App\Controllers\Back;

use App\Models\User;
use CodeIgniter\API\ResponseTrait;

class Auth extends BaseController
{
    public function login()
    {
        if (!isGuest()) {
            return redirect()->to('wbpanel');
        }
        // $data['logo'] = $this->getLogo();
        return view('auth/login');
    }
    public function doLogin()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $username = $req->getPost('username');
            $password = $req->getPost('password');
            $data = [
                'username' => $username,
                'password' => $password,
            ];
            $rules = [
                'username' => 'required|string',
                'password' => 'required|string',
            ];
            if ($this->validateData($data, $rules)) {
                $user = (new User())
                    ->select(['user_id', 'user_nama', 'user_password', 'user_level', 'user_type','user_status'])
                    ->where('user_username', $username)->where('user_status', 2)->first();
                if ($user != null) {
                    if (password_verify($password, $user['user_password'])) {
                        $type = null;
                        switch($user['user_type']){
                            case 1:
                                $type = "Dekan";
                                break;
                            case 2:
                                $type = "Ketua Jurusan";
                                break;
                            case 3:
                                $type = "Koor Prodi";
                                break;
                            case 4: 
                                $type = "Ketua Taskforce";
                                break;
                            case 5:
                                $type = "Dosen";
                                break;
                            case 6:
                                $type = "Mahasiswa";
                                break;
                            case 7:
                                $type = "Alumni";
                                break;
                            }
                        $ses = session();
                        $ses->set([
                            'id' => $user['user_id'],
                            'nama' => $user['user_nama'],
                            'level' => $user['user_level'],
                            'type' => $user['user_type'],
                            'level_nama' => $user['user_level'] == 1 ? 'Administrator' : 'Writer',
                            'type_nama' => $type,
                            'status_akun' => $user['user_status'],
                            'login_at' => date('d-m-Y H:i:s')
                        ]);
                        $result = jsonFormat(true, 'Login berhasil');
                    } else {
                        $result = jsonFormat(false, 'Gagal login, silahkan coba kembali');
                    }
                } else {
                    $result = jsonFormat(false, 'Gagal login, akun tidak ditemukan/tidak aktif !');
                }
            } else {
                $result = jsonFormat(false, $this->validator->getErrors());
            }
            return $this->response->setJSON($result);
        }
    }
    public function logout()
    {
        $req = $this->request;
        if ($req->isAJAX()) {
            $ses = session();
            $ses->destroy();
            return $this->response->setJSON(['status' => true, 'msg' => 'Logout berhasil']);
        }
    }
}
