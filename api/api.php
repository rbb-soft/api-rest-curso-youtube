<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

require_once '../api/Database.php';
require_once '../api/Country.php';

$database = new Database();
$db = $database->getConnection();
$country = new Country($db);

// Obtener la URI y dividirla en partes
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$parts = explode('/', trim($uri, '/'));

// Removemos "api" si existe al inicio
if ($parts[0] === 'api') {
    array_shift($parts);
}

// Función que retorna el statement y mensaje según el endpoint solicitado
function getEndpointData($parts, $country) {
    if (!isset($parts[1]) || empty($parts[1])) {
        return [
            'stmt' => $country->getAll(),
            'message' => 'Todos los países'
        ];
    }
    switch ($parts[1]) {
        case 'idioma':
            if (!empty($parts[2])) {
                $idioma = urldecode($parts[2]);
                return [
                    'stmt' => $country->getByLanguage($idioma),
                    'message' => "Países con idioma: $idioma"
                ];
            }
            break;
        case 'continente':
            if (!empty($parts[2])) {
                $continente = urldecode($parts[2]);
                return [
                    'stmt' => $country->getByContinent($continente),
                    'message' => "Países en el continente: $continente"
                ];
            }
            break;
        case 'buscar':
            if (!empty($parts[2])) {
                $busqueda = urldecode($parts[2]);
                return [
                    'stmt' => $country->searchByName($busqueda),
                    'message' => "Resultados de búsqueda para: $busqueda"
                ];
            }
            break;
    }
    return null;
}

// Validamos que la ruta inicie con "paises" y que el método sea GET
if (isset($parts[0]) && $parts[0] === 'paises' && $_SERVER['REQUEST_METHOD'] === 'GET') {
    try {
        $endpoint = getEndpointData($parts, $country);
        if (!$endpoint) {
            http_response_code(404);
            echo json_encode(["error" => "Endpoint no encontrado"]);
            exit;
        }

        $stmt = $endpoint['stmt'];
        $message = $endpoint['message'];

        // Procesar los resultados
        $num = $stmt->rowCount();
        if ($num > 0) {
            $paises_arr = [];
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                extract($row);
                $pais_item = [
                    "nombre"    => $Nombre,
                    "capital"   => $Capital,
                    "poblacion" => $Poblacion,
                    "idiomas"   => explode(', ', $Idiomas),
                    "continente"=> $Continente,
                    "bandera"   => $Bandera
                ];
                array_push($paises_arr, $pais_item);
            }
            echo json_encode(["mensaje" => $message, "resultados" => $paises_arr]);
        } else {
            echo json_encode(["mensaje" => "No se encontraron resultados"]);
        }
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["error" => "Error en el servidor", "detalle" => $e->getMessage()]);
    }
} else {
    http_response_code(404);
    echo json_encode(["error" => "Endpoint no encontrado"]);
}
?>
