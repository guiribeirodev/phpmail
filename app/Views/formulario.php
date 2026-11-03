<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato - Web</title>
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
            <a class="btn btn-danger text-white rounded-pill px-3 py-1 fw-semibold" href="index.php?acao=index">
                <i class="bi bi-plus-circle me-1"></i> Novo Contato
            </a>
            <a class="btn btn-outline-danger rounded-pill px-3 py-1 fw-semibold" href="index.php?acao=listar">
                <i class="bi bi-list-ul me-1"></i> Listar Contatos
            </a>
        </div>
    </div>
</nav>

<div class="container pb-5">
    <div class="row justify-content-center">
        <div class="col-md-7 col-lg-6">
            
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                <div class="card-header bg-danger text-white py-3 px-4">
                    <h5 class="mb-0 fw-bold d-flex align-items-center">
                        <i class="bi bi-pencil-square me-2"></i> Formulário de Contato
                    </h5>
                    <small class="text-white-50">Preencha os campos abaixo para nos enviar uma mensagem</small>
                </div>

                <div class="card-body p-4">
                    <?php if (!empty($status) && !empty($msg)): ?>
                        <div class="alert alert-<?= $status ?> alert-dismissible fade show d-flex align-items-center rounded-3 mb-4" role="alert">
                            <i class="bi <?= $status === 'success' ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill' ?> me-2 fs-5"></i>
                            <div><?= $msg ?></div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    <?php endif; ?>

                    <form id="formContato" action="index.php?acao=enviar" method="POST">
                        <?php 
                            $nomeVal     = ($status !== 'success') ? htmlspecialchars($_POST['nome'] ?? '') : '';
                            $emailVal    = ($status !== 'success') ? htmlspecialchars($_POST['email'] ?? '') : '';
                            $telefoneVal = ($status !== 'success') ? htmlspecialchars($_POST['telefone'] ?? '') : '';
                            $mensagemVal = ($status !== 'success') ? htmlspecialchars($_POST['mensagem'] ?? '') : '';
                        ?>
                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">
                                <i class="bi bi-person text-danger me-1"></i> Nome Completo
                            </label>
                            <input type="text" name="nome" value="<?= $nomeVal ?>" class="form-control form-control-lg rounded-3 fs-6" placeholder="Ex: Maria da Silva" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">
                                <i class="bi bi-envelope text-danger me-1"></i> E-mail
                            </label>
                            <input type="email" name="email" value="<?= $emailVal ?>" class="form-control form-control-lg rounded-3 fs-6" placeholder="nome@exemplo.com" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold text-secondary">
                                <i class="bi bi-telephone text-danger me-1"></i> Telefone
                            </label>
                            <input type="text" name="telefone" id="telefone" value="<?= $telefoneVal ?>" class="form-control form-control-lg rounded-3 fs-6" placeholder="(11) 99999-9999" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold text-secondary">
                                <i class="bi bi-chat-left-text text-danger me-1"></i> Mensagem
                            </label>
                            <textarea name="mensagem" class="form-control rounded-3 fs-6" rows="4" placeholder="Escreva sua mensagem aqui..." required><?= $mensagemVal ?></textarea>
                        </div>

                        <button type="submit" id="btnEnviar" class="btn btn-danger btn-lg w-100 fw-bold rounded-3 shadow-sm py-2">
                            <i class="bi bi-send-fill me-2"></i> Enviar Contato
                        </button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
<script>
$(document).ready(function() {
    var maskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    options = {
        onKeyPress: function(val, e, field, options) {
            field.mask(maskBehavior.apply({}, arguments), options);
        }
    };
    $('#telefone').mask(maskBehavior, options);

    $('#formContato').on('submit', function() {
        $('#btnEnviar').prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>Enviando...');
    });
});
</script>
</body>
</html>