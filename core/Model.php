<?php 
require_once './core/QueryBuilder.php';
class Model
{
    protected $db;
    protected $queryBuilder;
    public function __construct()
    {
        $config = require 'config/db.php';
        $this->db = new mysqli($config['hostname'], $config['username'], $config['password'], $config['database']);

        if ($this->db->connect_error) {
            die("Connection failed: " . $this->db->connect_error);
        }

        $this->queryBuilder = new QueryBuilder($this->db);

    }
}