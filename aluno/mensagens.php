<?php
/**
 * ============================================================
 * ESTE ARQUIVO JÁ ESTÁ PRONTO. Só leia para entender.
 *
 * Depois que o pedido é enviado, o PHP mostra UMA destas telas:
 * - mostrar_erros()    → o que faltou no formulário
 * - mostrar_sucesso()  → resumo (nome, produto, total)
 *
 * Usa o mesmo style.css das outras páginas.
 * O cardápio e o formulário continuam nos arquivos .html.
 * ============================================================
 */

function e($texto)
{
    // Troca caracteres perigosos para não quebrar o HTML (por exemplo < > ")
    return htmlspecialchars((string) $texto, ENT_QUOTES, 'UTF-8');
}

function html_inicio($titulo)
{
    $titulo_e = e($titulo);
    echo '<!DOCTYPE html><html lang="pt-BR"><head><meta charset="UTF-8">';
    echo '<meta name="viewport" content="width=device-width, initial-scale=1.0">';
    echo '<title>' . $titulo_e . '</title>';
    echo '<link rel="stylesheet" href="style.css">';
    echo '</head><body>';
    echo '<header><h1>Sabor Express</h1>';
    echo '<nav><a href="comece.html">Comece aqui</a> <a href="index.html">Cardápio</a> <a href="pedido.html">Fazer pedido</a></nav>';
    echo '</header><main>';
}

function html_fim()
{
    echo '</main><footer><p>Sabor Express — exercício de HTML, CSS e PHP</p></footer>';
    echo '</body></html>';
}

function mostrar_erros($erros)
{
    html_inicio('Sabor Express — Corrija o pedido');
    echo '<section class="erros"><h2>Corrija os campos abaixo</h2><ul>';
    foreach ($erros as $erro) {
        echo '<li>' . e($erro) . '</li>';
    }
    echo '</ul><p><a href="pedido.html">Voltar ao formulário</a></p></section>';
    html_fim();
}

function mostrar_sucesso($resumo)
{
    html_inicio('Sabor Express — Pedido confirmado');
    echo '<section class="resumo">';
    echo '<h2>Pedido confirmado</h2>';
    echo '<p>Obrigado, <strong>' . e($resumo['nome']) . '</strong>. Recebemos o seu pedido.</p>';
    echo '<ul>';
    echo '<li>Telefone: ' . e($resumo['telefone']) . '</li>';
    echo '<li>Endereço: ' . e($resumo['endereco']) . '</li>';
    echo '<li>Produto: ' . e($resumo['produto_nome']) . '</li>';
    echo '<li>Quantidade: ' . (int) $resumo['quantidade'] . '</li>';
    echo '<li>Preço unitário: R$ ' . number_format($resumo['preco_unitario'], 2, ',', '.') . '</li>';
    echo '<li>Total: <strong>R$ ' . number_format($resumo['total'], 2, ',', '.') . '</strong></li>';
    if ($resumo['observacoes'] !== '') {
        echo '<li>Observações: ' . e($resumo['observacoes']) . '</li>';
    }
    echo '</ul>';
    echo '<p><a href="pedido.html">Fazer outro pedido</a> · <a href="index.html">Voltar ao cardápio</a></p>';
    echo '</section>';
    html_fim();
}
