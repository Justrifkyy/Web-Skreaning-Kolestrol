<?php
session_start();

// Load Config
require_once 'app/config/Database.php';
require_once 'app/config/Constants.php';

// Routing Sederhana
$url = isset($_GET['url']) ? $_GET['url'] : 'home';
$url = rtrim($url, '/');
$url = explode('/', $url);

// Menentukan Controller (Default: DashboardController)
$controllerName = isset($url[0]) && $url[0] != '' ? ucfirst($url[0]) . 'Controller' : 'DashboardController';
$methodName = isset($url[1]) ? $url[1] : 'index';

// Cek apakah file controller ada
if (file_exists('app/controllers/' . $controllerName . '.php')) {
    require_once 'app/controllers/' . $controllerName . '.php';
    $controller = new $controllerName();

    if (method_exists($controller, $methodName)) {
        // Panggil method dengan parameter jika ada
        unset($url[0]);
        unset($url[1]);
        call_user_func_array([$controller, $methodName], $url);
    } else {
        echo "Method tidak ditemukan!";
    }
} else {
    echo "Halaman tidak ditemukan (404). Controller: $controllerName";
}
