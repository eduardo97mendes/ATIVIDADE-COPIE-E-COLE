<?php
/**
 * ============================================================
 * ESTE ARQUIVO JÁ ESTÁ PRONTO. Só leia para entender.
 *
 * Quando a pessoa clica em "Enviar pedido", os dados vêm para cá.
 *
 * O caminho é este:
 * 1) Carrega funcoes.php (as regras) e mensagens.php (as telas).
 * 2) Se alguém abrir este arquivo sem enviar o form, volta para pedido.html.
 * 3) Lê os campos com ler_pedido().
 * 4) Confere com validar_pedido()  ← isso você completa em funcoes.php
 * 5) Se tiver erro → mostra a lista e para.
 * 6) Se estiver tudo certo → monta o resumo e mostra na tela.
 *
 * Não coloque o cardápio nem o formulário neste arquivo.
 * ============================================================
 */

require __DIR__ . '/funcoes.php';
require __DIR__ . '/mensagens.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: pedido.html');
    exit;
}

$dados = ler_pedido();
$erros = validar_pedido($dados);

if (!empty($erros)) {
    mostrar_erros($erros);
    exit;
}

$resumo = montar_resumo($dados);
mostrar_sucesso($resumo);
