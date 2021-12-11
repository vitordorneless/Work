<?php
$empresa = filter_input(INPUT_POST, 'empresa', FILTER_SANITIZE_NUMBER_INT);
$estabelecimento = filter_input(INPUT_POST, 'estabelecimento', FILTER_SANITIZE_NUMBER_INT);
echo '<a class="btn btn-primary btn-facebook pull-right" href="../Controller/lista_nominal.php?empresa=' . $empresa . '&estabelecimento=' . $estabelecimento . '">Download em PDF</a>';
