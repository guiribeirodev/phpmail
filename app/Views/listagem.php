<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem de Contatos - Teste Web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        .form-control:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.25rem rgba(220, 53, 69, 0.2);
        }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg bg-white border-bottom border-danger border-2 shadow-sm mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold text-danger d-flex align-items-center" href="index.php">
            <i class="bi bi-envelope-paper-fill me-2 fs-4"></i>
            <span>Teste<span class="text-dark">Web</span></span>
        </a>
        <div class="navbar-nav ms-auto d-flex flex-row gap-2">
            <a class="btn btn-outline-danger rounded-pill px-3 py-1 fw-semibold" href="index.php?acao=index">
                <i class="bi bi-plus-circle me-1"></i> Novo Contato
            </a>
            <a class="btn btn-danger text-white rounded-pill px-3 py-1 fw-semibold" href="index.php?acao=listar">
                <i class="bi bi-list-ul me-1"></i> Listar Contatos
            </a>
        </div>
    </div>
</nav>

<div class="container pb-5">
    <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
        
        <div class="card-header bg-danger text-white py-3 px-4 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
            <div>
                <h5 class="mb-0 fw-bold d-flex align-items-center">
                    <i class="bi bi-people-fill me-2"></i> Contatos Cadastrados
                </h5>
                <small class="text-white-50">Lista completa de mensagens e contatos recebidos</small>
            </div>
            
            <div class="input-group input-group-sm" style="max-width: 300px;">
                <span class="input-group-text bg-white border-0 text-danger rounded-start-pill ps-3">
                    <i class="bi bi-search"></i>
                </span>
                <input type="text" id="filtroBusca" class="form-control border-0 rounded-end-pill pe-3 py-2" placeholder="Filtrar por nome, e-mail...">
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="tabelaContatos">
                    <thead class="table-light border-bottom border-danger border-2">
                        <tr>
                            <th class="ps-4 text-secondary text-uppercase fs-7 fw-bold py-3" style="width: 80px;">ID</th>
                            <th class="text-secondary text-uppercase fs-7 fw-bold py-3">Nome</th>
                            <th class="text-secondary text-uppercase fs-7 fw-bold py-3">E-mail</th>
                            <th class="text-secondary text-uppercase fs-7 fw-bold py-3">Telefone</th>
                            <th class="pe-4 text-secondary text-uppercase fs-7 fw-bold py-3">Mensagem</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($contatos)): ?>
                            <?php foreach ($contatos as $c): ?>
                                <tr>
                                    <td class="ps-4">
                                        <span class="badge bg-danger bg-opacity-10 text-danger border border-danger border-opacity-25 px-2 py-1 rounded-2">
                                            #<?= htmlspecialchars($c['id']) ?>
                                        </span>
                                    </td>
                                    <td class="fw-semibold text-dark">
                                        <i class="bi bi-person-circle text-danger me-1"></i>
                                        <?= htmlspecialchars($c['nome']) ?>
                                    </td>
                                    <td>
                                        <a href="mailto:<?= htmlspecialchars($c['email']) ?>" class="text-decoration-none text-dark">
                                            <i class="bi bi-envelope text-muted me-1"></i>
                                            <?= htmlspecialchars($c['email']) ?>
                                        </a>
                                    </td>
                                    <td class="text-nowrap text-secondary">
                                        <i class="bi bi-telephone text-muted me-1"></i>
                                        <?= htmlspecialchars($c['telefone']) ?>
                                    </td>
                                    <td class="pe-4 text-secondary">
                                        <?= nl2br(htmlspecialchars($c['mensagem'])) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr id="semContatos">
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="bi bi-inbox fs-1 text-danger d-block mb-2"></i>
                                    <span class="fw-semibold">Nenhum contato cadastrado no momento.</span>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="card-footer bg-white border-top py-3 px-4 d-flex justify-content-between align-items-center">
            <span class="text-muted small">
                Total de registros: <strong class="text-danger"><?= !empty($contatos) ? count($contatos) : 0 ?></strong>
            </span>
            <a href="index.php?acao=index" class="btn btn-sm btn-danger rounded-pill px-3 fw-semibold">
                <i class="bi bi-plus-lg me-1"></i> Adicionar Novo
            </a>
        </div>

    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
$(document).ready(function() {
    $("#filtroBusca").on("keyup", function() {
        var valor = $(this).val().toLowerCase();
        $("#tabelaContatos tbody tr:not(#semContatos)").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(valor) > -1);
        });
    });
});
</script>
</body>
</html>