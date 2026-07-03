<?php
require_once __DIR__ . '/config.php';

if (!estaLogueado()) {
    redireccionar('login.php');
}