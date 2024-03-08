<?php
$host="localhost";
$user="root";
$mysqli = new mysqli("localhost","root","","dbtoko");

// Check connection
if ($mysqli -> connect_errno) {
  echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
  exit();
}
