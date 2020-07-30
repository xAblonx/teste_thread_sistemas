<?php 
    try {
        $connection = new PDO("pgsql:host=192.168.99.100;port=5433;dbname=postgres;user=postgres;password=docker");
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'ERROR: ' . $e->getMessage(); 
    }
?>