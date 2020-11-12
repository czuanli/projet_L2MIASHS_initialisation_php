<?php

$pdo = new pdo('mysql:dbname=groupeS;host=localhost', 'groupeS','bie5Ooqu');

$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

?>