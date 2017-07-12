<?php

$app->get('/todos', function ($req, $resp) {
    $st = $this->db->prepare("SELECT * FROM tasks ORDER BY task");
    $st->execute();
    $todos = $st->fetchAll();
    return $resp->withJson($todos);
});
