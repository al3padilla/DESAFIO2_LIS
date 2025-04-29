<?php
session_start();
session_unset();
session_destroy();

header("Location: /Desafío2/app/views/home");
exit();
?>
