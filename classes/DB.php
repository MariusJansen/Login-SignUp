<?php
/**
 * Singleton-Pattern
 * Auswendig lernen!!
 *
*/
class DB
{
    private static ?DB $_instance = null;
    private PDO $_pdo;
    private $_query;
    private $_error = false;
    protected $_results;
    private $_count = 0;


    /**
     * __construct erstellt ein PDO, welches durch dem Aufruf der Methode 'getInstance()' global aufgerufen werden
     * kann
     *
     */
    private function __construct(){
        try {
            $this->_pdo = new PDO(
                'mysql:host='.Config::get('mysql/host').';dbname=' . Config::get('mysql/db'),
                Config::get('mysql/username'),
                Config::get('mysql/password'));
        } catch (PDOException $e) {
            echo 'Connection error: '.$e->getMessage();
        }
    }

    public static function getInstance(): ?DB
    {
        if(!isset(self::$_instance)){
            self::$_instance = new DB();
        }
        return self::$_instance;
    }

    public function query($sql, $params = []) {
        $this->_error = false;
        if($this->_query = $this->_pdo->prepare($sql)) {
            $elements = 0;
            if(count($params)){
                foreach ($params as $param) {
                    ++$elements;
                    $this->_query->bindValue($elements, $param);

                }

            }
            if($this->_query->execute()){
                $this->_results = $this->_query->fetchAll(PDO::FETCH_OBJ);
                $this->_count = $this->_query->rowCount();
            }
            else {
                $this->_error = true;
            }
        }
        return $this;
    }

    public function error() {
        return $this->_error;
    }

    // Gibt die Anzahl der Funde in der Datenbank zurück
    public function count() {
        return $this->_count;
    }

    // Results der Query bekommen
    public function results() {
        return $this->_results;
    }


}