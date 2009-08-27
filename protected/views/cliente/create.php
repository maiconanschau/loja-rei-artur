<h2>Cadastro</h2>

<?php echo $this->renderPartial('_form', array(
'model'=>$model,
'modelFisico'=>$modelFisico,
'modelJuridico'=>$modelJuridico,
'modelEndereco'=>$modelEndereco,
'update'=>false,
)); ?>