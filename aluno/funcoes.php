<?php
/**
 * ============================================================
 * O QUE A GENTE VAI CRIAR AQUI?
 * As FUNÇÕES do PHP: ler o que a pessoa digitou, checar se
 * falta alguma coisa e calcular o valor do pedido.
 *
 * Neste arquivo NÃO tem HTML. Quem chama ele é o processar.php.
 *
 * Já está pronto (não precisa mudar):
 * - lista_produtos()  → nomes e preços
 * - ler_pedido()      → pega os dados do formulário ($_POST)
 * - montar_resumo()   → junta as infos para mostrar no final
 *
 * O seu trabalho: validar_pedido() e calcular_total().
 * ============================================================
 */

function lista_produtos()
{
    // O texto da esquerda tem que ser igual ao value do <select> no HTML.
    // nome e preco são o que aparece no resumo.
    return [
        'pizza-margherita' => ['nome' => 'Pizza Margherita', 'preco' => 39.90],
        'hamburguer-classico' => ['nome' => 'Hambúrguer Clássico', 'preco' => 32.50],
        'combo-sushi' => ['nome' => 'Combo Sushi', 'preco' => 48.00],
        'acai-bowl' => ['nome' => 'Açaí Bowl', 'preco' => 24.90],
        'brownie-sorvete' => ['nome' => 'Brownie com Sorvete', 'preco' => 18.00],
    ];
}

function ler_pedido()
{
    // isset() = "esse campo veio no formulário?"
    // trim()  = tira espaços a mais no começo e no fim
    return [
        'nome' => isset($_POST['nome']) ? trim($_POST['nome']) : '',
        'telefone' => isset($_POST['telefone']) ? trim($_POST['telefone']) : '',
        'endereco' => isset($_POST['endereco']) ? trim($_POST['endereco']) : '',
        'produto' => isset($_POST['produto']) ? trim($_POST['produto']) : '',
        'quantidade' => isset($_POST['quantidade']) ? $_POST['quantidade'] : '',
        'observacoes' => isset($_POST['observacoes']) ? trim($_POST['observacoes']) : '',
    ];
}

function validar_pedido($dados)
{
    // $erros começa vazio. Cada problema vira uma frase nesta lista.
    // Se a lista tiver item, o PHP mostra os erros. Se estiver vazia, confirma o pedido.
    $erros = [];
    $produtos = lista_produtos();

    // =========================================================
    // PASSO 1 — EXEMPLO PRONTO: conferir o NOME
    //
    // O que a gente fez: perguntar "o nome ficou vazio?"
    // empty(...) é verdadeiro se a pessoa não escreveu nada.
    // $erros[] = '...' coloca uma mensagem na lista.
    //
    // Os outros campos obrigatórios seguem esse mesmo jeito.
    // =========================================================
    if (empty($dados['nome'])) {
        $erros[] = 'Digite o seu nome.';
    }

    // =========================================================
    // PASSO 2 — AGORA É COM VOCÊ: conferir o TELEFONE
    //
    // O que você vai criar: a mesma checagem, agora para o telefone.
    //
    // Modelo:
    // if (empty($dados['telefone'])) {
    //     $erros[] = 'Digite o telefone.';
    // }
    // =========================================================
    // TODO: se o telefone estiver vazio, coloque uma frase em $erros

    // =========================================================
    // PASSO 3 — DESAFIO: conferir o resto
    //
    // O que você vai criar: regras para endereço, produto e quantidade.
    // Use if / else, igual no nome.
    //
    // - endereço vazio → erro
    // - produto vazio → erro
    // - produto preenchido, mas NÃO existe em $produtos → erro
    //   dica: !isset($produtos[$dados['produto']])
    // - quantidade tem que ser um número inteiro, no mínimo 1
    //   $qtd = filter_var($dados['quantidade'], FILTER_VALIDATE_INT);
    //   se $qtd === false ou $qtd < 1 → erro
    //
    // observacoes pode ficar vazia. Não precisa de erro.
    // =========================================================

    return $erros;
}

function calcular_total($produto, $quantidade)
{
    $produtos = lista_produtos();

    // =========================================================
    // DESAFIO (conta): o que você vai criar
    // Valor a pagar = preço do produto × quantidade.
    //
    // if (isset($produtos[$produto])) {
    //     $preco = $produtos[$produto]['preco'];
    //     return $preco * $quantidade;
    // }
    // return 0;
    //
    // Se você deixar return 0, o resumo mostra R$ 0,00.
    // =========================================================
    return 0;
}

function montar_resumo($dados)
{
    // Junta o que a tela de sucesso precisa. Já está pronto.
    $produtos = lista_produtos();
    $codigo = $dados['produto'];
    $quantidade = (int) $dados['quantidade'];
    $preco = isset($produtos[$codigo]) ? $produtos[$codigo]['preco'] : 0;

    return [
        'nome' => $dados['nome'],
        'telefone' => $dados['telefone'],
        'endereco' => $dados['endereco'],
        'produto_nome' => isset($produtos[$codigo]) ? $produtos[$codigo]['nome'] : $codigo,
        'quantidade' => $quantidade,
        'preco_unitario' => $preco,
        'total' => calcular_total($codigo, $quantidade),
        'observacoes' => $dados['observacoes'],
    ];
}
