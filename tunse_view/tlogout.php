<?php
session_start();
unset($_SESSION['t_id']);
session_destroy();
header("Location:tunsehome");

