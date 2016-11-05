<?php

namespace Core;

use Core\Components\Db;

class Model
{
    /** @var  \PDO */
    protected $db;


    public function __construct()
    {
        $this->db = new Db();
    }
}