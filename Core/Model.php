<?php

namespace Core;

class Model
{
    protected $db;
    protected $dbCredentials;


    public function __construct(array $dbCredentials)
    {
        $this->dbCredentials = $dbCredentials;
    }


    /**
     * connect to database with credentials which are set in the config
     */
    protected function connect()
    {
        $credentials = '';
        foreach ($this->dbCredentials as $key => $value) {
            if (!in_array($key, array('user', 'password'))) {
                $credentials .= $key . '=' . $value . ';';
            }
        }

        $this->db = new \PDO(
            'mysql:' . $credentials,
            $this->dbCredentials['user'],
            $this->dbCredentials['password'],
            array(
                \PDO::ATTR_EMULATE_PREPARES => false,
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            )
        );
    }


    /**
     * returns the database object
     *
     * @return \PDO
     */
    public function db()
    {
        if ($this->db == null) {
            $this->connect();
        }

        return $this->db;
    }


    /**
     * executes a query
     *
     * @param       $sql
     * @param array $params
     */
    public function query($sql, array $params = array())
    {
        $this->prepare($sql, $params);
    }


    /**
     * fetches only the first column of the first row of the result
     *
     * @param       $sql
     * @param array $params
     *
     * @return mixed
     */
    public function fetchOne($sql, array $params = array())
    {
        return $this->prepare($sql, $params)->fetchColumn(0);
    }


    /**
     * fetches only the first row of the result
     *
     * @param       $sql
     * @param array $params
     *
     * @return mixed
     */
    public function fetchRow($sql, array $params = array())
    {
        return $this->prepare($sql, $params)->fetch(\PDO::FETCH_ASSOC);
    }


    /**
     * fetches only the first column of the result
     *
     * @param       $sql
     * @param array $params
     *
     * @return string
     */
    public function fetchCol($sql, array $params = array())
    {
        return $this->prepare($sql, $params)->fetchAll(\PDO::FETCH_COLUMN);
    }


    /**
     * fetches everything from the db
     *
     * @param       $sql
     * @param array $params
     *
     * @return array
     */
    public function fetchAll($sql, array $params = array())
    {
        return $this->prepare($sql, $params)->fetchAll(\PDO::FETCH_ASSOC);
    }


    /**
     * prepares the query, binds the params and executes the query
     *
     * @param       $sql
     * @param array $params
     *
     * @return \PDOStatement
     */
    protected function prepare($sql, array $params)
    {
        $stmt = $this->db()->prepare($sql);
        $stmt->execute($params);

        return $stmt;
    }
}