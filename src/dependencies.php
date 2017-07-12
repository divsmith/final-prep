<?php
// Dependency Injection Container

$dic = $app->getContainer();
$conf = new Settings();

$dic['db'] = function($dic) use ($conf) {
    $c = $conf->getConf();
    $dsn = 'mysql:host='.$c["db"]["host"].';dbname='.$c["db"]["dbname"];
    $pdo = new PDO($dsn, $c["db"]["user"], $c["db"]["pass"]);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    return $pdo;
};

$dic['foo'] = function($dic) {
    return 'bar';
};
