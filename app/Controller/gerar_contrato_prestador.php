<?php
$id_prestador = filter_input(INPUT_POST, 'id_prestador', FILTER_SANITIZE_STRING);
echo '<a class="btn btn-primary btn-facebook pull-left" href="../Controller/gerar_contrato_prestador_file.php?id_prestador=' . $id_prestador . '">Download do Contrato</a>';