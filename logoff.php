<?php
session_start();

unset($_SESSION['usuario']);
unset($_SESSION['nome']);
unset($_SESSION['data_nascimento']);
unset($_SESSION['email']);
unset($_SESSION['nickname']);

echo"<script>location.href='index.php';</script>";