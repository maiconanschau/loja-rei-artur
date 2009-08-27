<?php
class ContatoForm extends CFormModel {
    public $assunto;
    public $nome;
    public $email;
    public $mensagem;

    public function rules() {
        return array(
        array('assunto, nome, email, mensagem', 'required'),
        array('email', 'email'),
        array('mensagem','send'),
        );
    }

    public function attributeLabels() {
        return array(
        'assunto'=>'Assunto',
        'nome'=>'Nome',
        'email'=>'E-mail',
        'mensagem'=>'Mensagem'
        );
    }

    public function send($model,$attribute) {
        Yii::import("application.extensions.phpmailer.*");

        $mensagem = "
<html>
    <head>
        <title>Contato Site ".Yii::app()->name."</title>
    </head>
    <body>
        <table>
            <tr>
                <th>Nome</th>
                <td>{$this->nome}</td>
            </tr>
            <tr>
                <th>E-mail</th>
                <td>{$this->email}</td>
            </tr>
            <tr>
                <th>Assunto</th>
                <td>{$this->assunto}</td>
            </tr>
            <tr>
                <th>Mensagem</th>
                <td>{$this->mensagem}</td>
            </tr>
        </table>
    </body>
</html>
            ";

        $mailer = new PHPMailer();
        $mailer->IsSMTP();
        $mailer->SMTPAuth = true;

        $mailer->Host = 'reiartur.ujobs.com.br';
        $mailer->Username = 'no-reply@reiartur.ujobs.com.br';
        $mailer->Password = 'daves654312';
        $mailer->SetFrom($this->email);
        $mailer->AddReplyTo($this->email);
        $mailer->Subject = $this->assunto;
        $mailer->MsgHTML($mensagem);

        $mailer->AddAddress(Yii::app()->params['adminEmail']);

        if (!$mailer->Send()) {
            $this->addError($attribute, "Não foi possível enviar sua mensagem.");
        }
    }
}
