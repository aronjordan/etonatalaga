<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: AuthModel
 * 
 * Automatically generated via CLI.
 */
class AuthModel extends Model {
    protected $table = 'users';
    protected $primary_key = 'id';

    public function __construct()
    {
        parent::__construct();
    }

    // ✅ Check if email exists
    public function check_email($email){
        return $this->db->table($this->table)->where('email', $email)->get();
    }

    // ✅ Register
    public function register($data){
        return $this->db->table($this->table)->insert($data);
    }

    // ✅ Login
    public function login($email, $password){
        $user = $this->db->table($this->table)->where('email', $email)->get();
        if($user && password_verify($password, $user['password'])){
            return $user;
        }
        return false;
    }
}