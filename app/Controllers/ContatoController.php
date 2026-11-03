<?php
require_once __DIR__ . '/../Models/Contato.php';

require_once __DIR__ . '/../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class ContatoController {
    private $model;

    public function __construct() {
        $this->model = new Contato();
    }

    public function index($status = null, $msg = null) {
        require_once __DIR__ . '/../Views/formulario.php';
    }

    public function listar() {
        $contatos = $this->model->listarTodos();
        require_once __DIR__ . '/../Views/listagem.php';
    }

    public function enviar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome     = trim($_POST['nome'] ?? '');
            $email    = trim($_POST['email'] ?? '');
            $telefone = trim($_POST['telefone'] ?? '');
            $mensagem = trim($_POST['mensagem'] ?? '');

            if (empty($nome) || empty($email) || empty($telefone) || empty($mensagem)) {
                $this->index('danger', 'Por favor, preencha todos os campos obrigatórios.');
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->index('danger', 'Por favor, informe um endereço de e-mail válido.');
                return;
            }

            $apenasNumeros = preg_replace('/\D/', '', $telefone);
            if (strlen($apenasNumeros) < 10 || strlen($apenasNumeros) > 11) {
                $this->index('danger', 'Por favor, informe um número de telefone válido com DDD (10 ou 11 dígitos).');
                return;
            }

            $salvou = $this->model->salvar($nome, $email, $telefone, $mensagem);

            $enviouEmail = $this->dispararEmail($nome, $email, $telefone, $mensagem);

            if ($salvou && $enviouEmail) {
                $this->index('success', 'Contato salvo no banco e e-mail enviado com sucesso!');
            } elseif ($salvou) {
                $this->index('warning', 'Contato salvo no banco, mas ocorreu um erro ao enviar o e-mail.');
            } else {
                $this->index('danger', 'Erro ao salvar os dados no banco.');
            }
        }
    }

    private function dispararEmail($nome, $email, $telefone, $mensagem) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = 'smtp.teste.com.br';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'teste@teste.com.br';
            $mail->Password   = 'teste#36';
            $mail->Port       = 587;
            $mail->CharSet    = 'UTF-8';

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            $mail->setFrom('teste@teste.com.br', 'Teste  Web');
            $mail->addAddress('teste@teste.com.br', ' teste');
            $mail->addReplyTo($email, $nome);

            $mail->isHTML(true);
            $mail->Subject = "Novo Contato de: {$nome}";
            $mail->Body    = "
                <h3>Novo contato recebido pelo site</h3>
                <p><strong>Nome:</strong> {$nome}</p>
                <p><strong>E-mail:</strong> {$email}</p>
                <p><strong>Telefone:</strong> {$telefone}</p>
                <p><strong>Mensagem:</strong><br>" . nl2br(htmlspecialchars($mensagem)) . "</p>
            ";

            $mail->send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }
}