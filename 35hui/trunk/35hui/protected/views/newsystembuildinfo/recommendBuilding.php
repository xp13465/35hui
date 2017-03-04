<?php
$this->breadcrumbs=array(
	'楼盘首页'=>array('index'),
    '推荐楼盘信息'
);
?>
<div style="width:750px;">
    <h5>推荐楼盘信息</h5>
	<div style="width: 750px; margin-left: 0pt; float: left;">
		<div id="content">
            <ul>
                <?php
                $this->widget('zii.widgets.CListView', array(
                    'dataProvider'=>$recommendBuildings,
                    'itemView'=>'_recommendView',
                    'summaryText'=>'最近共有<strong>{count}</strong>套推荐的楼盘',
                    'summaryCssClass'=>'',
                    'emptyText'=>'最近没有推荐的楼盘',
                ));
                ?>
            </ul>
		</div>
	</div>
</div>