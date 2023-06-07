<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;
use CodeIgniter\Email\Email;

class AuthController extends Controller
{

    protected $encrypter;
    protected $form_validation;
    protected $M_user;
    protected $session;
    protected $db;
    protected $status_verifikasi;
    protected $PendaftaranModel;

    public function __construct()
    {
        $this->encrypter = \Config\Services::encrypter();
    }

    public function index()
    {
        $data['title']   = "SI AMANG | Reset Password";
        return view('v_login/forgot_password', $data);
    }

    public function forgotPassword()
    {
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'email' => [
                    'label' => 'Email',
                    'rules' => 'required|valid_email'
                ]
            ];

            if (!$this->validate($rules)) {
                return redirect()->back()->withInput()->with('error', $this->validator->getErrors());
            }

            $userModel = new UserModel();
            $user = $userModel->getUserByEmail($this->request->getPost('email'));

            if (!$user) {
                return redirect()->back()->withInput()->with('error', 'Email Tidak Terdaftar');
            }

            $token = bin2hex(random_bytes(32));
            $userModel->update($user['id'], ['token' => $token]);
            $email = service('email');
            $email->setTo($user['email']);
            $email->setFrom('noreply@tm.diskominfojogja.ac.id', 'Diskominfosan');
            $email->setSubject('Reset Password - Diskominfosan');
            $emailMessage = '<p>Kami menerima permintaan untuk mereset password akun Anda di Diskominfosan.</p><p>Silakan klik tombol di bawah ini untuk melanjutkan proses reset password:</p><a href="'.base_url().'/authController/resetPassword/'.$token.'" style="background-color: #1E88E5; color: #FFFFFF; display: inline-block; font-size: 14px; line-height: 36px; text-align: center; text-decoration: none; width: 200px; border-radius: 18px; -webkit-border-radius: 18px; -moz-border-radius: 18px;">Reset Password</a><p>Jika Anda tidak melakukan permintaan ini, silakan abaikan email ini.</p><p>Terima kasih,</p><p>Diskominfosan</p>';
            $email->setMessage($emailMessage);
            

            if ($email->send()) {
                return redirect()->back()->with('success', 'Email terkirim. Silakan periksa email Anda untuk instruksi selanjutnya.');
            } else {
                return redirect()->back()->withInput()->with('error', 'Gagal Mengirim Email..!');
            }
        }
        return view('v_login/forgot_password');
    }


    public function resetPassword($token)
    {
        $model = new UserModel();
    
        $data['title'] = 'Reset Password';
        $data['validation'] = \Config\Services::validation();
        $data['token'] = $token;
    
        $user = $model->getUserByToken($token);
        if (!$user) {
            http_response_code(404);
            echo "<div class=\"error-container\">
                      <h2 class=\"error-heading\">Maaf, Token Telah Expired</h2>
                      <p class=\"error-message\">Kami mohon maaf atas ketidaknyamanan yang terjadi. Permintaan Anda tidak dapat kami proses karena token sudah expired atau sudah digunakan. Silahkan untuk melakukan request reset password kembali!</p>
                      <div style=\"width: 400px; height: 400px;\" id=\"lottie-player\"></div>
                  </div>
                  <style>
                  .error-container {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    height: 100vh;
                    padding: 1rem;
                    text-align: center;
                    background-color: #f2f2f2;
                  }
                  
                  .error-heading {
                    font-size: 3rem;
                    margin-bottom: 1rem;
                    font-family: 'Montserrat', sans-serif;
                    color: #333333;
                  }
                  
                  .error-message {
                    font-size: 1.5rem;
                    margin-bottom: 2rem;
                    font-family: 'Montserrat', sans-serif;
                    color: #555555;
                  }
            
                  
                  </style>
                  <script src=\"https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.7.9/lottie.min.js\"></script>
                  <script>
                    var animation = bodymovin.loadAnimation({
                        container: document.getElementById('lottie-player'),
                        renderer: 'svg',
                        loop: true,
                        autoplay: true,
                        path: 'https://assets2.lottiefiles.com/packages/lf20_ttvteyvs.json'
                    });
                  </script>"
                  ;
            exit;
        }
        
        if ($this->request->getMethod() == 'post') {
            $rules = [
                'password' => [
                    'label'  => 'Password',
                    'rules'  => 'required|min_length[6]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'min_length' => '{field} minimal 6 karakter'
                    ]
                ],
                'password_confirmation' => [
                    'label'  => 'Konfirmasi Password',
                    'rules'  => 'required|matches[password]',
                    'errors' => [
                        'required' => '{field} harus diisi',
                        'matches' => 'Konfirmasi password tidak cocok'
                    ]
                ]
            ];
    
            if (!$this->validate($rules)) {
                $data['validation'] = $this->validator;
            } else {
                $model->resetPassword($user['token'], base64_encode($this->encrypter->encrypt($this->request->getPost('password'))));
                session()->setFlashdata('message', 'Password telah berhasil direset');
                return redirect()->to(base_url('login'))->with('success', 'Password telah berhasil direset. Silakan masuk dengan password baru Anda.');
            }
        }
    
        return view('v_login/reset_password', $data);
    }
    
}