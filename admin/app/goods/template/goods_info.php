<div class="contentbox">
<style type="text/css">
.menu_content .tab{ display:none}
.nav .active{
	 /*background: url(<?php echo $this->img('manage_r2_c13.jpg');?>) no-repeat;*/
	 background-color:#F5F5F5;
} 
.nav .other{
	/* background: url(<?php echo $this->img('manage_r2_c14.jpg');?>) no-repeat;*/
	 background-color:#E9E9E9;
} 
h2.nav{ border-bottom:1px solid #B4C9C6;font-size:13px; height:25px; line-height:25px; margin-top:0px; margin-bottom:0px}
h2.nav a{ color:#999999; display:block; float:left; height:24px;width:113px; text-align:center; margin-right:1px; margin-left:1px; cursor:pointer}
.addi{ margin:0px; padding:0px;}
.vipprice td{ border-bottom:1px dotted #ccc}
.vipprice th{ background-color:#EEF2F5}
</style>
<form action="" method="post" enctype="multipart/form-data" name="theForm" id="theForm">
 <h2 class="nav">
 <a class="active" onclick="show_hide('1'); return false;">通用属性</a>
</h2>

 <div class="menu_content">
 	<!--start 通用信息-->
	 <table cellspacing="2" cellpadding="5" width="100%" id="tab1">
	  <tr>
		<td class="label">礼物名称:</td>
		<td><input name="gift_name" id="goods_name"  type="text" size="43" value="<?php echo isset($rt['gift_name']) ? $rt['gift_name'] : '';?>"><span style="color:#FF0000">*</span><span class="goods_name_mes"></span>
		</td>
	  </tr>
	 <tr>
		<td class="label" width="150">赞助商家:</td>
<!--		<td><textarea name="business_name" style="width:30%;height:15px;"><?php echo isset($rt['business_name']) ? $rt['business_name'] : '';?></textarea>		
<!-- 		</td> -->
		<td>
			<select name="business_id">
		<?php if(isset($arr_business_name)&&!empty($arr_business_name)) {
		          foreach ( $arr_business_name as $row ){
		    ?>
				<option value="<?php echo $row['business_id'];?>" <?php if($rt['business_name'] == $row['business_name']) echo "selected ='selected'";?>><?php echo $row['business_name'];?></option>
		<?php  }}?>
			</select>
		</td>
	  </tr>
	<tr>
            <td class="label">礼物价值：</td>
            <td><input name="gift_value" value="<?php echo isset($rt['gift_value']) ? $rt['gift_value'] : '100000';?>" size="20" type="text" /></td>
    </tr>
    <tr>
    		<td class="label">礼物价值礼物币：</td>
    		<td><input name="gift_coin" value="<?php echo isset($rt['gift_coin']) ? $rt['gift_coin'] : '0';?>" /></td>
    </tr>
    <tr>
    		<td class="label">礼物库存</td>
    		<td><input name="gift_stock" value="<?php echo isset($rt['gift_stock']) ? $rt['gift_stock'] : '0'?>" /></td>
    </tr>


	  <tr>
		<td class="label">上传礼物图片:</td>
		<td>
		  <?php if(isset($rt['image_url'])){ ?><img src="<?php echo !empty($rt['image_url']) ? SITE_URL.$rt['image_url'] : $this->img('no_picture.gif');?>" width="100" style="padding:1px; border:1px solid #ccc"/><?php } ?>
		  <input name="image_url" id="goods" type="hidden" value="<?php echo isset($rt['image_url']) ? $rt['image_url'] : '';?>"/>
		  <iframe id="iframe_t" name="iframe_t" border="0" src="upload.php?action=<?php echo isset($rt['image_url'])&&!empty($rt['image_url'])? 'show' : '';?>&ty=goods&files=<?php echo isset($rt['image_url']) ? $rt['image_url'] : '';?>" scrolling="no" width="445" frameborder="0" height="25"></iframe>
		</td>
	  </tr>

		  <tr><td colspan="2" style="border-top:1px dotted #FFCCCC"></td></tr>
		  
	 </table>
	  <p style="text-align:center;">
		<input class="new_save" value="保存<?php echo $type=='edit' ? '修改' : '添加';?>" type="Submit" style="cursor:pointer" />&nbsp;
	  </p>
	  <div style="clear:both"></div>
 </div>
  </form>
</div>

<?php  $thisurl = ADMIN_URL.'goods.php'; ?>
<script type="text/javascript">

//jQuery(document).ready(function($){
	$('.new_save').click(function(){
		art_title = $('#goods_name').val();
		if(art_title=='undefined' || art_title==""){
			$('.goods_name_mes').html("标题不能为空！");
			$('.goods_name_mes').css('color','#FE0000');
			return false;
		}
		return true;
	});
	
function show_hide(id){
	len = $('.nav a').length;
	if(len>1){
		for(i=1;i<=len;i++){
			if(i==id) { 
				$($('.nav a')[i-1]).removeClass();
				$($('.nav a')[i-1]).addClass('active');
				$("#tab"+id).css('display','block');
			}else{
				$($('.nav a')[i-1]).removeClass();
				$($('.nav a')[i-1]).attr('class',"other");
				$("#tab"+i).css('display','none');
			}
		}
	}
}


function show_addi_type(obj){
	var upvar = $(obj).parent().parent().find('.select option:selected').attr('id'); //获取下拉选中的id值
	if(upvar=="" || typeof(upvar)=='undefined'){ alert("请先选择"); return false; }
	thisvar = $(obj).val();
	 if(thisvar==1){
		$(obj).parent().find('.addi').html('<input name="attr_addi_list[]" value="" size="40" type="text">附加文本,可以是价格');
	}else if(thisvar==2){
		$(obj).parent().find('.addi').html('<input name="attr_addi_list[]" id="goodsaddi'+upvar+'" value="" type="hidden"><iframe id="iframe_t" name="iframe_t" border="0" src="upload.php?action=&ty=goodsaddi'+upvar+'&tyy=goodsaddi&files=" scrolling="no" width="445" frameborder="0" height="25"></iframe>附加图像');
	}else{
		$(obj).parent().find('.addi').html('<input name="attr_addi_list[]" value="" type="hidden">');
	}

	return true;
}

function setvar(obj){
	var thisvar = $(obj).parent().find('.select option:selected').attr('id');
	var setobj = $(obj).parent().find('input[name="attr_addi_list[]"]');
	if(typeof(setobj)!='undefined'){
		setobj.attr('id','goodsaddi'+thisvar);
	}
}
/*增删加控件*/
$('.addaddi').live('click',function(){
	var upvar = $(this).parent().parent().find('.select').val();
	if(upvar=="" || typeof(upvar)=='undefined'){ alert("请先选择"); return false; }
	str = $(this).parent().parent().html();
	str = str.replace('addaddi','removeaddi');
	str= str.replace('[+]','[-]');
	$(this).parent().parent().after('<tr>'+str+'</tr>');
});

$('.removeaddi').live('click',function(){
	$(this).parent().parent().remove();
	return false;
});

//删除该商品的属性
$('.delattr').click(function(){
	   	ids = $(this).val();
		thisobj = $(this).parent();
		if(confirm("确定删除吗")){
			$('.openwindow').show(200);
			$.post('<?php echo $thisurl;?>',{action:'goods_attr_item_del',id:ids},function(data){
				$('.openwindow').hide(200);
				if(data == ""){
					thisobj.hide(300);
				}else{
					alert(data);	
				}
			});
		}else{
			return false;	
		}
});

//删除相册图片
$('.delgallery').click(function(){
	   	ids = $(this).attr('id');
		thisobj = $(this).parent();
		if(confirm("确定删除吗")){
			$('.openwindow').show(200);
			$.post('<?php echo $thisurl;?>',{action:'delgallery',id:ids},function(data){
				$('.openwindow').hide(200);
				if(data == ""){
					thisobj.hide(300);
				}else{
					alert(data);	
				}
			});
		}else{
			return false;	
		}
});

/*增删相册控件*/
$('.addgallery').live('click',function(){
	rand = generateMixed(4);
	str = $(this).parent().parent().html();
	str = str.replace('addgallery','removegallery');
	str = str.replace('[+]','[-]');
	str = str.replace(/goodsgallery/g,'goodsgallery'+rand); //正则表达式替换多个
	$(this).parent().parent().after('<tr>'+str+'</tr>');
});

$('.removegallery').live('click',function(){
	$(this).parent().parent().remove();
	return false;
});

//产生随机数
function generateMixed(n) {
	var chars = ['0','1','2','3','4','5','6','7','8','9','a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z'];
    var res = "";
    for(var i = 0; i < n ; i ++) {
        var id = Math.ceil(Math.random()*35);
        res += chars[id];
    }
    return res;
}

/*增删子分类控件*/
	$('.addsubcate').live('click',function(){
		var upvar = $(this).parent().parent().find('#cat_id').val();
		if(upvar=="0" || typeof(upvar)=='undefined'){ alert("请先选择"); return false; }
		str = $(this).parent().parent().html();
		str = str.replace('addsubcate','removesubcate');
		str = str.replace('点击[+]增加一个','点击[-]减少一个');
		str = str.replace(/cat_id/g,'sub_cat_id[]');
		str= str.replace('[+]','[-]');
		$(this).parent().parent().after('<tr>'+str+'</tr>');
	});
	
	$('.removesubcate').live('click',function(){
		$(this).parent().parent().remove();
		return false;
	});
	
	function del_subcate(cid,gid,obj){
		if(confirm("确定删除吗？")){
		   $.post('<?php echo $thisurl;?>',{action:'del_subcate_id',cid:cid,gid:gid},function(data){
			if(data == ""){
				$(obj).hide(200);
			}else{
				alert(data);
			}
			});
		}else{
			return false;
		}
	}
	
	function handlePromote(checked){
		document.forms['theForm'].elements['promote_price'].disabled = !checked;
		document.forms['theForm'].elements['promote_start_date'].disabled = !checked;
		document.forms['theForm'].elements['promote_end_date'].disabled = !checked;
		if(checked==true){
			$('input[name="promote_price"]').css('background-color','#FFF');
			$('input[name="promote_start_date"]').css('background-color','#FFF');
			$('input[name="promote_end_date"]').css('background-color','#FFF');
		}else{
			$('input[name="promote_price"]').css('background-color','#EDEDED');
			$('input[name="promote_start_date"]').css('background-color','#EDEDED');
			$('input[name="promote_end_date"]').css('background-color','#EDEDED');
		}
      	//document.forms['theForm'].elements['selbtn1'].disabled = !checked;
      	//document.forms['theForm'].elements['selbtn2'].disabled = !checked;
	}
	
	function checkvar(obj){ 
		thisvar = $(obj).val();
		if(thisvar>0){
		}else{
		$(obj).val("0.00");
		}
	}
	
	function handlejifen(checked){
		document.forms['theForm'].elements['need_jifen'].disabled = !checked;
		if(checked==true){
			$('input[name="need_jifen"]').css('background-color','#FFF');
		}else{
			$('input[name="need_jifen"]').css('background-color','#EDEDED');
		}
	}
	

function handleqianggou(checked){
		document.forms['theForm'].elements['qianggou_price'].disabled = !checked;
		document.forms['theForm'].elements['qianggou_start_date'].disabled = !checked;
		document.forms['theForm'].elements['qianggou_end_date'].disabled = !checked;
		if(checked==true){
			$('input[name="qianggou_price"]').css('background-color','#FFF');
			$('input[name="qianggou_start_date"]').css('background-color','#FFF');
			$('input[name="qianggou_end_date"]').css('background-color','#FFF');
		}else{
			$('input[name="qianggou_price"]').css('background-color','#EDEDED');
			$('input[name="qianggou_start_date"]').css('background-color','#EDEDED');
			$('input[name="qianggou_end_date"]').css('background-color','#EDEDED');
		}
      	//document.forms['theForm'].elements['selbtn1'].disabled = !checked;
      	//document.forms['theForm'].elements['selbtn2'].disabled = !checked;
	}
	
	function checkqianggouvar(obj){ 
		thisvar = $(obj).val();
		if(thisvar>0){
		}else{
		$(obj).val("0.00");
		}
	}
	
/*增删加控件*/
$('.addgift_type').live('click',function(){
	str = $(this).parent().parent().html();
	str = str.replace('addgift_type','removeaddgift_type');
	str= str.replace('[+]','[-]');
	$(this).parent().parent().after('<tr class="showgift">'+str+'</tr>');
});

$('.removeaddgift_type').live('click',function(){
	$(this).parent().parent().remove();
	return false;
});
function handlegift(checked){
	if(checked==true){
		//$('.showgift').css('display','block');
		$('.showgift').show();
	}else{
		//$('.showgift').css('display','none');
		$('.showgift').hide();
	}
}

function delgoodsgift(gid,ids,obj){
		if(confirm("确定删除吗？")){
		   $.post('<?php echo $thisurl;?>',{action:'delgoodsgift',goods_id:gid,giftid:ids},function(data){
			if(data == ""){
				$(obj).remove()
			}else{
				alert(data);
			}
			});
		}else{
			return false;
		}
}
//});

function ajax_cate_name(obj){
	va = $(obj).parent().find('.searchval').val();
	$.post('<?php echo $thisurl;?>',{action:'ajax_cate_name',searchval:va},function(data){
		if(data == ""){
			alert("未找到！");
		}else{
			$(obj).parent().find('select').html(data);
		}
	});
}

$('.ajaxshowmoney li input').focus(function(){
	$(this).parent().find('div').show();
});
$('.ajaxshowmoney li input').blur(function(){
	$(this).parent().find('div').hide();
});

</script>
