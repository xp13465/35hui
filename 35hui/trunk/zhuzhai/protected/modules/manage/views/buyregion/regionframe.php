<div class="tcmain">
    <div class="tccontent">
        <h5><a href="javascript:void(0)" onclick="parent.window.closeTip(true)"><img src="/images/3.gif" /></a><font size="1">选择房源</font></h5>
        <form action="" method="post">
            <div class="tcmtit">
                <?php
                if($type=="office"){
                    ?>
                <span class="tcm_01">楼盘名称：</span>
                <span class="tcm_01">
                    <input type="text" name="name" class="txt_04" value="<?=isset($show['name'])?$show['name']:""?>"/>
                </span>
                    <?php
                }
                ?>

                <span class="tcm_01">标题：</span>
                <span class="tcm_01">
                    <input type="text" name="title" class="txt_04" value="<?=isset($show['title'])?$show['title']:""?>"/>
                </span>
                <span class="tcm_01"><input type="submit" value="搜索" /></span>
            </div>
        </form>
        <div class="tcmcont">
            <table cellspacing="0" cellpadding="0" border="0" class="table_02">
                <?php
                foreach($dataProvider->getData() as $data){
                    $this->renderPartial('_regionframe', array('data'=>$data,"type"=>$type));
                }
                ?>
            </table>
        </div>

        <div class="fenye">
            <?php
            $this->widget('CLinkPager',array(
                    'pages'=>$dataProvider->pagination,
                    "htmlOptions"=>array("style"=>"float:right"),
            ));
            ?>
        </div>

    </div>
</div>

<script type="text/javascript">
function recommend(sourceId){
    if(confirm("确定要设置吗？")){
        $.ajax({
            type: "GET",
            url: "<?php echo Yii::app()->createUrl('/manage/buyregion/updatesource') ?>",
            data: {"id":<?=$id?>,"sourceid":sourceId},
            success: function(msg){
                if(msg==0){
                    alert("已经超过总共可以推荐数，推荐失败！")
                }else{
                    window.parent.window.closeTip(true);
                }
               
            }
        });
    }
}
</script>