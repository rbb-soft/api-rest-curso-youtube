<?php

class Country {
    private $conn;
    
    public function __construct($db) {
        $this->conn = $db;
    }

    // Obtener todos los países
    public function getAll() {
        $query = "SELECT * FROM paises_es";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // Obtener por idioma
    public function getByLanguage($idioma) {
        $query = "SELECT * FROM paises_es WHERE Idiomas LIKE ?";
        $stmt = $this->conn->prepare($query);
        $idioma = "%$idioma%"; // para que busque idioma antes o despues 
        $stmt->bindParam(1, $idioma);
        $stmt->execute();
        return $stmt;
    }

    // Obtener por continente
    public function getByContinent($continente) {
        $query = "SELECT * FROM paises_es WHERE Continente = ? ";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $continente);
        $stmt->execute();
        return $stmt;
    }

    // Búsqueda por nombre 
    public function searchByName($nombre) {
        $query = "SELECT * FROM paises_es WHERE Nombre = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $nombre);
        $stmt->execute();
        return $stmt;
    }
}
?>
