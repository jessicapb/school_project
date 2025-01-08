<?php

namespace App\Controller\Graus;

use App\School\Entities\Degrees;
use App\Infrastructure\Persistence\DegreesRepository;
use App\School\Exceptions\BuildExceptions;

class BDGrausController{
    private \PDO $db;

    public function __construct(\PDO $db){
        $this->db = $db;
    }

    public function savedegrees(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(empty($_POST['name']) or empty($_POST['duration_years'])){
                $_SESSION['error'] = "Camps obligatoris.";
                header('Location: /indexgraus');
                exit;
            }

            $name = $_POST['name'];
            $duration_years = $_POST['duration_years'];

            try {
                $degreesRepository = new DegreesRepository($this->db);
                if($degreesRepository->exists($name)){
                    session_start();
                    $_SESSION['error'] = "El departament amb el $name ja existeix.";
                    header('Location: /indexgraus');
                }
                $degrees = new Degrees($name, $duration_years);
                $degreesRepository->save($degrees);
                header('Location: /veuregrau');
                exit;
            } catch (BuildExceptions $e) {
                session_start();
                $_SESSION['error'] = $e->getMessage();
                header('Location: /indexgraus');
                exit;
            }
        }
    }
    
    public function getDegrees() {
        session_start();
        $sql = "SELECT name, duration_years FROM degrees";
        $stmt = $this->db->query($sql);
        $degrees = [];
        $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
        if ($result) {
            foreach ($result as $row) {
                    $degrees[] = [
                        'name' => $row['name'],
                        'duration_years' => $row['duration_years']
                    ];
            }
        }
        $_SESSION['degrees'] = $degrees;
        return $degrees;
    }
    
    public function mostrarVista() {
        $degrees = $this->getDegrees();
        echo view('veuregraus', ['degrees' => $degrees]);
    } 
}