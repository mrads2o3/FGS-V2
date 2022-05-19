<?php

namespace App\Controllers;

class Admin extends BaseController
{
    public function index()
    {
        echo 'ini halaman khusus <b> admin </b> ya gaes';
    }

    public function panelAdmin()
    {
        return view('admin/index');
    }
}
?>