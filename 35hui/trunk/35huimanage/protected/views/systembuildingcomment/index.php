<?php
$this->breadcrumbs=array(
	'Systembuildingcomments',
);

$this->menu=array(
	array('label'=>'评论管理', 'url'=>array('admin')),
);
?>

<h1>Systembuildingcomments</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
