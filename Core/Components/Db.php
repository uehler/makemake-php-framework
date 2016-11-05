<?php
namespace Core\Components;

class Db
{
    /** @var  \PDO */
    protected $db;


    public function __construct()
    {
        $config = new Config();

        $this->connect($config->get('db'));
    }


    /**
     * connect to database with credentials which are set in the config
     *
     * @param array $dbCredentials
     */
    private function connect(array $dbCredentials)
    {
        $credentials = '';
        foreach ($dbCredentials as $key => $value) {
            if (!in_array($key, array('user', 'password'))) {
                $credentials .= $key . '=' . $value . ';';
            }
        }

        $this->db = new \PDO(
            'mysql:' . $credentials,
            $dbCredentials['user'],
            $dbCredentials['password'],
            array(
                \PDO::ATTR_EMULATE_PREPARES => false,
                \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION
            )
        );
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
        $stmt = $this->db->prepare($sql);
        $stmt->execute($params);

        return $stmt;
    }
}