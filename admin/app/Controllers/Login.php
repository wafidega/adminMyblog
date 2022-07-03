<?php namespace App\Controllers;
 
use CodeIgniter\Controller;
use App\Models\RegisterModel;
 
class Login extends Controller
{
  public $RegisterModel;
    public $session;
    public function index()
    {
      helper('form','array');
        echo view('auth/login');
    } 
 
    public function auth()
    {
        $session = session();
        $model = new RegisterModel();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        $data = $model->where('email', $email)->first();
        if($data){
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if($verify_pass){
                $ses_data = [
                    'id'       => $data['id'],
                    'username'     => $data['username'],
                    'email'    => $data['email'],
                    'logged_in'     => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/admin');
            }else{
                $session->setFlashdata('msg', 'Wrong Password');
                return redirect()->to('/');
            }
        }else{
            $session->setFlashdata('msg', 'Email not Found');
            return redirect()->to('/');
        }
    }
 
    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }

    public function forgot_password() {
      helper (['form']);
      $this->RegisterModel = new RegisterModel();
      $this->session = session();  
      $data = [];
      $rules = [
        'email'=>[
            'label' => 'Email',
            'rules'=> 'required|valid_email',
            'errors' => [
                'required' =>'{field} field required',
                'valid_email' => 'Valid {field} required'
            ]
        ],
    ];
     if($this->validate($rules)){
         $email = $this->request->getVar('email',FILTER_SANITIZE_EMAIL);
         $userdata = $this->RegisterModel->verifyEmail($email);
         if(!empty($userdata)){
             if($this->RegisterModel->updatedAt($userdata['uuid'])){
                $to = $email;
                $subject = 'Reset Password Link';
                $token = $userdata['uuid'];
                $message = 'Hi '.$userdata['username'].'<br><br>'
                        . 'Your reset password request has been received. Please click'
                        . 'the below link to reset your password.<br><br>'
                        . '<a href="'. base_url().'/login/reset_password/'.$token.'">Click here to Reset Password</a><br><br>'
                        . 'Thanks<br>GoPHP';
                $email = \Config\Services::email();
                $email->setTo($to);
                $email->setFrom('movieticz@gmail.com','myblog');
                $email->setSubject($subject);
                $email->setMessage($message);
                if($email->send())
                {
                    session()->setTempdata('success','Reset password link sent to your registred email. Please verify with in 15mins',3);
                    return redirect()->to(current_url());
                }
                else
                {
                    $data = $email->printDebugger(['headers']);
                    print_r($data);
                }
             }
             else
             {
                 $this->session->setTempdata('error','Sorry! Unable yo update. try again',3);
                return redirect()->to(current_url());
             }
         }
         else{
            $this->session->setTempdata('error','Email does not exists',3);
            return redirect()->to(current_url());
         }
     }
     else{
         $data['validation']=$this->validator;
     }
      return view("auth/forgot-password", $data);
    }
    
} 