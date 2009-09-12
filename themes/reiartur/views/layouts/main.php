<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title><?php echo $this->pageTitle; ?></title>
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/form.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/loja.css" />
        <style type="text/css">
            /* place css fixes for all versions of IE in this conditional comment */
            .twoColHybLtHdr #sidebar1 { padding-top: 30px; }
            .twoColHybLtHdr #mainContent { zoom: 1; padding-top: 15px; }
            /* the above proprietary zoom property gives IE the hasLayout it may need to avoid several bugs */
        </style>
        <![endif]-->
        <style type="text/css">
            <!--
            #apDiv1 {
                position:absolute;
                left:335px;
                top:18px;
                width:462px;
                height:116px;
                z-index:1;
            }
            a:link {
                color: #000;
                text-decoration: none;
            }
            a:visited {
                text-decoration: none;
                color: #000;
            }
            a:hover {
                text-decoration: none;
                color: #000;
            }
            a:active {
                text-decoration: none;
                color: #000;
            }
            body,td,th {
                font-size: 12pt;
            }
            -->
        </style>
    </head>

    <body text="#000000" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" class="twoColHybLtHdr">
        <div id="container">
            <div id="header">
                <!-- end #header -->
            </div>
            <div id="sidebar1">
                <table width="200" border="0" cellspacing="2" cellpadding="2">
                    <tr>
                        <td colspan="2" bgcolor="#CC9933">
                            <a href="<?php echo CHtml::normalizeUrl(Yii::app()->user->id == 'admin' ? array('/admin') : array('/site')); ?>"><strong>Home</strong></a><br/>
                        </td>
                    </tr>
                    <?php if (Yii::app()->user->id != 'admin') : ?>
                    <?php $this->widget('application.components.widgets.BuscaMenu'); ?>
                    <tr>
                        <td colspan="2" bgcolor="#CC9933"><strong>Categorias</strong></td>
                    </tr>
                    <tr>
                        <td colspan="2" bgcolor="#FFFFFF">
                                <?php $this->widget('application.components.widgets.MenuCategorias'); ?>
                        </td>
                    </tr>
                    <?php endif; ?>
                    <?php $this->widget('application.components.widgets.ClienteLogin'); ?>
                    <tr>
                        <td colspan="2" bgcolor="#FFFFFF"><a href="#"></a></td>
                    </tr>
                    <?php $this->widget('application.components.widgets.SugestaoProduto'); ?>
                    <?php if (Yii::app()->user->id != 'admin') : ?>
                    <tr>
                        <td colspan="2" bgcolor="#CC9933">
                                <?php if (Yii::app()->user->isGuest) : ?>
                            <a href="<?php echo CHtml::normalizeUrl(array("/cliente/cadastro")); ?>"><strong>Cadastrar</strong></a><br/>
                                <?php endif; ?>
                            <a href="<?php echo CHtml::normalizeUrl(array("/site/contato")); ?>"><strong>Contato</strong></a><br/>
                            <a href="<?php echo CHtml::normalizeUrl(array("/admin")); ?>"><strong>Área Administrativa</strong></a>
                        </td>
                    </tr>
                    <?php endif; ?>
                </table>
                <br />

            </div>
            <div id="mainContent">
                <?php echo $content; ?><br/>
            </div>
            <div id="footer">
                <p><?php echo Yii::app()->name; ?> Moda Masculina - Ternos e Acessórios<br />
                    Av. Rio Branco, 1897 loja 42<br />
                    Centro - Juiz de Fora - MG<br />
                    Tel (32)3232-9865 e (32)3265-9874</p>
                <!-- end #footer -->
            </div>
            <!-- end #container -->
        </div>
    </body>
</html>