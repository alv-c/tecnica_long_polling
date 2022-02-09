<?php

    $timestart = time();
    $pdo = new PDO('mysql:host=localhost;dbname=nameDataBase', 'user', 'pass');

    if (isset($_POST['timestamp'])) {
        $timestamp = $_POST['timestamp'];
    }

    else {

        $pega_time = $pdo->prepare("SELECT NOW() as now");
        $pega_time->execute();
        $row = $pega_time->fetchObject();

        $timestamp = $row->now;

    }

    $sql = $pdo->prepare("SELECT * FROM notificaGarcom WHERE timestamp > '$timestamp'");

    $newData = false;
    $notificacoes = Array();

    while (!$newData && (time() - $timestart) < 20) {

        $sql->execute();

        while ($row = $sql->fetchAll(PDO::FETCH_ASSOC)) {
            $notificacoes = $row;
            $newData = true;
        }

        usleep(500000);

    }

    $pega_time = $pdo->prepare("SELECT NOW() as now");
    $pega_time->execute();
    $row = $pega_time->fetchObject();

    $timestamp = $row->now;
    $data = Array('notificacoes' => $notificacoes, 'timestamp' => $timestamp);

    echo json_encode($data);
    exit;

?>