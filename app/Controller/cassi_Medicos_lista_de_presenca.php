<?php
include '../../class/ayuadame.php';

$cpf = filter_input(INPUT_POST, 'cpf', FILTER_SANITIZE_STRING);

$confirm = valCpf($cpf);

if ($confirm === TRUE) {
    echo '<div class="alert alert-success" role="alert">CPF Válido!</div>';
} else {
    echo '<div class="alert alert-danger" role="alert">Erro!! CPF Errado...</div>';
}