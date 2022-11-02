<?php

require_once __DIR__ . '/../../vendor/autoload.php';


$body = [
    'login' => $_POST['login'],
    'password' => $_POST['password'],
];

$body = json_encode($body);

$sock = socket_create(AF_INET, SOCK_STREAM, 0);

$result = socket_connect($sock, '127.0.0.1', 9090);

$message = "POST /login HTTP1.1\r\n\r\n$body";
socket_write($sock, $message, strlen($message));
$response = socket_read($sock, 1024);
socket_close($sock);

$responseLines = preg_split("/\r\n/", $response);
$responseBody = json_decode(end($responseLines), true);
if ($responseBody) {
    session_start();

    $code = preg_split('/\s/', $responseLines[0])[1];
    $responseBody['code'] = $code;
    $responseBody['loggedIn'] = true;
    $responseBody['PageTitle'] = 'Welcome';
    $responseBody['stylesheetPath'] = __DIR__ . '/../css/styles.css';

    $loader = new Twig\Loader\FilesystemLoader(__DIR__ . '/../template');
    $twig = new Twig\Environment($loader);

    //$_POST['responseBody'] = $responseBody;

    if ($code == 200 || $code == 204) {
        echo $twig->render('main.twig', $responseBody);
    } else {
        echo $twig->render('error.twig', $responseBody);
    }
} else {
    header('Location: http://localhost:8080/?invalid');
}
