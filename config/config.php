<?php
/**
 * Created by PhpStorm.
 * User: Shokhaa
 * Date: 4/11/19
 * Time: 8:44 PM
 */

class DBConnect
{

    private $server = "mysql:host=localhost;dbname=crud_db";

    private $user = "root";

    private $pass = "6450615a";

    private $options = array(
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    );

    protected $con;

    public function openConnection()
    {
        try {
            $this->con = new PDO($this->server, $this->user, $this->pass, $this->options);
            return $this->con;
        } catch (PDOException $e) {
            echo "There is some problem in connection: " . $e->getMessage();
        }
    }

    public function closeConnection()
    {
        $this->con = null;
    }
}
?>
