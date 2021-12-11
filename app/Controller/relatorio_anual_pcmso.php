<?php
$nome = filter_input(INPUT_POST, 'periodo', FILTER_SANITIZE_STRING);
echo '<a class="btn btn-primary btn-facebook pull-left" href="../Controller/relatorio_anual_pcmso_gerar.php?periodo=' . $nome . '">Download do arquivo</a>';