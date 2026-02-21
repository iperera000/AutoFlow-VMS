<?php
session_start();
session_destroy();
header('Location: ../php/company-login.php');
exit;