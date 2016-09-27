<?php

namespace App\Model;

use Core\Model;

class User extends Model
{
    public function createDatabase()
    {
        $sql = 'CREATE TABLE `user` (
                    `id` int(11) NOT NULL,
                    `firstname` varchar(50) NOT NULL,
                    `lastname` varchar(50) NOT NULL,
                    `email` varchar(200) NOT NULL
                ) ENGINE=InnoDB DEFAULT CHARSET=utf8;

                ALTER TABLE `user`
                    ADD PRIMARY KEY (`id`),
                    ADD UNIQUE KEY `email` (`email`);

                ALTER TABLE `user`
                    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;';
        $this->query($sql);
    }


    public function getUsers()
    {
        $sql = 'SELECT * 
                FROM user';

        return $this->fetchAll($sql);
    }


    public function getUserById($userID)
    {
        $sql = 'SELECT *
                FROM user
                WHERE id = :userID';

        return $this->fetchRow($sql, array('userID' => $userID));
    }


    public function getUserIdByMail($email)
    {
        $sql = 'SELECT id
                FROM user
                WHERE email = ?';

        return $this->fetchOne($sql, array($email));
    }


    public function getUserMails()
    {
        $sql = 'SELECT email
                FROM user';

        return $this->fetchCol($sql);
    }


    public function createUser($firstname, $lastname, $email)
    {
        $sql = 'INSERT INTO
                    user
                SET   
                    firstname = ?,
                    lastname = ?,
                    email = ?';
        $this->query($sql, array($firstname, $lastname, $email));
    }
}