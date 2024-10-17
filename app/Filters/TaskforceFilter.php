<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class TaskforceFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $ses = session();
        if (!$ses->has('id')) {
            return redirect()->to('wbpanel/login');
        }
        if (AuthUser()->type != 4) {
            return redirect()->to('/wbpanel');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
    }
}
