<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'user_nama' => 'Dekan',
                'user_username' => 'Dek001',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 1,
                'user_type' => 1,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')

            ],
            [
                'user_nama' => 'Ketua Jurusan',
                'user_username' => 'Kajur001',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 1,
                'user_type' => 2,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')

            ],
            [
                'user_nama' => 'Koordinator Program Studi',
                'user_username' => 'Koord001',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 1,
                'user_type' => 3,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')

            ],
            [
                'user_nama' => 'Ketua Taskforce',
                'user_username' => 'Ketua001',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 1,
                'user_type' => 4,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')

            ],
            [
                'user_nama' => 'Tenaga Kependidikan',
                'user_username' => 'Tendik001',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 8,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')

            ],
            [
                'user_nama' => 'Prof. Dr. H.B. Isyandi, SE, MS',
                'user_username' => 'D00001',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 5,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'Prof. Dr. Harlen, SE, MM',
                'user_username' => 'D00002',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 5,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'Prof. Dr. Syapsan, SE, ME',
                'user_username' => 'D00003',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 5,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'Dr. Deny Setiawan, SE,M . Ec',
                'user_username' => 'D00004',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 5,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'Dr. Sri Endang Kornita, SE, M. Si',
                'user_username' => 'D00005',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 5,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'Dr. Dahlan Tampubolon, SE, M. Si',
                'user_username' => 'D00006',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 5,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'Dr. Rosyetti, SE,M . Si',
                'user_username' => 'D00007',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 5,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'Dr. Jahrizal, SE, MT',
                'user_username' => 'D00008',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 5,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'Dr. Ando Fahda Aulia',
                'user_username' => 'D00009',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 5,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'Dr. Eka Armas Pailis, SE, MM',
                'user_username' => 'D00010',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 5,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'Dr. Yusni Maulida, SE,M . Si',
                'user_username' => 'D00011',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 5,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'Dr. Any Widayatsari, SE, M. SE',
                'user_username' => 'D00012',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 5,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'Dr. Taryono, SE, M. Si',
                'user_username' => 'D00013',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 5,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'Dr. Khusnul Fikri, MM',
                'user_username' => 'D00014',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 5,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'REZZA RIA RAMADHANI',
                'user_username' => 'M00001',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 6,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'MUTIA NURHALIZA',
                'user_username' => 'M00002',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 6,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'ALFINA SAFIRA ZAHRA',
                'user_username' => 'M00003',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 6,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'HAZRAT AL GHIFARI',
                'user_username' => 'M00004',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 6,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'YUSTIARA RAHMI',
                'user_username' => 'M00005',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 6,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'DWI PUTRI ARYAHIYATI',
                'user_username' => 'M00006',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 6,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'MARTHA AMBARITA',
                'user_username' => 'M00007',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 6,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'ADE INDRA SAKTI',
                'user_username' => 'M00008',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 6,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'DONI PARIS SAPUTRA',
                'user_username' => 'M00009',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 6,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'GERI VALDI MAULI',
                'user_username' => 'M00010',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 6,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'RIO ADHI PRATAMA',
                'user_username' => 'M00011',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 6,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'TRI ANUNG ANINDITA',
                'user_username' => 'M00012',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 6,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'SUDIRMAN',
                'user_username' => 'M00013',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 6,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'PRIMANDA OKTODINATA',
                'user_username' => 'M00014',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 6,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'RONALD RINALDY',
                'user_username' => 'M00015',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 6,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'DWI YANTI MUHARNI YULIS',
                'user_username' => 'A00001',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 7,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'RISMA SARI',
                'user_username' => 'A00002',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 7,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'SAHARA SANITRA',
                'user_username' => 'A00003',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 7,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'RIDHO DWIANTO',
                'user_username' => 'A00004',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 7,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'LUCKYTO SAPUTRA',
                'user_username' => 'A00005',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 7,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'SAPARMAN',
                'user_username' => 'A00006',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 7,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'SHELLY MEILIZA',
                'user_username' => 'A00007',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 7,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'REXA ANANDA',
                'user_username' => 'A00008',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 7,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'M HAMID',
                'user_username' => 'A00009',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 7,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
            [
                'user_nama' => 'DWIKA AGUNG SETIAWAN',
                'user_username' => 'A00010',
                'user_password' => password_hash('12345', PASSWORD_BCRYPT),
                'user_level' => 2,
                'user_type' => 7,
                'user_status' => 2,
                'user_created_at' => date('Y-m-d H:i:s')
            ],
        ];

        $this->db->table('user')->insertBatch($data);
    }
}
