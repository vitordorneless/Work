<?php

$cpfs = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);
$agencias = filter_input(INPUT_POST, 'agencia', FILTER_SANITIZE_NUMBER_INT);

echo '<a href="../Controller/cassi_lista_presenca_imprimir_pdf.php?cpf=' . $cpfs . '&agencia=' . $agencias . '" class="btn btn-primary btn-dropbox" id="imprimir_lista_de_presenca">Download Lista de Presença <span class="glyphicon glyphicon-print" aria-hidden="true"></span></button>';
