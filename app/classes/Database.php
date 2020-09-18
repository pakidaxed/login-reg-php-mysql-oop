<?php

class Database {
    private string $host = 'mysql';
    private string $user = 'root';
    private string $password = 'secret';
    private string $table_name = 'users';

    protected function connect() {
        $conn = new PDO("mysql:host=$this->host;dbname=$this->table_name", $this->user, $this->password);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $conn;
    }


}