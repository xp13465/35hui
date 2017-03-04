<style type="text/css">
.hidden{ display: none;}
.show{display: block;}
.errorMessage{ color: red;} 
.suggest_link{ background-color: #FFFFFF; padding: 2px 6px 2px 6px;}
.suggest_link_over{ cursor: pointer; background-color: #A8F2FE; padding: 2px 6px 2px 6px;}
#search_suggest{ position: absolute;left: 138px; top: 216px;	width: auto; background-color: #FFFFFF; text-align: left;    border: 1px solid #000000;    margin-left: 2px}
.required_title{ color:red;}
</style>
<script type="text/javascript" src="/js/kindeditor/kindeditor.js"></script>
<script type="text/javascript">
KE.show({
    id : 'sp_shopdesc',
    resizeMode : 1,
    allowPreviewEmoticons : false,
    allowUpload : false,
    resizeMode : 0,
    items : [
    'fontname', 'fontsize', '|', 'textcolor', 'bgcolor', 'bold', 'italic', 'underline',
    'removeformat', '|', 'justifyleft', 'justifycenter', 'justifyright', 'insertorderedlist',
    'insertunorderedlist', '|', 'emoticons', 'image', 'link']
});
</script>
<form action="" method="post" onSubmit="return validateForm()">
<div class="ihtit">1、填写楼房信息<span style="font-weight:normal; font-size:12px; padding-left:10px; color:#000033;"><em class="red">*</em> 号为必填</span></div>
<div class="rgcont">
    <table cellspacing="0" cellpadding="0" border="0" class="table_01">
        <tr>
            <td width="16%" class="tit"><em>*</em> 商铺类型：</td>
            <td width="84%" class="txtlou" id="td_sb_shoptype">
                <?=CHtml::radioButtonList("sb_shoptype",$shopBaseInfoModel->sb_shoptype?$shopBaseInfoModel->sb_shoptype:"1",Shopbaseinfo::$sb_shoptype,array("separator"=>"&nbsp"));?>
            </td>
        </tr>
        <tr>
            <td width="16%" class="tit"><em>*</em> 位置：</td>
            <td width="84%" class="txtlou">
                <?php
                echo CHtml::dropDownList("sb_district",$shopBaseInfoModel->sb_district,Region::model()->getFormatChildrenData(35),array("empty"=>"---请选择---"));
                $section = array();
                if($shopBaseInfoModel->sb_district!=0){
                    $section = Region::model()->getFormatChildrenData($shopBaseInfoModel->sb_district);
                }
                echo "&nbsp;&nbsp;".CHtml::dropDownList("sb_section",$shopBaseInfoModel->sb_section,$section,array("empty"=>"---请选择---"));
            ?>
            <span class="errorMessage"></span>
            </td>
        </tr>
		
        <tr>
            <td width="16%" class="tit"><em>*</em> 地址：</td>
            <td width="84%" class="txtlou"><?php
                 echo CHtml::textField("sb_shopaddress",$shopBaseInfoModel->sb_shopaddress,array("size"=>"55","onblur"=>"checkAddress(this)"));
                ?><span class="errorMessage"></span>
            </td>
        </tr>
        <tr>
        </tr>
        <tr>
            <td width="16%" class="tit"> 当前状态</td>
            <td>   <?php  echo CHtml::radioButtonList("sb_businesstype",
                        $shopBaseInfoModel->sb_businesstype?
                        $shopBaseInfoModel->sb_businesstype
                        :"1",
                        Shopbaseinfo::$sb_businesstype,array("separator"=>"&nbsp",'onclick'=>'checkType(this,1);'));?>
                 <?php
                 
                echo CHtml::dropDownList("sb_profession",$shopBaseInfoModel->sb_profession?$shopBaseInfoModel->sb_profession:"10",Searchcondition::model()->getAllProfession(1),array('style'=>'display:none'));

            ?>
            </td>
        </tr>
    <?php
    $type=="rent"?
            $this->renderPartial('_rentdiscribe',array('shopRentInfoModel'=>$shopRentInfoModel,'shopBaseInfoModel'=>$shopBaseInfoModel,'type'=>"show"))
            :
            $this->renderPartial('_selldiscribe',array('shopSellInfoModel'=>$shopSellInfoModel,'shopBaseInfoModel'=>$shopBaseInfoModel,"type"=>"show"));
    ?>
        <tr>
            <td width="16%" class="tit"> 楼层：</td>
            <td width="84%" class="txtlou">
                <?php 
                $floor=explode(',',$shopBaseInfoModel->sb_floor);
                if(!isset($floor[1]))$floor[1]='';
                if(!isset($floor[2]))$floor[2]='';
                ?>
                 <p><?php echo CHtml::radioButton("sb_floor[type]",$floor[0]==1?1:0,array('value'=>"1",'onclick'=>'checkType(this.value,3);')) ?>单层<span id="floorInput_1">&nbsp;第 <?php echo CHtml::textField("sb_floor[floor]",$floor[0]==1?$floor[1]:'',array("maxlength"=>"4","size"=>4,"onblur"=>"validateFloor(this)"));?>层<span class="errorMessage"></span></span></p>
                 <p><?php echo CHtml::radioButton("sb_floor[type]",$floor[0]==2?1:0,array('value'=>"2",'onclick'=>'checkType(this.value,3);')) ?>多层<span id="floorInput_2">&nbsp;第 <?php echo CHtml::textField("sb_floor[unfloor]",$floor[0]==2?$floor[1]:'',array("maxlength"=>"4","size"=>4,"onblur"=>"validateFloor(this)"));?>层&nbsp;至&nbsp;第 <?php echo CHtml::textField("sb_floor[upfloor]",$floor[0]==2?$floor[2]:'',array("maxlength"=>"4","size"=>4,"onblur"=>"validateFloor(this)"));?>层<span class="errorMessage"></span></span></p>
                 <p><?php echo CHtml::radioButton("sb_floor[type]",$floor[0]==3?1:0,array('value'=>"3",'onclick'=>'checkType(this.value,3);')) ?>独栋<span id="floorInput_3">&nbsp;共 <?php echo CHtml::textField("sb_floor[dufloor]",$floor[0]==3?$floor[1]:'',array("maxlength"=>"4","size"=>4,"onblur"=>"validateFloor(this)"));?>层<span class="errorMessage"></span></span></p>
                
               
            </td>
        </tr>
        <tr>
            <td width="16%" class="tit"> 推荐行业：</td>
            <td width="84%" class="txtlou">
              <?php  echo CHtml::dropDownList("sb_recommendtrade",$shopBaseInfoModel->sb_recommendtrade, Shopbaseinfo::$sb_profession,array('empty'=>'请选择'));
                 ?>
            </td>
        </tr>
		<tr>
            <td width="16%" class="tit">物业费：</td>
            <td width="84%" class="txtlou">
                <?=CHtml::textField("sb_propertycost",$shopBaseInfoModel->sb_propertycost,array("onblur"=>"validateNum(this)","size"=>"5"));?>&nbsp;元/平米·月&nbsp;<span class="errorMessage"></span>
            </td>
        </tr>
        
    </table>
</div>
<?php
/*
 ?>
<div class="ihtit" style="margin-bottom:10px;">
    2、房源详细
    <span style=" float:right; padding-right:10px; font-weight:normal; font-size:12px;"><a id="gaojiinfo" href="javascript:;"><img alt="" src="/images/btn_showinfo.gif"></a></span>
</div>
<div class="rgcont">
    <table cellspacing="0" cellpadding="0" border="0" class="table_01 hidden"  id="detailed_info">
        <tr>
            <td width="16%" class="tit"> 装修程度：</td>
            <td width="84%" class="txtlou">
            <?php echo CHtml::radioButtonList("sb_adrondegree",
                    $shopBaseInfoModel->sb_adrondegree?
                    $shopBaseInfoModel->sb_adrondegree:"1",
                    Shopbaseinfo::$sb_adrondegree,array("separator"=>"&nbsp"));?>
            </td>
        </tr>
        <tr>
            <td width="16%" class="tit"> 朝向：</td>
            <td width="84%" class="txtlou">
            <?=CHtml::radioButtonList("sb_towards",
                    $shopBaseInfoModel->sb_towards?$shopBaseInfoModel->sb_towards
                    :"1",
                    Shopbaseinfo::$sb_towards,array("separator"=>"&nbsp"));?>
            </td>
        </tr>
        <tr>
            <td width="16%" class="tit"> 地段：</td>
            <td width="84%" class="txtlou">
            <?=CHtml::dropDownList("sb_loop",$shopBaseInfoModel->sb_loop,Searchcondition::model()->getAllLoops(1));?>
            </td>
        </tr>
        <tr>
            <td width="16%" class="tit"> 临近轨道：</td>
            <td width="84%" class="txtlou">
            <?=CHtml::checkBoxList("sb_busway_tmp",
                    $shopBaseInfoModel->sb_busway?
                    explode(",", $shopBaseInfoModel->sb_busway):array(),
                    Searchcondition::model()->getAllMetros("1"),array("separator"=>"&nbsp"));?>
            </td>
        </tr>
        <tr>
            <td width="16%" class="tit"> 物业公司：</td>
            <td width="84%" class="txtlou">
            <?=CHtml::textField("sb_propertycomname",$shopBaseInfoModel->sb_propertycomname);?>
            </td>
        </tr>
        
        
        <tr>
            <td width="16%" class="tit">配套设施：</td>
            <td width="84%" class="txtlou">
                <input id="selectAllFac" type="checkbox">
                <label for="selectAllFac">全选</label>
                <?=CHtml::checkBox("sf_carparking",$shopFacilityInfoModel->sf_carparking,array("uncheckValue"=>"0"));?><label for="sf_carparking">停车场</label>
                <?=CHtml::checkBox("sf_warming",$shopFacilityInfoModel->sf_warming,array("uncheckValue"=>"0"));?><label for="sf_warming">暖气</label>
                <?=CHtml::checkBox("sf_network",$shopFacilityInfoModel->sf_network,array("uncheckValue"=>"0"));?><label for="sf_network">网络</label>
                <?=CHtml::checkBox("sf_elevator",$shopFacilityInfoModel->sf_elevator,array("uncheckValue"=>"0"));?><label for="sf_elevator">货梯</label>
                <?=CHtml::checkBox("sf_lift",$shopFacilityInfoModel->sf_lift,array("uncheckValue"=>"0"));?><label for="sf_lift">电梯</label>
                <?=CHtml::checkBox("sf_gas",$shopFacilityInfoModel->sf_gas,array("uncheckValue"=>"0"));?><label for="sf_gas">天然气</label>
                <?=CHtml::checkBox("sf_aircondition",$shopFacilityInfoModel->sf_aircondition,array("uncheckValue"=>"0"));?><label for="sf_aircondition">空调</label>
                <?=CHtml::checkBox("sf_tv",$shopFacilityInfoModel->sf_tv,array("uncheckValue"=>"0"));?><label for="sf_tv">电视</label>
                <?=CHtml::checkBox("sf_door",$shopFacilityInfoModel->sf_door,array("uncheckValue"=>"0"));?><label for="sf_door">防盗门</label>
            </td>
        </tr>
    </table>
</div>
<?php
 */
?>
<div class="ihtit" style="margin-bottom:10px;">
    2、房源描述
</div>
<div class="rgcont">
    <table cellspacing="0" cellpadding="0" border="0" class="table_01">
        <tr>
            <td width="16%" class="tit"><em>*</em> 标题：</td>
            <td width="84%" class="txtlou">
                精确完整的标题是您增加点击量，吸引客户注意力第一步！<br />
                <?=CHtml::textField("sp_shoptitle",$shopPresentInfoModel->sp_shoptitle,array("maxlength"=>35,"size"=>60,"onkeyup"=>"CheckTitle(this)","onblur"=>"CheckTitle(this)"));?>&nbsp;<span class="errorMessage"></span>
            </td>
        </tr>
        <tr>
            <td width="16%" class="tit"><em>*</em>描述：</td>
				<td width="84%" class="txtlou">
					<?=CHtml::textArea("sp_shopdesc",$shopPresentInfoModel->sp_shopdesc,array("cols"=>"85","rows"=>"20"));?>
            </td>
        </tr>
    </table>
</div>
<?php if($shopBaseInfoModel->isNewRecord){ ?>
<div class="ihtit" style="margin-bottom:10px;">
    3、房源图片
</div>
<div class="rgcont">
<?php echo $this->renderPartial('/common/formpicture',array('sourceType'=>'shop')); ?>
</div>
<?php } ?>

<div class="rgcont">
    <table cellspacing="0" cellpadding="0" border="0" class="table_01">
        <tr>
            <td width="16%" class="tit">信息有效期：</td>
            <td width="84%" class="txtlou">
                <?=CHtml::dropDownList("sb_expiredate",$shopBaseInfoModel->sb_expiredate?$shopBaseInfoModel->sb_expiredate/86400:"60",array("30"=>"30天","60"=>"60天","90"=>"90天"));?>
            </td>
        </tr>
        <tr>
            <td width="16%">&nbsp;</td>
            <td width="84%" class="txtlou">
                <?php
                if($shopBaseInfoModel->isNewRecord){
                    echo CHtml::submitButton('发布',array('name'=>'submit','onClick'=>'return validateOptNum(this)','class'=>"manage_input_button"));
                    echo CHtml::submitButton('保存为草稿',array('name'=>'sketch','onClick'=>'return validateOptNum(this)','class'=>'manage_input_buttonlong'));
                }else{
                    echo CHtml::submitButton('保存',array('name'=>'submit'));
                    echo CHtml::Button('取消',array("onclick"=>"history.go(-1)"));
                }
                 ?></td>
        </tr>
    </table>
</div>
</form>
<script type="text/javascript">
$(document).ready(function(){
    checkType("input[name='sb_businesstype']:checked",1);
    checkType("input[name='sr_renttype']:checked",2);
    checkType('<?=$floor[0]?>',3);
});
</script>
<script type="text/javascript">
function checkType(obj,type){
    if(type==1){//当前状态
         if($(obj).val()!=3){
                   $("#sb_profession").show();
         }else{
                   $("#sb_profession").hide();
         }
    }else if(type==2){//租凭方式
         if($(obj).val()==2){
               $("#renttype_list").show();
         }else{
               $("#renttype_list").hide();
        }
    }else if(type==3){//楼层
        for(i=1;i<=3;i++){
            if(obj!=i){
                $("#floorInput_"+i).hide();
                continue;
            }
            $("#floorInput_"+i).show();
        }
         
    }

}


/**
 * 提交表单时验证
 */
function submitValidate(){
    //只有在商铺类型为2或者4的时候才查看小区
   if($("#td_sb_shoptype input:checked").val()=="2"||$("#td_sb_shoptype input:checked").val()=="4"){
        if($("#sb_sysid").val()==""){
            $("#buildName").next("span").html("请选择小区");
            $("#buildName").focus();
            return false;
        }
    }
   
	if(!checkSection($("#sb_section"))){//验证板块
        return false;
    }

    if(!checkAddress("#sb_shopaddress")){//验证地址
        $("#sb_shopaddress").focus();
        return false;
    }

   if(!validateNum($("#sb_propertycost"))){//验证物业费

        $("#sb_propertycost").focus();
        return false;
    }
    
    if(!checkArea($("#sb_shoparea"))){//验证面积
        $("#sb_shoparea").focus();
        return false;
    }
    if(typeof CheckRentPrice == 'function') {
        if(!CheckRentPrice($("#sr_rentprice"))){//验证租金
            $("#sr_rentprice").focus();
            return false;
        }
    }
    if(typeof checkMonthPrice == 'function') {
        if(!checkMonthPrice($("#sr_monthrentprice"))){//验证月租金
            $("#sr_monthrentprice").focus();
            return false;
        }
    }
    if(typeof CheckSumSalePrice == 'function') {
        if(!CheckSumSalePrice($("#ss_sumprice"))){//验证售价
            $("#ss_sumprice").focus();
            return false;
        }
    }
    if(typeof CheckAvgPrice == 'function') {
        if(!CheckAvgPrice($("#ss_avgprice"))){//验证售价
            $("#ss_avgprice").focus();
            return false;
        }
    }
    if(!CheckTitle($("#sp_shoptitle"))){//验证标题
        $("#sp_shoptitle").focus();
        return false;
    }
    if($.trim($("#sp_shopdesc").val())==""){
        alert("描述不能为空");
        return false;
    }
    if($("#sp_shopdesc").val().length>65535){
        alert("抱歉，您的描述内容太长！请截取一部分再试.");
        return false;
    }
    return true;
}
var basePicData = [];//存放选择过的图片
var hideBasePicData = []; //
function setBasePicData(val,add){
    if(add){
        basePicData[basePicData.length]=val;
    }else{
        var tArr = basePicData;
        var c=tArr.length;
        while(c--){
            if(tArr[c]==val)
                basePicData.splice(c,1);
        }
    }
}
function setBasePicSrc(id){
    $("#tr_iframe_basepic").show();
    var _bpcurl = "<?php echo YII::app()->createUrl('/manage/picture/showbasepic',array('type'=>1)) ?>?id="+id;
    $("#iframe_basepic").attr('src',_bpcurl);
    $("#basepicture").empty();
    basePicData = [];
}
function setBasePic(id,src,img,add){
    if(add){
        var html = '<div style="width: 110px;float: left" id="'+id+'">\
                    <img src="'+src+'" width="100px" height="75px"/><br />\
                    图片描述<input type="text" basepic="'+img+'" maxlength="10" size="12" id="title'+id+'" name="imgtitle[]" /><br />\
                    <div style="cursor: pointer;width: 50px;float: left" onclick="delBasePic(\''+id+'\');">删除</div>\
                    <div style="cursor: pointer;" onclick="basePicToTitle(\''+src+'\',\''+img+'\')">设标题图</div>\
                </div>';
        $("#basepicture").append(html);

    }else
        $("#"+id).remove();
    setBasePicData(id,add);
}
function basePicToTitle(src,img){
    $("#titlepic_img").attr('src',src);
    $("#titlepic_hidden").val(img);
}
function delBasePic(id){
    setBasePicData(id,false);
    window.frames['basepicture'].document.getElementById("base"+id).checked = false;
    $("#"+id).remove();
    //$("#titlepic_img").attr('src',"<?=IMAGE_URL?>/p-lack.jpg");$("#titlepic_hidden").val('');
}
$("#td_sb_shoptype input").click(
    function (){
        var val = $(this).val();
        var display = "none";
        if(val=='4' || val=='2'){
            display = "";
            $("#tr_iframe_basepic").show();
            basePicData = hideBasePicData;
        }else{
            $("#tr_iframe_basepic").hide();
            hideBasePicData = basePicData;
            basePicData = [];
        }
        $("#tr_sb_sysid").css("display",display);
    }
);
$("#sb_district").change(
    function(){
        changeNext(this);
    }
);
function changeNext(obj){
    var parentid = $(obj).val();
    var html = "<option value=''>---请选择---</option>";
    if(parentid==0){
        $(obj).nextAll("select").html(html);//删除后面所有的选择。
    }else{
        $.ajax({
           url: "<?php echo Yii::app()->createUrl("/region/getlistbyparentid") ?>",
           type: "GET",
           data: "parentid="+parentid,
           async: false,
           success: function(msg){
               var msg = eval("("+msg+")");
               $(obj).nextAll("select").html(html);//删除后面所有的选择。
               for(var i=0;i<msg.length;i++){
                   html += "<option value='"+msg[i]['re_id']+"'>"+msg[i]['re_name']+"</option>";
               }
               $(obj).next("select").html(html);
           }
        });
    }
}
    //查询楼盘名称
function searchBuildName() {
    $("#search_suggest").css("display", "");
    $("#message").css("display", "");
    $("#add_build").css("display","none");
    var inputField = document.getElementById( "buildName");
    var suggestText = document.getElementById( "search_suggest");
    $("#sb_sysid").val("");
    if (inputField.value.length > 0) {
        $.ajax({
            url: '<?php echo Yii::app()->createUrl("/manage/viewoffisell/showlikename");?>',
            data: 'keyw='+inputField.value,
            type: 'POST',
            success: function(msg){
                msg = eval("("+msg+")");
                if(msg.length >0){
                    suggestText.style.display= "";
                    suggestText.innerHTML = "";
                    for(var i=0;i <msg.length;i++) {
                        var s=' <div onmouseover="javascript:suggestOver(this);"';
                        s+=' onmouseout= "javascript:suggestOut(this);" ';
                        s+=' onclick= "javascript:getOtherBuildInfo('+msg[i]['sbi_buildingid']+');" ';
                        s+=' class= "suggest_link">' +msg[i]['sbi_buildingname']+'&nbsp;&nbsp;';
                        s+='(地址：'+msg[i]['sbi_address']+')';
                        s+='</div>';
                        suggestText.innerHTML += s;
                    }
                }
                else{
                    suggestText.style.display= "";
                    suggestText.innerHTML = "没有搜到匹配的小区<a href='javascript:addBuild()' style='color:blue'>添加楼盘</a>";
                }
            }
        });
    }
    else {
        suggestText.style.display= "none";
    }
}
/**
 * 通过房源id，得到需要的全部信息
 */
function getOtherBuildInfo(id){
    setBasePicSrc(id);
    $("#search_suggest").html("").css("display","none");
    closeAddBuildFrame();
    $.ajax({
        type: "GET",
        url: "<?php echo Yii::app()->createUrl("/systembuildinginfo/getbuildinfo"); ?>",
        data: "buildingid="+id,
        success: function (msg){
            msg = eval("("+msg+")");
            //隐藏域中id
            $("#sb_sysid").val(msg['sbi_buildingid']);
            //名称
            $("#buildName").val(msg['sbi_buildingname']);
            //地址
            $("#sb_shopaddress").val(msg['sbi_address']);
            //环线
            if(msg['sbi_loop']){
                $("#sb_loop").get(0).selectedIndex=msg['sbi_loop']-1;
            }
            //位置
            if(msg['sbi_district']){
                $("#sb_district").val(msg['sbi_district']);
                changeNext($("#sb_district"));
            }
            //轨道
            if(msg['sbi_busway']){
                var busway = msg['sbi_busway'].split(",");
                for(var i=0;i<busway.length;i++){
                    $("#sb_busway").children("input").eq(busway[i]-1).get(0).checked = true;
                }
            }
            //物业公司
            if(msg['sbi_propertyname']){
                $("#sb_propertycomname").val(msg['sbi_propertyname']);
            }
            //物业费
            if(msg['sbi_propertyprice']){
                $("#sb_propertycost").val(msg['sbi_propertyprice']);
            }
            //楼层
            if(msg['sbi_floor']){
                //$("#sb_allfloor").val(msg['sbi_floor']);
            }
            //建筑面积
//            if(msg['sbi_buildingarea']){
//                $("#sb_shoparea").val(msg['sbi_buildingarea']);
//            }
        }
    });
}
function closeAddBuildFrame(){
    $("#add_build").html("").css("display","none");
    $("#buildName").removeAttr("readonly").css("background-color","white");
}
function suggestOver(div_value){
    div_value.className = "suggest_link_over";
}
function suggestOut(div_value){
    div_value.className = "suggest_link";
}
function addBuild(){
    $("#search_suggest").html("").css("display","none");
    $("#buildName").attr("readonly","true").css("background-color","#CCC");
    var html = '<iframe src="<?php echo Yii::app()->createUrl('/manage/buildcollect/create')?>" frameborder="0" width="400px" height="210px" style="margin-top:10px"></iframe>';
    $("#add_build").css("display","").html(html);
}
/**
 * 详细信息展开
 */
//详细信息展开
$("#gaojiinfo").toggle(
    function () {
        $("#detailed_info").removeClass("hidden").addClass("show");
        $("#gaojiinfo").children("img").attr("src","/images/btn_hideinfo.gif");
    },
    function () {
        $("#detailed_info").removeClass("show").addClass("hidden");
        $("#gaojiinfo").children("img").attr("src","/images/btn_showinfo.gif");
    }
);
var checkAllFacility = false;
$("#selectAllFac").bind("click",function(){
    if(checkAllFacility){
        $(this).siblings("input").removeAttr("checked");
        checkAllFacility=false;
    }else{
       $(this).siblings("input").attr("checked","checked");
       checkAllFacility=true;
    }
})
//验证不能为空
function checkName(obj){
    if($.trim($(obj).val())==""){
        $(obj).next("span").html("名称不能为空");
        return false;
    }else{
        $(obj).next("span").html("");
        return true;
    }
}
/**
 * 验证地址不为空
 */
function checkAddress(obj){
    if($.trim($(obj).val())==""){
        $(obj).next("span").html("地址不能为空");
        return false;
    }else{
        $(obj).next("span").html("");
        return true;
    }
}

//验证只能是数字
function validateNum(obj){
    var value = $.trim($(obj).val());
    if(value!=""){
        if(isNaN(value)){
            $(obj).next("span").html("只能为数字");
            $(obj).focus();
            return false;
        }else{
            $(obj).next("span").html("");
            return true;
        }
    }else{
        $(obj).next("span").html("");
        return true;
    }

}
//验证楼层
function validateFloor(obj){
    
    var floorNum = $.trim($(obj).val());//当前楼层
     if(floorNum!=""){
         if(isNaN(floorNum)){
             $(obj).nextAll("span").html("楼层只能为数字");
             $(obj).focus();
             return false;
         }else if(parseInt(floorNum)!=floorNum ||floorNum.indexOf(".")>=0){
             $(obj).nextAll("span").html("楼层只能为整数");
             $(obj).focus();
             return false;
         }else if(parseInt(floorNum)==0){
             $(obj).nextAll("span").html("楼层不能等于0，请重新输入");
             $(obj).focus();
             return false;
         }else if(parseInt(floorNum)>1000){
             $(obj).nextAll("span").html("楼层不能大于1000，请重新输入");
             $(obj).focus();
             return false;
         }else {
             $(obj).nextAll("span").html("");
             return true;
         }
     }else {
         $(obj).nextAll("span").html("");
         return true;
     }
}
//验证标题
function CheckTitle(obj){
    $(obj).next("span").css("color", "");
    var allNum = 35;
    var value = $.trim($(obj).val());
    if(value==""){
        $(obj).next("span").html("请填写房源标题！");
        return false;
    }else if(value.length>=allNum){
        $(obj).next("span").html("房源标题最多填写"+allNum+"个字！");
        $(obj).focus();
        return false;
    }else if(value.length==allNum){
       $(obj).next("span").css("color", "black");
        $(obj).next("span").html("（<font style='font-weight:bold'>"+$(obj).val().length+"</font>/"+allNum+"个字）");
        return true;
    }else {
        $(obj).next("span").css("color", "black");
        $(obj).next("span").html("（"+$(obj).val().length+"/"+allNum+"个字）");
        return true;
    }
}
//是否推荐或是否急房源选择时的扣除新币的提示
function money_check_hint(obj){
    if($(obj).attr('checked')){
        var index=$(obj).attr('id').charAt($(obj).attr('id').length-1);
        if(Number(index)>=1){
            $(obj).parent().find("span").css('display','inline');
        }else{
            $(obj).parent().find("span").css('display','none');
        }
    }
}
/**
 * 板块不能为空
 */
function checkSection(obj){
    var value = $.trim($(obj).val());
    if(value==""){
        $(obj).focus();
        $(obj).nextAll("span").html("位置不能为空！");
        return false;
    }else{
        $(obj).nextAll("span").html("");
        return true;
    }
}
</script>