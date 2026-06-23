<?php

/**
 * BaseModel — menyimpan koneksi PDO ($this->db).
 */
class Model
{
    protected PDO $db;

    public function __construct()
    {
        $this->db = getConnection();
    }
}
