<?php

namespace App\Controllers;
use App\Models\RegisterModel;

class Register extends BaseController
{
  public function index()
    {
        //include helper form
        helper(['form']);
        helper('date');
        $data = [];
        echo view('auth/register', $data);
    }
 
    public function save()
    {
        //include helper form
        helper(['form']);
        //set rules validation form
        $rules = [
            'username'          => 'required|min_length[3]|max_length[20]',
            'email'         => 'required|min_length[6]|max_length[50]|valid_email|is_unique[user.email]',
            'password'      => 'required|min_length[6]|max_length[200]',
            'cpassword'  => 'matches[password]'
        ];
         
        if($this->validate($rules)){
            $model = new RegisterModel();
            $uniid = md5(str_shuffle('abcsefghijklmonpqrtuvwxyz'.time()));
            $data = [
                'username'     => $this->request->getVar('username'),
                'email'    => $this->request->getVar('email'),
                'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
                'activation_date' => date("Y-m-d h:i:s"),
                'uuid' => $uniid,
            ];
            $model->save($data);
            return redirect()->to('/');
        }else{
            $data['validation'] = $this->validator;
            echo view('auth/register', $data);
        }
         
    }
}
