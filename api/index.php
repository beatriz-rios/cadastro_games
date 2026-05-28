<?php
// Roteador Principal para Vercel
session_start();

// Obter o caminho da requisição
$request = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$request = preg_replace('#^/api#', '', $request);
$request = trim($request, '/');

// Query string
$queryString = $_SERVER['QUERY_STRING'] ?? '';
if ($queryString) {
    parse_str($queryString, $_GET);
}

// Ignorar estáticos
if (preg_match('#^(css|img|js)/#', $request)) {
    http_response_code(404);
    exit();
}

// Limpar extensão
$request = str_replace('.php', '', $request);
if (empty($request)) {
    $request = 'index';
}

// Mapear páginas
$pageMap = [
    '' => 'login',
    'index' => 'login',
    'menu' => 'menu',
    'jogos' => 'jogos',
    'acao' => 'acao',
    'gestao' => 'gestao',
    'editar' => 'editar',
    'excluir' => 'excluir',
    'test' => 'test'
];

$page = $pageMap[$request] ?? null;

if ($page && $page !== 'test') {
    $filePath = __DIR__ . '/pages/' . $page . '.php';
} elseif ($page === 'test') {
    $filePath = __DIR__ . '/test.php';
} else {
    http_response_code(404);
    echo "404 - " . htmlspecialchars($request);
    exit();
}

if (file_exists($filePath)) {
    include $filePath;
} else {
    http_response_code(404);
    echo "404 Arquivo não existe";
    exit();
}
