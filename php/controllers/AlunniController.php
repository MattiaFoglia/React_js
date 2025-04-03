<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AlunniController
{
  public function index(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("SELECT * FROM alunni");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function view(Request $request, Response $response, $args){
    $id = $args["id"];
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("SELECT * FROM alunni WHERE id = $id");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function create(Request $request, Response $response, $args){
    $body = json_decode($request->getBody()->getContents(),true);
    $nome = $body["nome"];
    $cognome = $body["cognome"];

    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("INSERT INTO alunni (nome, cognome) VALUES ('$nome', '$cognome')");
    $response->getBody()->write(json_encode($result));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);

}

public function update(Request $request, Response $response, $args){
  $body = json_decode($request->getBody()->getContents(),true);
  $nome = $body["nome"];
  $cognome = $body["cognome"];
  $id = $args["id"];
  $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
  $result = $mysqli_connection->query("UPDATE alunni SET nome = '$nome', cognome = '$cognome' WHERE id = '$id' ;");
  $response->getBody()->write(json_encode($result));
  return $response->withHeader("Content-type", "application/json")->withStatus(200);
}

public function destroy(Request $request, Response $response, $args){
  $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
  $id=$args["id"];
  $result = $mysqli_connection->query("DELETE FROM alunni WHERE id = '$id';");

  $response->getBody()->write(json_encode($result));
  return $response->withHeader("Content-type", "application/json")->withStatus(200);
}

public function searchN(Request $request, Response $response, $args){
  $nome = $args["nome"];

  $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
  $result = $mysqli_connection->query("SELECT * FROM alunni WHERE nome LIKE '%$nome%' ");
  $results = $result->fetch_all(MYSQLI_ASSOC);

  $response->getBody()->write(json_encode($results));
  return $response->withHeader("Content-type", "application/json")->withStatus(200);
}

public function searchC(Request $request, Response $response, $args){
  $cognome = $args["cognome"];

  $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
  $result = $mysqli_connection->query("SELECT * FROM alunni WHERE cognome LIKE '%$cognome%' ");
  $results = $result->fetch_all(MYSQLI_ASSOC);

  $response->getBody()->write(json_encode($results));
  return $response->withHeader("Content-type", "application/json")->withStatus(200);
}

public function order(Request $request, Response $response, $args){
  $sort = $args["col"];
  $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
  $result = $mysqli_connection->query("SELECT * FROM alunni ORDER BY $sort");
  $results = $result->fetch_all(MYSQLI_ASSOC);

  $response->getBody()->write(json_encode($results));
  return $response->withHeader("Content-type", "application/json")->withStatus(200);
}

public function sort(Request $request, Response $response, $args){
  $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
  $results = $mysqli_connection->query("describe alunni");
  $found = false;
  $columns = $results->fetch_all(MYSQLI_ASSOC);
    foreach($columns as $col){
    if($col['Field'] == $args["col"]){
      $found = true;
      break;
    }
  }
  if(!$found){
    $response->getBody()->write(json_encode("Errore"));
    return $response->withHeader("Content-type", "application/json")->withStatus(404);
  }else{
    $sort = $args["col"];
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("SELECT * FROM alunni ORDER BY $sort");
    $results = $result->fetch_all(MYSQLI_ASSOC);
  
    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

}

}
