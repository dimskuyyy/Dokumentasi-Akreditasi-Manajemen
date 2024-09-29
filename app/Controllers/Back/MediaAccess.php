<?php

namespace App\Controllers\Back;

use App\Models\MMedia;
use CodeIgniter\HTTP\Response;

class MediaAccess extends BaseController
{
    protected $mediaModel;

    public function __construct()
    {
        $this->mediaModel = new MMedia();
    }

    public function viewMedia($slug)
    {   
        $session = session();
        $userRole = $session->get('type');  // Ambil role user dari session
        $userId = $session->get('id');  // Ambil ID user dari session
        
        // Ambil data media berdasarkan slug
        $data = $this->mediaModel->where('media_slug', $slug)->first();

        // Jika media tidak ada (null)
        if ($data == null) {
            // Gunakan gambar default jika file tidak ditemukan
            $path = WRITEPATH . 'uploads/default/' . 'default.png';
            $mimeType = mime_content_type($path);
        } else {
            // Cek apakah user berhak mengakses media ini
            if (!$this->canAccessMedia($userRole, $userId, $data['media_user_id'])) {
                return redirect()->to('/unauthorized')->with('error', 'Anda tidak memiliki akses ke dokumen ini');
            }

            // Cek apakah file ada dalam folder uploads
            $path = WRITEPATH . 'uploads/' . $data['media_path'];
            if (!file_exists($path) && !is_file($path)) {
                $path = WRITEPATH . 'uploads/default/' . 'default.png';
            }

            $mimeType = mime_content_type($path);
        }

        // Set header respons sesuai dengan tipe file
        $this->response->setHeader('Content-Type', $mimeType);

        // Tampilkan file di browser jika PDF atau gambar, unduh file jika tipe lainnya
        if (in_array($mimeType, ['application/pdf', 'image/jpeg', 'image/png', 'image/webp'])) {
            // Tampilkan di browser (gambar, PDF)
            readfile($path);
        } else {
            // Untuk file selain gambar/PDF, lakukan unduhan
            return $this->response->download($path, null);
        }
    }

    private function canAccessMedia($userRole, $userId, $mediaOwnerId)
    {
        // Admin bisa mengakses semua media
        $adminRoles = [1,2,3,4];
        if (in_array($userRole, $adminRoles)) {
            return true;
        }

        // User biasa hanya bisa mengakses dokumen milik mereka sendiri
        $userRoles = [5,6,7];
        if (in_array($userRole, $userRoles) && $userId == $mediaOwnerId) {
            return true;
        }

        // Jika tidak memenuhi syarat, akses ditolak
        return false;
    }
}
