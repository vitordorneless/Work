<?php
$nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_STRING);
echo '<a class="btn btn-primary btn-facebook pull-left" href="../Controller/dmed_txt.php?nome=' . $nome . '">Download do TXT</a>';