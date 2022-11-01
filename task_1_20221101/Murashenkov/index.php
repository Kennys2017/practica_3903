<?php
    class  DB{
        public $hostname;
        public $login;
        public $password;
        public $baseName;
        public $connection;
        public $result;

        /**
         * @param $hostname
         * @param $login
         * @param $password
         * @param $baseName
         * @param $connection
         */
        public function __construct($hostname, $login, $password, $baseName)
        {
            $this->hostname = $hostname;
            $this->login = $login;
            $this->password = $password;
            $this->baseName = $baseName;
            $this->connection = new mysqli($hostname,$login,$password, $baseName);
        }

        public function selectALL($tableName)
        {
            $this->result = $this->connection->query("SELECT * FROM $tableName");
            return $this;
        }
        public function selectWhereAnd($tableName, $condition){
            $this->result = $this->connection->query("SELECT * FROM " .$tableName . " where " . implode( "AND", $condition));
            return $this;
        }
        public function selectOne($tableName, $string){
            $this->result = $this->connection->query("SELECT * FROM $tableName")->fetch_all(1)[0][$string];
            return $this->result;
        }
        public function getAll()
        {
            $array = [];
            while ($row = $this->result->fetch_assoc()) {
                array_push($array, $row);
            }
            return $array;
        }
    }

        $b = new DB("localhost", "root", "", "pract1");
        var_dump($b->selectALL("test1")->getAll());
        var_dump($b->selectOne("test1", "name"));
        var_dump($b->selectWhereAnd("test1",["name = 'Star'"])->getAll());
