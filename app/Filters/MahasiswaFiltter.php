<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class MahasiswaFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $ses = session();
        if (!$ses->has('id')) {
            return redirect()->to('wbpanel/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        if (AuthUser()->type == 6) {
            return redirect()->to('/wbpanel');
        }
    }
}
