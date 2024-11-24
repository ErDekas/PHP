<?php
namespace Lib;

use PDO;
use PDOException;

class DataBase
{
    private PDO $con;

    public function __construct(string $host, string $username, string $password, string $dbname)
    {
        try {
            // Establecer la conexión PDO
            $this->con = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    /**
     * Devuelve la conexión PDO.
     *
     * @return PDO
     */
    public function getConnection(): PDO
    {
        return $this->con;
    }
}
?>
