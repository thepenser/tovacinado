<?php

session_name('ga');
session_start();

unset($_SESSION['login']);
unset($_SESSION['apikey']);

//header("Location: ../");
exit;