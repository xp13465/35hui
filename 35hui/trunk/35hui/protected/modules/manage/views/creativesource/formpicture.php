<table cellspacing="0" cellpadding="0" border="0" class="table_01">
    <tr>
        <td width="16%" class="tit">
            <input type="hidden" id="base_images" name="picture[baseimg]">
        </td>
        <td width="84%" class="txtlou">图片大小必须在4M以内(jpg、jpeg、png、gif 格式)</td>
    </tr>
    <tr>
        <td width="16%" class="tit">房源内景：</td>
        <td width="84%" class="txtlou">
            <iframe name="indoor" width="688px" height="50px" src="<?php echo YII::app()->createUrl('/manage/imageinfo/uploadframe',array("type"=>3,'sourceType'=>$sourceType)) ?>" frameborder="0" scrolling="no"></iframe>
            <input type="hidden" name="picture[indoor]" id="indoor_hidden" value="" />
        </td>
    </tr>
     <tr>
        <td width="16%" class="tit">房源外景：</td>
        <td width="84%" class="txtlou">
            <iframe name="outdoor" width="688px" height="50px" src="<?php echo YII::app()->createUrl('/manage/imageinfo/uploadframe',array("type"=>2,'sourceType'=>$sourceType,"p_type"=>2)) ?>" frameborder="0" scrolling="no"></iframe>
            <input type="hidden" name="picture[outdoor]" id="outdoor_hidden" value="" />
        </td>
    </tr>
    <tr>
        <td width="16%" class="tit">房源平面图：</td>
        <td width="84%" class="txtlou">
            <iframe name="ichnograph" width="688px" height="50px" src="<?php echo YII::app()->createUrl('/manage/imageinfo/uploadframe',array("type"=>1,'sourceType'=>$sourceType,"p_type"=>1 )) ?>" frameborder="0" scrolling="no"></iframe>
            <input type="hidden" name="picture[ichnograph]" id="ichnograph_hidden" value="" />
        </td>
    </tr>
    <tr>
        <td width="16%" class="tit">标题图：</td>
        <td width="84%" class="txtlou">
            <img src="<?=IMAGE_URL?>/p-lack.jpg" id="titlepic_img" width="110px" height="80px" style="border: 1px solid #CCC;padding: 2px;margin-top: 5px;margin-left: 15px"/>
            <input type="hidden" name="picture[titlepic]" id="titlepic_hidden" value="" /> 请选择上面任意一幅图片作为标题图
        </td>
    </tr>
</table>