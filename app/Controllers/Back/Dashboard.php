<?php

namespace App\Controllers\Back;

class Dashboard extends BaseController
{
    public function index()
    {
        // $data['logo'] = $this->getLogo();
        return view('dashboard/index');
    }
}
