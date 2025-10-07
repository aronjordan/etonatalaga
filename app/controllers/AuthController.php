<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

class AuthController extends Controller {
    public function __construct(){
        parent::__construct();
        $this->call->model('AuthModel');
        $this->call->library('form_validation');
        $this->call->library('session');
    }

    public function signup(){
        if($this->io->method() == 'post'){
            $this->form_validation->name('firstname')->required();
            $this->form_validation->name('lastname')->required();
            $this->form_validation->name('email')->required()->valid_email();
            $this->form_validation->name('password')->required()->min_length(6);

            if($this->form_validation->run()){
                $email = $this->io->post('email');
                if($this->AuthModel->check_email($email)){
                    $data['error'] = "Email already exists!";
                    $this->call->view('signup', $data);
                    return;
                }

                $data = [
                    'first_name' => $this->io->post('firstname'),
                    'last_name'  => $this->io->post('lastname'),
                    'email'      => $email,
                    'password'   => password_hash($this->io->post('password'), PASSWORD_BCRYPT)
                ];

                $this->AuthModel->register($data);
                redirect(site_url('login'));
            } else {
                $data['errors'] = $this->form_validation->get_errors();
                $this->call->view('signup', $data);
            }
        } else {
            $this->call->view('signup');
        }
    }

    public function login(){
    if($this->io->method() == 'post'){
        $email    = $this->io->post('email');
        $password = $this->io->post('password');

        $user = $this->AuthModel->login($email, $password);
        if($user){
            $this->session->set_userdata('user_id', $user['id']);
            $this->session->set_userdata('user_name', $user['first_name']);
            redirect(site_url('/'));
        } else {
            $data['error'] = "Invalid credentials!";
            $this->call->view('login', $data);
        }
    } else {
        $this->call->view('login');
    }
}


public function dashboard()
{
    // Make sure session library is autoloaded in config
    if (empty($this->session->userdata('user_id'))) {
        redirect(site_url('login'));
    }

    // Pass session data to view
    $this->call->view('dashboard', [
        'user_name' => $this->session->userdata('user_name')
    ]);
}






public function logout()
{
    // Clear all session variables
    $_SESSION = [];

    // Destroy the session completely
    if (session_id() !== "" || isset($_COOKIE[session_name()])) {
        session_destroy();
    }

    // Redirect to login page
    redirect(site_url('login'));
}


}
