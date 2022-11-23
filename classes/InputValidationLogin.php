<?php

class InputValidationLogin
{
    private $_db;
    private array $_data;
    private array $errors = [];


    public function __construct($post_data)
    {
        $this->_data = $post_data;
        $this->_db = DB::getInstance();

    }


    public function validateLogin()
    {
        $valUsername = trim($this->_data['username']);
        $valPassword = $this->_data['password'];

        if(empty($valUsername)) {
            $this->addError('username', 'Please fill in an username');
        } else {
            $usernameCheck = $this->_db->query('SELECT username FROM users WHERE username = ?', [$valUsername]);
            if($usernameCheck->count() == 0){
                $this->addError('username','Your username does not exist.');
            }
        }
        if(empty($valPassword)){
            $this->addError('password', 'Please fill in a password');
        } else if($usernameCheck->count() > 0) {
            $results = $this->_db->query('SELECT username,password FROM users where username = ?', [$this->_data['username']]);
            foreach ($results->results() as $result) {
                $hashedPassword = $result->password;
            }
            if(!password_verify($this->_data['password'],$hashedPassword)){
                $this->addError('password','You entered a wrong password');
            }
        }
        return $this->errors;
    }

    private function addError($key, $val) {
        $this->errors[$key] = $val;
    }

}