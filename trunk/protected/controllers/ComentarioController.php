<?php

class ComentarioController extends CController
{
	const PAGE_SIZE=5;

	public $defaultAction='list';
	
	private $_model;
	
	public function filters()
	{
		return array(
			'accessControl', 
		);
	}

	
	public function accessRules()
	{
		return array(
			array('allow',  
				'actions'=>array('list','show'),
				'users'=>array('*'),
			),
			array('allow', 
				'actions'=>array('create','update'),
				'users'=>array('@'),
			),
			array('allow', 
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
			),
			array('deny',  
				'users'=>array('*'),
			),
		);
	}

	
	public function actionShow()
	{
		$this->render('show',array('model'=>$this->loadComentario()));
	}

	
	public function actionCreate()
	{
		$model=new Comentario;
		if(isset($_POST['Comentario']))
		{
			$model->attributes=$_POST['Comentario'];
			if($model->save())
				$this->redirect(array('show','id'=>$model->idComentario));
		}
		$this->render('create',array('model'=>$model));
	}

	
	public function actionUpdate()
	{
		$model=$this->loadComentario();
		if(isset($_POST['Comentario']))
		{
			$model->attributes=$_POST['Comentario'];
			if($model->save())
				$this->redirect(array('show','id'=>$model->idComentario));
		}
		$this->render('update',array('model'=>$model));
	}

	
	public function actionDelete()
	{
		if(Yii::app()->request->isPostRequest)
		{
	
			$this->loadComentario()->delete();
			$this->redirect(array('list'));
		}
		else
			throw new CHttpException(400,'Requisição inválida. Por favor, não repita essa solicitação novamente.');
	}

	
	public function actionList()
	{
		$criteria=new CDbCriteria;

		$pages=new CPagination(Comentario::model()->count($criteria));
		$pages->pageSize=self::PAGE_SIZE;
		$pages->applyLimit($criteria);

		$models=Comentario::model()->findAll($criteria);

		$this->render('list',array(
			'models'=>$models,
			'pages'=>$pages,
		));
	}

	
	public function actionAdmin()
	{
		$this->processAdminCommand();

		$criteria=new CDbCriteria;

		$pages=new CPagination(Comentario::model()->count($criteria));
		$pages->pageSize=self::PAGE_SIZE;
		$pages->applyLimit($criteria);

		$sort=new CSort('Comentario');
		$sort->applyOrder($criteria);

		$models=Comentario::model()->findAll($criteria);

		$this->render('admin',array(
			'models'=>$models,
			'pages'=>$pages,
			'sort'=>$sort,
		));
	}

	
	public function loadComentario($id=null)
	{
		if($this->_model===null)
		{
			if($id!==null || isset($_GET['id']))
				$this->_model=Comentario::model()->findbyPk($id!==null ? $id : $_GET['id']);
			if($this->_model===null)
				throw new CHttpException(404,'The requested page does not exist.');
		}
		return $this->_model;
	}

	
	protected function processAdminCommand()
	{
		if(isset($_POST['command'], $_POST['id']) && $_POST['command']==='delete')
		{
			$this->loadComentario($_POST['id'])->delete();
			$this->refresh();
		}
	}
}
