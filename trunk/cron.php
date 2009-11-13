<?php
header("Content-Type: text/plain");

function __autoload($className) {
    $classFile = realpath(dirname(__FILE__)."/protected/extensions").DIRECTORY_SEPARATOR;
    $classFile .= str_replace('_', DIRECTORY_SEPARATOR, $className).'.php';
    if (file_exists($classFile)) {
        require_once $classFile;
    }
}

/**
 * Envia as mensagens das promoções
 */

// Carrega as configurações de conexão com o banco
$config = require_once('protected/config/main.php');
$dbOptions = $config['components']['db'];
$dbOptions['host'] = explode(';',str_replace(array(':','='),';',$dbOptions['connectionString']));
$dbOptions['dbname'] = $dbOptions['host'][4];
$dbOptions['host'] = $dbOptions['host'][2];

// Conecta com o Zend Framework
$db = new Zend_Db_Adapter_Pdo_Mysql($dbOptions);

// Inicia o select para pegar os cliente que devem receber e-mail
$select = new Zend_Db_Select($db);

$select
    ->from(array('cm'=>'ClienteMensagem'),'')
    ->joinInner(array('m'=>'Mensagem'), 'cm.idMensagem = m.idMensagem', '')
    ->joinInner(array('c'=>'Cliente'), 'cm.idCliente = c.idCliente', '')
    ->joinLeft(array('cu'=>'Cupom'), 'm.idCupom = cu.idCupom', '')
    ->where('cm.statusClienteMensagem = ?',0)
    ->where('m.statusMensagem = 0 OR m.statusMensagem = 1')
    ->order('m.idMensagem ASC')
    ->limit('100')
    // Colunas
    ->columns(array('m.idMensagem','c.idCliente','m.assuntoMensagem','m.conteudoMensagem','c.emailCliente','cu.chaveCupom'));

$emailsParaEnviar = $select->query()->fetchAll();
$mensagensParaVerificar = array();

if (!empty($emailsParaEnviar)) {
    $mail = new Zend_Mail();
    $transport = new Zend_Mail_Transport_Smtp('reiartur.ujobs.com.br', array('auth'=>'login','username'=>'no-reply@reiartur.ujobs.com.br','password'=>'daves654312'));

    $mail->setReplyTo('no-reply@reiartur.ujobs.com.br');
    $mail->setFrom('no-reply@reiartur.ujobs.com.br');

    foreach ($emailsParaEnviar as $emailDb) {
        $mail->clearRecipients();
        $mail->clearSubject();
        $mensagensParaVerificar[] = $emailDb['idMensagem'];
        
        $bodyHtml  = '';
        $bodyHtml .= $emailDb['conteudoMensagem'];
        if (!empty($emailDb['chaveCupom'])) {
            $bodyHtml .= "<br/><br/><div>Para ganhar os descontos da promoção utilize o código <strong>{$emailDb['chaveCupom']}</strong> na sua compra.</div>";
        }

        $bodyHtml = utf8_decode($bodyHtml);

        $mail->setSubject($emailDb['assuntoMensagem']);
        $mail->setBodyHtml($bodyHtml);
        $mail->addTo($emailDb['emailCliente']);
        @$mail->send($transport);
        $db->exec("UPDATE ClienteMensagem SET statusClienteMensagem = 1 WHERE idCliente = '{$emailDb['idCliente']}' AND idMensagem = '{$emailDb['idMensagem']}'");
    }
}

foreach ($mensagensParaVerificar as $v) {
    $rs = $db->query("SELECT COUNT(*) as quant FROM ClienteMensagem WHERE idMensagem = '$v' AND statusClienteMensagem = '0'")->fetch();
    if ($rs <= 0) {
        $db->exec("UPDATE Mensagem SET statusMensagem = 2 WHERE idMensagem = $v");
    } else {
        $db->exec("UPDATE Mensagem SET statusMensagem = 1 WHERE idMensagem = $v");
    }
}