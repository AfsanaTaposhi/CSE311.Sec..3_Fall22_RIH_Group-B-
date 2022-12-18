<?php

  $server = 'localhost';
  $username = 'root';
  $password = '';
  $database = 'pakh_pakhali';

  $connection = new mysqli('localhost', 'root', '', 'pakh_pakhali');

  if ($connection->connect_error) {
    exit('Error connecting to database'); //Should be a message a typical user could understand in production
  }

?>
