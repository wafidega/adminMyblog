<?php

namespace App\Controllers;
use App\Models\RegisterModel;

class Admin extends BaseController
{
    public $dModel;
    public function __construct() {
        $this->dModel = new RegisterModel();
        helper('form');
    }
    public function index()
    {
        $data=[];
        $session = session();
        $uuid = session()->get('logged_user');
        $UserData = $this->dModel->getLoggedInUserData($uuid);
        print_r($UserData);
        return view('admin/index');
    }
    public function upload()
    {
        return view('admin/uploadImage');
    }
}
