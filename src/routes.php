<?php
/*
GET     /todos              Retrieves all todos
GET     /todos/1            Retrieve todoa with id=1
GET     /todos/search/bug   Search for todos with 'bug' in the name
POST    /todos              Add new todos
PUT     /todos/1            Updated todos with id=1
DELETE  /todos/1            Delete todos with id=1
 */

$app->get('/todos', function ($req, $resp) {
    $st = $this->db->prepare("SELECT * FROM tasks ORDER BY task");
    $st->execute();
    $todos = $st->fetchAll();
    return $resp->withJson($todos);
});

$app->get('/todos/{id}', function ($req, $resp, $args) {
    $st = $this->db->prepare("SELECT * FROM tasks WHERE id=:id");
    $st->bindParam("id", $args['id']);
    $st->execute();
    $todos = $st->fetchObject();
    return $resp->withJson($todos);
});

$app->get('/todos/search/{target}', function ($req, $resp, $args){
    $st = $this->db->prepare("SELECT * FROM tasks ORDER BY task");
    $st->execute();
    $todos = $st->fetchAll();
    foreach($todos as $todo) {
        if (strpos($todo['task'], $args['target']) != FALSE) {
            return $resp->withJson($todo); // Only returns the first one
        } 
    }
    return $resp->withStatus(404);
});

$app->post('/todos', function ($req, $resp, $args) {
    $body = $req->getBody();
    $json = json_decode($body, true);
    if ($json === NULL) {
        return $resp->withStatus(400);
    }
    $sql = "INSERT INTO tasks (task, status) VALUES (:task, :status)";
    $st = $this->db->prepare($sql);
    $st->bindParam(":task", $json['task']);
    $st->bindParam(":status", $json['status']);
    $st->execute();
    $id = $this->db->lastInsertId();
    $uri = $req->getRequestTarget(); 
    $url = $req->getUri()->getScheme() . "://" . $req->getUri()->getHost() . $uri . "/" . $id;
    $nResp = $resp->withHeader('Location', $url);
    return $nResp->withStatus(201);
});

$app->delete('/todos/{target}', function ($req, $resp, $args) {
    $sql = "DELETE FROM tasks WHERE id=:id";
    $st = $this->db->prepare($sql);
    $st->bindParam(":id", $args['target']);
    $st->execute();
    if ($st->rowCount() === 0) {
        return $resp->withStatus(404);
    }
    return $resp->withStatus(204);
});
