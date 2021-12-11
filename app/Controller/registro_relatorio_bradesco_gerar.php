<?php

$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
echo '<a class="btn btn-primary btn-facebook pull-left" href="../Controller/registro_relatorio_bradesco.php?nome=' . $nome . '">Download do Excel</a>';
