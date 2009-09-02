<?php
class SiteController extends CController {
    public $defaultAction = 'home';

    public function init() {
        $this->pageTitle = Yii::app()->name;
    }

    public function actionHome() {
        $produtos = Produto::model()->findAll(array('order'=>'cliquesProduto DESC','limit'=>6));

        $tabelaProdutos = new CTXTable();
        $tabelaProdutos->attr('width','100%');
        $row = $tabelaProdutos->addRow();

        foreach ($produtos as $k=>$v) {
            $fotos = $v->fotosVisiveis;
            $foto = array_shift($fotos);
            $produto = $this->renderPartial('produtoHome', array('produto'=>$v,'foto'=>$foto), true);
            $row->addCol($produto);
            if ($k == 2) {
                $row = $tabelaProdutos->addRow();
            }
        }

        $this->render('home',array('tabelaProdutos'=>$tabelaProdutos));
    }

    public function actionContato() {
        $model = new ContatoForm();

        if (Yii::app()->request->isPostRequest) {
            $model->attributes = $_POST['ContatoForm'];
            if ($model->validate()) {
                $this->redirect(array('/site/contatoEnviado'));
            }
        }

        $this->render('contato',array('model'=>$model));
    }

    public function actionContatoEnviado() {
        $this->render("contatoEnviado");
    }
}