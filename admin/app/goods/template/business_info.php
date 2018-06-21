
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
	<form action="" id="form1" class="form1" method="post">
		<table cellspacing="2" cellpadding="5" width="100%">
			<tr>
    			<th colspan="14">编辑界面</th>
			</tr>
	<?php if(isset($businessinfo)&&!empty($businessinfo))
	           foreach( $businessinfo as $row)
	               {?>
    		<tr>
        		<td>商家名字</td>
        		<td><input value="<?php echo $row['business_name']?>"/></td>
    		</tr>
    		<tr>
    			<td class="label" valign="middle"><a href="javascript:;" class="addgallery">[+]</a>礼物名称：</td>
    			<td></td>
    		</tr>

    		
    <?php }?>
		</table>
	</form>
</div>

<script type="text/javascript">

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


</script>









