<?php
class MensagemController extends CController {
    const PAGE_SIZE=10;

    public $defaultAction='admin';

    private $_model;

    public function init() {
        $this->pageTitle = Yii::app()->name." - Mensagem";
    }

    public function actionShow() {
        $this->render('show',array('model'=>$this->loadMensagem()));
    }

    public function actionCreate() {
        CTXClientScript::registerScriptFile('jquery');
        CTXClientScript::registerScriptFile('jquery.decimal');
        CTXClientScript::registerScriptFile('jquery.wysiwyg');
        CTXClientScript::registerCssFile('jquery.wysiwyg');

        $form = new MensagemForm();
        $model = new Mensagem();

        $categorias = CHtml::listData(CategoriaProduto::model()->findAll(array('order'=>'nomeCategoria')), 'idCategoria', 'nomeCategoria');
        $produtos = CHtml::listData(Produto::model()->findAll(array('order'=>'nomeProduto')), 'idProduto', 'nomeProduto');

        if (isset($_POST['MensagemForm'])) {
            $form->setAttributes($_POST['MensagemForm']);
            if ($form->validate()) {
                $formValid = true;
                $model->assuntoMensagem = $form->assunto;
                $model->conteudoMensagem = $form->conteudo;

                $cupom = null;
                if ($form->desconto) {
                    $valorCupom = $form->valor;
                    $tipoCupom = null;
                    if (preg_match('/%$/',$valorCupom)) {
                        $valorCupom = preg_replace("/[^0-9]/", '', $valorCupom);
                        $valorCupom = intval($valorCupom);
                        $tipoCupom = Cupom::TIPO_PORCENTAGEM;
                    } else {
                        $valorCupom = intval($valorCupom);
                        $tipoCupom = Cupom::TIPO_VALOR;
                    }

                    if (!empty($valorCupom)) {
                        $cupom = new Cupom();
                        $cupom->valorCupom = $valorCupom;
                        $cupom->tipoCupom = $tipoCupom;
                    }
                }

                $clientes = array();
                Yii::import("application.extensions.*");
                require_once('Zend/Db/Select.php');
                require_once('Zend/Db/Adapter/Pdo/Mysql.php');
                require_once('Zend/Db/Profiler.php');
                $zendOptions = array();
                $zendOptions['string'] = Yii::app()->db->connectionString;
                $zendOptions['username'] = Yii::app()->db->username;
                $zendOptions['password'] = Yii::app()->db->password;
                $zendOptions['string'] = explode(';',str_replace(array(':','='), ';', $zendOptions['string']));
                $zendOptions['dbname'] = $zendOptions['string'][4];

                $joins = array();

                $select = new Zend_Db_Select(new Zend_Db_Adapter_Pdo_Mysql($zendOptions));
                $select->from(array('c'=>'Cliente'));

                if (!empty($form->idadeMin) || !empty($form->idadeMax)) {
                    $select->joinInner(array('cf'=>'ClienteFisico'), 'c.idCliente = cf.idCliente', '');
                    $joins['cf'] = true;
                    $anoMin = (date('Y')-$form->idadeMax);
                    $anoMax = (date('Y')-$form->idadeMin);
                    if (!empty($form->idadeMin)) {
                        $select->where("YEAR(cf.nascimentoCliente) >= '$anoMin'");
                    }
                    if (!empty($form->idadeMax)) {
                        $select->where("YEAR(cf.nascimentoCliente) <= '$anoMax'");
                    }
                }

                if (!empty($form->sexo)) {
                    if (!isset($joins['cf'])) {
                        $select->joinInner(array('cf'=>'ClienteFisico'), 'c.idCliente = cf.idCliente', '');
                        $joins['cf'] = true;
                    }
                    $select->where('cf.sexoCliente = ?',strtoupper($form->sexo));
                }

                if (!empty($form->rendaMin) || !empty($form->rendaMax)) {
                    $valorSalario = 465;
                    $salarioMin = $form->rendaMin;
                    $salarioMax = $form->rendaMax;
                    $opcoesMin = $opcoesMax = array();

                    $opcao1Min = min($salarioMin,$valorSalario * 2);
                    $opcao1Max = $valorSalario * 2;

                    $opcao2Min = $valorSalario * 3;
                    $opcao2Max = $valorSalario * 4;

                    $opcao3Min = $valorSalario * 5;
                    $opcao3Max = max(array($salarioMax,$valorSalario * 5));

                    if (!empty($salarioMax)) {
                        if ($salarioMax >= $opcao1Max) $opcoesMax[] = 50;
                        if ($salarioMax >= $opcao2Max) $opcoesMax[] = 51;
                        if ($salarioMax >= $opcao3Max) $opcoesMax[] = 52;
                    }
                    if (!empty($salarioMin)) {
                        if ($salarioMin <= $opcao1Min) $opcoesMin[] = 50;
                        if ($salarioMin <= $opcao2Min) $opcoesMin[] = 51;
                        if ($salarioMin <= $opcao3Min) $opcoesMin[] = 52;
                    }
                    $opcoes = array_intersect($opcoesMin, $opcoesMax);

                    $selectRenda = new Zend_Db_Select(new Zend_Db_Adapter_Pdo_Mysql($zendOptions));
                    $selectRenda->from(array('qc'=>'QuestionarioCliente'),array('idCliente'));
                    $selectRenda->where('qc.idPergunta = ?',19);
                    if (!empty($opcoes)) $selectRenda->where('qc.respostaPergunta IN (?)',$opcoes);
                    $select->where('c.idCliente IN ?',$selectRenda);
                }

                $clientes = Cliente::model()->findAllBySql($select);
                if (empty($clientes)) {
                    $form->addError('desconto', 'Nenhum cliente atende aos requisitos para desconto');
                    $formValid = false;
                }

                if ($formValid) {
                    if (!empty($cupom)) $cupom->restritoCupom = 1;
                    if (empty($cupom) || $cupom->save()) {
                        if (!empty($cupom)) $model->idCupom = $cupom->idCupom;
                        if ($model->save()) {
                            foreach ($clientes as $v) {
                                if (!empty($cupom)) {
                                    $temp = new ClienteCupom();
                                    $temp->idCliente = $v->idCliente;
                                    $temp->idCupom = $cupom->idCupom;
                                    $temp->save();
                                }

                                $temp = new ClienteMensagem();
                                $temp->idCliente = $v->idCliente;
                                $temp->idMensagem = $model->idMensagem;
                                $temp->statusClienteMensagem = ClienteMensagem::STATUS_AGUARDANDO;
                                $temp->save();
                            }
                            if (!empty($cupom)) {
                                foreach ($form->categorias as $v) {
                                    $temp = new CupomMeta();
                                    $temp->chaveCupomMeta = 'categoria';
                                    $temp->valorCupomMeta = $v;
                                    $temp->idCupom = $cupom->idCupom;
                                    $temp->save();
                                }

                                foreach ($form->produtos as $v) {
                                    $temp = new CupomMeta();
                                    $temp->chaveCupomMeta = 'produto';
                                    $temp->valorCupomMeta = $v;
                                    $temp->idCupom = $cupom->idCupom;
                                    $temp->save();
                                }

                                if (!empty($form->valorMin)) {
                                    $temp = new CupomMeta();
                                    $temp->chaveCupomMeta = 'valorMin';
                                    $temp->valorCupomMeta = $form->valorMin;
                                    $temp->idCupom = $cupom->idCupom;
                                    $temp->save();
                                }

                                if (!empty($form->valorMax)) {
                                    $temp = new CupomMeta();
                                    $temp->chaveCupomMeta = 'valorMax';
                                    $temp->valorCupomMeta = $form->valorMax;
                                    $temp->idCupom = $cupom->idCupom;
                                    $temp->save();
                                }
                            }
                            $this->refresh();
                        }
                    }
                }
            }
        }

        $this->render('create',array(
            'form'=>$form,
            'categorias'=>$categorias,
            'produtos'=>$produtos,
        ));
    }

    public function actionAdmin() {
        $criteria=new CDbCriteria;

        $pages=new CPagination(Mensagem::model()->count($criteria));
        $pages->pageSize=self::PAGE_SIZE;
        $pages->applyLimit($criteria);

        $sort=new CSort('Mensagem');
        $sort->applyOrder($criteria);

        $models=Mensagem::model()->findAll($criteria);

        $this->render('admin',array(
            'models'=>$models,
            'pages'=>$pages,
            'sort'=>$sort,
        ));
    }

    public function loadMensagem($id=null) {
        if($this->_model===null) {
            if($id!==null || isset($_GET['id']))
                $this->_model=Mensagem::model()->findbyPk($id!==null ? $id : $_GET['id']);
            if($this->_model===null)
                throw new CHttpException(404,'The requested page does not exist.');
        }
        return $this->_model;
    }
}
