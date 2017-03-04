<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/default.css" rel="stylesheet" type="text/css" />
<link href="/css/umanage.css" rel="stylesheet" type="text/css" />
<style type="text/css">
body{font-size: 12px}
</style>
</head>
<?php
Yii::app()->clientScript->registerCoreScript('jquery');
?>
<body>
    <div id="bd">
        <?php echo $content; ?>
    </div>
</body>
</html>