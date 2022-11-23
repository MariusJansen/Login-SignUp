<?php

class User
{
    /**
     * @var DB|null
     */
    private ?DB $_db;
    /**
     * @var array
     */
    private array $_data;
    /**
     * @var mixed|null
     */
    private mixed $_sessionName;
    private $errors = [];

    public function __construct($PostData)
    {
        $this->_db = DB::getInstance();
        $this->_data = $PostData;
        $this->_sessionName = Config::get('session/session_name');
        $this->errors;
    }

    public function registerNewUser() {
        // Fügt einen neuen User zur Datenbank hinzu
        $this->_db->query('INSERT INTO users (username, password, name, joined) VALUES(?,?,?,?)',
            [$this->_data['username'], password_hash($this->_data['password'],PASSWORD_DEFAULT), $this->_data['name'],
                date('Y.m.d h:i:s')]);
        header('Location: login.php');
    }

    public function loginUser()
    {
        $results = $this->_db->query('SELECT password,username FROM users where username = ?', [$this->_data['username']]);

        // Schleife über fetch_obj
        foreach ($results->results() as $result) {
            $hashedPassword = $result->password;
        }
        // Checkt, ob das hashed password mit der Eingabe des Nutzers übereinstimmt
        if(password_verify($this->_data['password'], $hashedPassword)){
            $_SESSION[$this->_sessionName] = $result->username;
            header('Location: index.php');
        }

    }

    public function logoutUser()
    {
        setcookie(session_name(), '', 100);
        session_unset();
        session_destroy();
        header('Location: login.php');
    }

    public function updateUsername() {
        $this->_db->query('UPDATE users SET username = ? WHERE username = ?', [$this->_data['username'],$_SESSION[Config::get('session/session_name')]]);
        $_SESSION[$this->_sessionName] = $this->_data['username'];
    }

    public function updatePassword() {
        $hashedPassword = password_hash($this->_data['password'], PASSWORD_DEFAULT);
        $this->_db->query('UPDATE users SET password = ? WHERE username = ?',[$hashedPassword,$_SESSION[Config::get('session/session_name')]]);
    }

}

