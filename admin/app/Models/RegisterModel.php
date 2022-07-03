<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Models;
use \CodeIgniter\Model;
/**
 * Description of RegisterModel
 *
 * @author ram
 */
class RegisterModel extends Model {
    // public function createUser($data)
    // {
    //     $builder = $this->db->table('user');
    //     $res = $builder->insert($data);
    //     if($this->db->affectedRows()==1)
    //     {
    //         return true;
    //     }
    //     else
    //     {
    //         return false;
    //     }
    // }
    protected $table = 'user';
    protected $allowedFields = ['uuid','username','email','password','image','createdAt','updatedAt','status','activation_date'];
    public function verifyUniid($id)
    {
         $builder = $this->db->table('user');
         $builder->select('activation_date,uuid,status');
         $builder->where('uuid',$id);
         $result = $builder->get();
         //echo count($result->getResultArray());
         //echo $result->resultID->num_rows;
         if(count($result->getResultArray())==1)
         {
            return $result->getRow();
         }
         else
         {
             return false;
         }
    }

    public function verifyEmail($email){
       
        $builder = $this->db->table('user');
        $builder->select("uuid,status,username,password");
        $builder->where('email',$email);
        $result = $builder->get();
        if(count($result->getResultArray())==1)
        {
            return $result->getRowArray();
        }
        else
        {
            return false;
        }
    }

    public function updatedAt($id){
        $builder = $this->db->table('user');
        $builder->where('uuid', $id);
        $builder->update(['updatedAt'=>date('Y-m-d h:i:s')]);
        if($this->db->affectedRows()==1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function updatePassword($id,$pwd){
        $builder = $this->db->table('user');
        $builder->where('uuid', $id);
        $builder->update(['password'=>$pwd]);
        if($this->db->affectedRows()==1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
    public function saveLoginInfo($data)
    {
        $builder = $this->db->table('login_activity');
        $builder->insert($data);
        if($this->db->affectedRows()==1)
        {
            return $this->db->insertID();
        }
        else
        {
            return false;
        }
    }

    public function getLoggedInUserData($id)
    {
        $builder = $this->db->table('user');
        $builder->where('uuid',$id);
        $result = $builder->get();
        if(count($result->getResultArray())==1)
        {
            return $result->getRow();
        }
        else
        {
            return false;
        }
    }
}