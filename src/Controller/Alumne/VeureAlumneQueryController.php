<?php
namespace App\Controller\Alumne;

use App\Infrastructure\Database\DatabaseConnection;

class VeureAlumneQueryController {
    public function queryalumne($db){
        try{
            $db = DatabaseConnection::getConnection();
            $query = $db->query("SELECT * FROM students");
            $alumnes = $query->fetchAll(\PDO::FETCH_ASSOC);
            echo view('alumneveure', ['alumne' => $alumnes]);
        }catch(\PDOException $e){
            echo "Error de conexión: " . $e->getMessage();
        }
    }
}
