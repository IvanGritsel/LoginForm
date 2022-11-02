<?php

require_once __DIR__ . '/../vendor/autoload.php';

$loader = new Twig\Loader\FilesystemLoader(__DIR__ . '/template');
$twig = new Twig\Environment($loader);

$context = [
    'pageTitle' => 'Login',
    'loggedIn' => false,
    'stylesheetPath' =>'/../css/styles.css',
];

$url = $_SERVER['REQUEST_URI'];
$auth = parse_url($url)['query'];
if ($auth == 'invalid') {
    $context['invalid'] = true;
    //echo '!';
}

echo $twig->render('main.twig', $context);
