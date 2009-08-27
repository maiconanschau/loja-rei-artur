<html>
    <head>
        <title>Contato Site <?php Yii::app()->name; ?></title>
    </head>
    <body>
        <table>
            <tr>
                <th>Nome</th>
                <td><?php echo $nome; ?></td>
            </tr>
            <tr>
                <th>E-mail</th>
                <td><?php echo $email; ?></td>
            </tr>
            <tr>
                <th>Assunto</th>
                <td><?php echo $assunto; ?></td>
            </tr>
            <tr>
                <th>Mensagem</th>
                <td><?php echo $mensagem; ?></td>
            </tr>
        </table>
    </body>
</html>