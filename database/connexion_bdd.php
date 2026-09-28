<?php

class Database {
    private const $host = 'localhost';
    private const $user = 'root';
    private const $pass = '';
    private const $db_name = 'clubtheatre';

    // Instance partagée pour éviter d'ouvrir plusieurs connexions
    private static ?PDO $instance = null;

    /**
     * Retourne la connexion PDO à la base de données `clubtheatre`.
     * La connexion est créée au premier appel puis réutilisée.
     */
    public function connexionBdd(){
        try {
            $connexion = new PDO(
                "mysql:host=$this->host;dbname=$this->dbName;charset=utf8",
                $this->user,
                $this->pass
            );
            $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erreur de connexion : " . $e->getMessage();
            die();
        }
        return $connexion;
    }
}




?>
<?php

function connexionBdd(){
    $host   = "localhost";
    $user   = "root";
    $pass   = "";
    $dbName = "myseriescompanion";
    try {
        $connexion = new PDO(
            "mysql:host=$host;dbname=$dbName;charset=utf8",
            $user,
            $pass
        );
        $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
        die();
    }
    return $connexion;
}
?>