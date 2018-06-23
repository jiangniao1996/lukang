<div class="contentbox">
     <table cellspacing="2" cellpadding="5" width="100%">
	 <tr>
		<th colspan="2" align="left"><?php echo $type=='ads_edit' ? '修改' : '添加';?>游戏</th>
	</tr>
	<!-- <tr>
		<td class="label" width="15%">游戏题型:</td>
		<td width="85%">
		<select name="tids" id="tids">
		<option value="">==请选择==</option>
		<?php 
		if(!empty($rts)){
		 foreach($rts as $row){ 
		?>
		<option value="<?php echo $row['tid'];?>" <?php echo isset($rt['tid'])&&$row['tid']==$rt['tid'] ? 'selected="selected"' : '';?>><?php echo $row['ad_name'];?></option>
		<?php }} ?>
		</select> 
		<span class="require-field">*</span><span class="tids_mes"></span></td>
	  </tr> -->
	  <!-- <tr class="catelist" <?php echo ($rt['type']=='gc'|| $rt['type']=='ac')? 'style="display:block"' : 'style="display:none"';?>>
		<td class="label">选择展示分类:</td>
		<td width="85%">
		<input type="hidden" name="type" value="<?php echo $rt['type'];?>"/>
		<select name="cat_id" id="cat_id">
		<?php $this->element('ajax_cate_option',array('catelist'=>$catelist,'cat_id'=>$rt['cat_id']));?>
		</select> 
		</td>
	  </tr> -->
	  <tr>
		<td class="label">游戏名称:</td>
		<td><input id="game_name"  type="text" size="43" value="<?php echo isset($rt['game_name']) ? $rt['game_name'] : '';?>"><span class="game_name_mes"></span></td>
	  </tr>
	  <tr>
		<td class="label">每次挑战游戏时间</td>
		<td><input onkeyup="value=this.value.replace(/\D+/g,'')" id="game_time" type="text" value="<?php echo $rt['game_time'] ? $rt['game_time'] : '';?>" />秒&nbsp;&nbsp;&nbsp;<span class="game_time_mes"></span></td>
	  </tr>
	  <tr>
		<td class="label">每天能挑战的次数</td>
		<td><input onkeyup="value=this.value.replace(/\D+/g,'')" id="game_frequency" type="text" value="<?php echo $rt['game_frequency'] ? $rt['game_frequency'] : '';?>"/>次&nbsp;&nbsp;&nbsp;<span class="game_frequency_mes"></span></td>
	  </tr>
	  <tr>
	  	<td class="label">挑战成功的分数</td>
	  	<td><input onkeyup="value=this.value.replace(/\D+/g,'')" id="success_score" type="text" value="<?php echo $rt['success_score'] ? $rt['success_score'] : '';?>"/>分&nbsp;&nbsp;&nbsp;<span class="success_score_mes"></span></td>
	  </tr>
	  <tr>
	  	<td class="label">每次答题的基本分数</td>
	  	<td><input onkeyup="value=this.value.replace(/\D+/g,'')" id="basic_score" type="text" value="<?php echo $rt['basic_score'] ? $rt['basic_score'] : '';?>"/>分&nbsp;&nbsp;&nbsp;<span class="basic_score_mes"></span></td>
	  </tr>
	  <tr>
	  	<td class="label">每次挑战成功奖励的礼物币</td>
	  	<td><input onkeyup="value=this.value.replace(/\D+/g,'')" id="success_gift_coin" type="text" value="<?php echo $rt['success_gift_coin'] ? $rt['success_gift_coin'] : '';?>"/>个&nbsp;&nbsp;&nbsp;<span class="success_gift_coin_mes"></span></td>
	  </tr>
	  <tr>
	  	<td class="label">总挑战次数</td>
	  	<td><input onkeyup="value=this.value.replace(/\D+/g,'')" id="sum_challenged" type="text" value="<?php echo $rt['sum_challenged'] ? $rt['sum_challenged'] : '';?>"/>次&nbsp;&nbsp;&nbsp;<span class="sum_challenged_mes"></span></td>
	  </tr>
	  
		<tr>
		<td class="label">备注说明:</td>
		<td><textarea name="remark" id="remark" style="width: 60%; height: 65px; overflow: auto;"><?php echo isset($rt['remark']) ? $rt['remark'] : '';?></textarea></td>
	  </tr>
	  <tr>
		<td class="label"></td>
		<td>
		<input name="btn_save" class="ads_save" value="<?php echo $type=='ads_edit' ? '修改' : '添加';?>保存" type="button">
		<input  type="hidden" class="pid" value="<?php echo isset($rt['pid']) ? $rt['pid'] : "";?>"/>
		</td>
	  </tr>
	 </table>
</div>
<?php $this->element('showdiv');?>
<?php  $thisurl = ADMIN_URL.'ads.php'; ?>
<script type="text/javascript">
	
//jQuery(document).ready(function($){
	$('.ads_save').click(function(){
// 		var tid = document.getElementById('game_name').value;
//		input.[name = '']
		a_name = $('#game_name').val();
		if(a_name=='undefined' || a_name==""){
			$('.game_name_mes').html("游戏名不能为空！");
			$('.game_name_mes').css('color','#FE0000');
			return false;
		}
		
		a_time = $('#game_time').val();
		if(a_time=='undefined' || a_time==""){
			$('.game_time_mes').html("挑战时间不能为空！");
			$('.game_time_mes').css('color','#FE0000');
			return false;
		}
		
		a_fre = $('#game_frequency').val();
		if(a_time=='undefined' || a_time==""){
			$('.game_frequency_mes').html("挑战次数不能为空！");
			$('.game_frequency_mes').css('color','#FE0000');
			return false;
		}
		
		a_ss_score = $('#success_score').val();
		if(a_time=='undefined' || a_time==""){
			$('.success_score_mes').html("挑战成功分数不能为空！");
			$('.success_score_mes').css('color','#FE0000');
			return false;
		}
		
		a_ba_score = $('#basic_score').val();
		if(a_time=='undefined' || a_time==""){
			$('.basic_score_mes').html("基本分数不能为空！");
			$('.basic_score_mes').css('color','#FE0000');
			return false;
		}
		
		a_coin = $('#success_gift_coin').val();
		if(a_time=='undefined' || a_time==""){
			$('.success_gift_coin_mes').html("奖励礼物币不能为空！");
			$('.success_gift_coin_mes').css('color','#FE0000');
			return false;
		}
		
		a_sum = $('#sum_challenged').val();
		if(a_time=='undefined' || a_time==""){
			$('.sum_challenged_mes').html("挑战次数不能为空！");
			$('.sum_challenged_mes').css('color','#FE0000');
			return false;
		}
		
		a_id = <?php echo $rt['game_id'] ? $rt['game_id'] : '';?>

		createwindow();
			$.post('<?php echo $thisurl;?>',{action:'addads',
				game_id:a_id,
				game_name:a_name,
				game_time:a_time,
				game_frequency:a_fre,
				success_score:a_ss_score,
				basic_score:a_ba_score,
				success_gift_coin:a_coin,
				sum_challenged:a_sum},function(data){
		removewindow();
			  if(data == ""){
			  		location.href='<?php echo $thisurl;?>?type=adslist';
			  }
			});
	});
	
	$('#tids').change(function(){
		// w = $('#cate_left').width(); alert(w);
		 text =  $("#tids").find("option:selected").text(); 
		 if(text=="文章分类广告"){
		 	$.post('<?php echo $thisurl;?>',{action:'getcateoption',type:'ac'},function(data){
				$('select[name="cat_id"]').html(data);
			});
		 	$('input[name="type"]').val('ac');
			$('.catelist').css('display','block');
		 }else if(text=="商品分类广告"){
		 	$.post('<?php echo $thisurl;?>',{action:'getcateoption',type:'gc'},function(data){
				$('select[name="cat_id"]').html(data);
			});
		 	$('input[name="type"]').val('gc');
			$('.catelist').css('display','block');
		 }else{
			$('.catelist').css('display','none');
		 }
		 //$('#cate_left').width(w);
		 //alert(text);
	});
//});


function setrun(url){
	$('input[name="ad_url"]').val(url);
}

function open_select_url(){
	JqueryDialog.Open('','<?php echo ADMIN_URL;?>selecturl.php',600,350,'frame');
	return false;
}

</script>