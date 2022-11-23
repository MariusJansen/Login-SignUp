<?php

class InputValidation
{
    private $_db;
    private array $_data;
    private array $error = [];

    public function __construct($post_data)
    {
        $this->_data = $post_data;
        $this->_db = DB::getInstance();
    }

    public function validateForm() {
        $this->validateUsername();
        $this->validatePassword();
        $this->validateName();
        return $this->error;
    }

    public function validateUsername() {
        $val = trim($this->_data['username']);
        $usernameCount =
            $this->_db->query('SELECT * FROM users where username = ?', [$val])->count();
        if(empty($val)) {
            $this->addErrors('username','Please enter a new username');
        } elseif (!preg_match('/^[a-zA-Z0-9]{4,12}$/', $val)){
            $this->addErrors('username',"Username must be 4-12 chars & alphanumeric.");
        } elseif ($usernameCount>0){
            $this->addErrors('username','Username already exists.');
        }
        return $this->error;

    }

    public function validatePassword()
    {
        $valPassword = $this->_data['password'];
        $valNewPassword = $this->_data['reenterPassword'];
        if(empty($valPassword)){
            $this->addErrors('password','Please fill in a password');
        }
        elseif(!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,50}$/',$valPassword)){
            $this->addErrors('password', 'Password musst be 8-50 chars & contains spacial chars');

        }
        elseif (empty($valNewPassword)) {
            $this->addErrors('password', 'Repeat your password');
        }
        elseif ($valPassword != $valNewPassword) {
            $this->addErrors('password', 'Password do not match');
        }
        return $this->error;
    }

    private function validateName( )
    {
        $val = $this->_data['name'];

        if(empty($val)){
            $this->addErrors('name','Please fill in your full name');
        } else {
            // Checks if the $val matches the regular expression
            if(!preg_match('/^[a-zA-Z ]{4,50}$/', $val)){
                $this->addErrors('name','Name must be 4-50 chars & alphabetic.');
            }
        }
        return $this;
    }



    private function addErrors($key, $val){
        $this->error[$key] = $val;
    }
}