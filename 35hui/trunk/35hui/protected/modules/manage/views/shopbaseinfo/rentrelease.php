<?php
$this->breadcrumbs=array(
    '出售出租',
	'发布房源',
);
$arr=Oprationconfig::model()->getConfigByName('release');
$base_num=$arr['0'];
$tui_num=$arr['1'];
$ji_num=$arr['2'];
$userRole = User::model()->getCurrentRole();
?>
<div class="liucheng">
    <div class="lcleft"><img src="/images/mc/liucheng.png" /></div>
    <div class="lcright">
        <p><strong>全景拍摄指导</strong></p>
        <p><a href="/help/qjdevice" target="_blank">取景设备</a>|<a href="/help/qjtakephoto" target="_blank">拍摄技巧</a></p>
    </div>
</div>
<?php
if(User::model()->validateRelease(Yii::app()->user->id,1,2)!="success"){
?>
<div class="msg">
    <span>注意：您已经达到了发布上限，不能继续发布！</span>
    <?php if($userRole!=1){?><span>您可以完成所有<font color="red">认证</font>或使用<a href="/manage/buycombo/index" style="color:blue">功能升级</a>来<font color="red">提高发布上限</font>！</span><?php }?>
</div>
<?php } ?>
<div class="htguanle">
    <ul>
        <li><a href="<?php echo $this->createUrl('/manage/officebaseinfo/rentrelease'); ?>">发布写字楼出租信息</a></li>
        
        <li><a href="<?php echo $this->createUrl('/manage/creativesource/rentrelease'); ?>">发布创意园区出租信息</a></li>
        <li class="clk"><a href="javascript:;">发布商铺出租信息</a></li>
    </ul>
    <div class="moren"><?php echo CHtml::link('修改主营物业',array("/manage/user/index")); ?></div>
</div>
<?php 
            $this->renderPartial('_formdiscribe', array(
                'shopBaseInfoModel'=>$shopBaseInfoModel,
                'shopFacilityInfoModel'=>$shopFacilityInfoModel,//配套设施
                'shopPresentInfoModel'=>$shopPresentInfoModel,//展示信息
               
                'shopRentInfoModel'=>$shopRentInfoModel,//出租信息
                "type"=>"rent",
                'opt'=>"create",
                'base_num'=>$base_num,
            ));
?>

<div class="msg">
    <em class="red">注意事项</em><br />
    1、上传图片宽度最小为200px*200px。<br />
    2、请勿上传有水印、盖章等任何侵犯他人版权或含有广告信息的图片。<br />
    3、每一类图片最多可上传10张，系统图库最多可选择5张。<br />
    4、批量上传可通过ctrl或shift键复选、框选图片。
</div>
<script type="text/javascript">
//验证用户是否还能发布或录入
function validateOptNum(obj){
    var name = $(obj).attr("name");
    var vali = 0;
    if(name!='sketch'){
        //计算要花费的新币。发布4分，加急10分，加推荐6分。
        if(!confirm("确定要发布吗？")){
            return false;
        }
    }
    $.ajax({
        url: "<?php echo Yii::app()->createUrl("/manage/shopbaseinfo/validatenum") ?>",
        type: "GET",
        data: {"name":name},
        async: false,
        success: function(msg){
            if(msg=="success"){//验证通过。
                vali = 1;
            }else if(msg==0){
                if(name=="sketch"){
                    alert("抱歉，已达到允许录入的商铺房源数的最大值。<?php if($userRole != 1)echo '继续发布，请购买套餐服务!';?>");
                }else{
                    alert("抱歉，已达到允许发布的商铺房源数的最大值，您可以选择保存为草稿<?php if($userRole != 1)echo '，或购买套餐服务';?>。");
                }
            }
        }
    });
    if(vali==0){
        return false;
    }
}
//点击提交时触发此函数
function validateForm(){
    
    var _window = window;
    var _win_ichnograph = _window.frames['ichnograph'];
    var _win_outdoor = _window.frames['outdoor'];
    var _win_indoor = _window.frames['indoor'];
    var reg = /[,|]/g;
    //得到frame中的图片。放入隐藏域中
    $("#ichnograph_hidden").val(_win_ichnograph.getPicStr());
    $("#outdoor_hidden").val(_win_outdoor.getPicStr());
    $("#indoor_hidden").val(_win_indoor.getPicStr());
    var imgTitles = "";
    var a = $("#ichnograph_hidden").val().split('|');
    var ac = a.length;
    while(ac--){
        if(a[ac])
            imgTitles += '|'+a[ac]+','+_win_ichnograph.document.getElementById(a[ac]).value.replace(reg, '');
    }
    $("#ichnograph_hidden").val(imgTitles);
    imgTitles = "";
    var b = $("#outdoor_hidden").val().split('|');
    var bc = b.length;
    while(bc--){
        if(b[bc])
            imgTitles += '|'+b[bc]+','+_win_outdoor.document.getElementById(b[bc]).value.replace(reg, '');
    }
    $("#outdoor_hidden").val(imgTitles);
    imgTitles = "";
    var c = $("#indoor_hidden").val().split('|');
    var cc = c.length;
    while(cc--){
        if(c[cc])
            imgTitles += '|'+c[cc]+','+_win_indoor.document.getElementById(c[cc]).value.replace(reg, '');
    }
    $("#indoor_hidden").val(imgTitles);
   
    imgTitles = "";
    var bpArr = basePicData;
    var c = bpArr.length;
    while(c--){
        imgTitles += '|'+$("#title"+bpArr[c]).attr("basepic")+','+$("#title"+bpArr[c]).val().replace(reg, '');
    }
    $("#base_images").val(imgTitles);
    
   
    if(!submitValidate()){
        return false;
    }
}
</script>