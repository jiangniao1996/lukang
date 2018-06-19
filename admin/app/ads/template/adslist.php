<?php  
$thisurl = ADMIN_URL.'ads.php'; 
if(isset($_GET['asc'])){
$adname = $thisurl.'?type=adslist&desc=tb1.ad_name';
$adname_img = $this->img('up_list.gif');
$adtag = $thisurl.'?type=adslist&desc=tb2.ad_name';
$ac = $thisurl.'?type=adslist&desc=tb1.is_show';
$dt = $thisurl.'?type=adslist&desc=tb1.addtime';
}else{
$adname = $thisurl.'?type=adslist&asc=tb1.ad_name';
$adname_img = $this->img('down_list.gif');
$adtag = $thisurl.'?type=adslist&asc=tb2.ad_name';
$ac = $thisurl.'?type=adslist&asc=tb1.is_show';
$dt = $thisurl.'?type=adslist&asc=tb1.addtime';
}
?>
<div class="contentbox">
     <table cellspacing="2" cellpadding="5" width="100%">
	 <tr>
		<th colspan="80" align="left">游戏列表</th>
	</tr>
    <tr>
	   <th><label><input type="checkbox" class="quxuanall" value="checkbox" />选择</label></th>
	   <th><a href="<?php echo $adname;?>">游戏名称</a></th>
	   <th><a href="<?php echo $adtag;?>">游戏时间</a><img src="<?php echo $adname_img;?>" align="absmiddle"/></th>
	   <th>每天能挑战的次数</th>
	   <th><a href="<?php echo $ac;?>">挑战成功的分数</a></th>
	   <th>每道题的基本分数</th>
	   <th>挑战成功奖励的礼物币</th>
	   <th>总挑战数</th>
	   <th><a href="<?php echo $dt;?>">时间</a></th>
	   <th>操作</th>
	</tr>
	<?php 
	if(!empty($gamelist)){ 
	foreach($gamelist as $row){
	?>
	<tr>
	<td><input type="checkbox" name="quanxuan" value="<?php echo $row['game_id'];?>" class="gids"/></td>
	<td><?php echo $row['game_name'];?></td>
	<td><?php echo $row['game_time'];?></td>
	<td><?php echo $row['game_frequency'];?></td>
	<td><?php echo $row['success_score'];?></td>
	<td><?php echo $row['basic_score'];?></td>
	<td><?php echo $row['success_gift_coin'];?></td>
	<td><?php echo $row['sum_challenged'];?></td>
    <td><?php echo $row['timestamp'];?></td>
	<td>
	<a href="ads.php?type=ads_edit&id=<?php echo $row['game_id'];?>" title="编辑"><img src="<?php echo $this->img('icon_edit.gif');?>" title="编辑"/></a>&nbsp;
	<img src="<?php echo $this->img('icon_drop.gif');?>" title="删除" alt="删除" id="<?php echo $row['game_id'];?>" class="delads"/>
	</td>
	</tr>
	<?php } ?>
	<tr>
		 <td colspan="80"> <input type="checkbox" class="quxuanall" value="checkbox" />
			  <input type="button" name="button" value="批量删除" disabled="disabled" class="bathdel" id="bathdel"/>
		 </td>
	</tr>
		<?php } ?>
	 </table>
	 <?php $this->element('page',array('pagelink'=>$pagelink));?>
</div>
<?php $this->element('showdiv');?>
<script type="text/javascript">
//全选
 $('.quxuanall').click(function (){
      if(this.checked==true){
         $("input[name='quanxuan']").each(function(){this.checked=true;});
		 document.getElementById("bathdel").disabled = false;
	  }else{
	     $("input[name='quanxuan']").each(function(){this.checked=false;});
		 document.getElementById("bathdel").disabled = true;
	  }
  });
  
  //是删除按钮失效或者有效
  $('.gids').click(function(){ 
  		var checked = false;
  		$("input[name='quanxuan']").each(function(){
			if(this.checked == true){
				checked = true;
			}
		}); 
		document.getElementById("bathdel").disabled = !checked;
  });
  
  //批量删除
   $('.bathdel').click(function (){
   		if(confirm("确定删除吗？")){
			createwindow();
			var arr = [];
			$('input[name="quanxuan"]:checked').each(function(){
				arr.push($(this).val());
			});
			var str=arr.join('+'); 
			$.post('<?php echo $thisurl;?>',{action:'delads',pids:str},function(data){
				removewindow();
				if(data == ""){
					location.reload();
				}else{
					alert(data);
				}
			});
		}else{
			return false;
		}
   });
   
   $('.delads').click(function(){

		id = $(this).attr('id');
		thisobj = $(this).parent().parent();
		if(confirm("确定删除吗？")){
			createwindow();
			$.post('<?php echo $thisurl;?>',{action:'delads',game_id:id},function(data){
				removewindow();
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
   
   	$('.activeop').live('click',function(){
		star = $(this).attr('alt');
		pid = $(this).attr('id'); 
		obj = $(this);
		$.post('<?php echo $thisurl;?>',{action:'activeadsop',active:star,pid:pid},function(data){
			if(data == ""){
				if(star == 1){
					id = 0;
					src = '<?php echo $this->img('yes.gif');?>';
				}else{
					id = 1;
					src = '<?php echo $this->img('no.gif');?>';
				}
				obj.attr('src',src);
				obj.attr('alt',id);
			}else{
				alert(data);
			}
		});
	});
	
	$('.vieworder').click(function (){ edit(this); });
	
	function edit(object){
		thisvar = $(object).html();
		ids = $(object).attr('id');
		if(!(thisvar>0)){
			thisvar = 50;
		}
		//$(object).css('background-color','#FFFFFF');
		 if(typeof($(object).find('input').val()) == 'undefined'){
             var input = document.createElement('input');
			 $(input).attr('value', thisvar);
			 $(input).css('width', '25px');
             $(input).change(function(){
                 update(ids, this)
             })
             $(input).blur(function(){
                 $(this).parent().html($(this).val());
             });
             $(object).html(input);
             $(object).find('input').focus();
         }
	}
	
	function update(id, object){
       var editval = $(object).val();
       var obj = $(object).parent();
	   $.post('<?php echo $thisurl;?>',{action:'ajax_ads_vieworder',id:id,val:editval},function(data){ 
			 obj.html(editval);
           	 $(object).unbind('click');
           	 $(object).click(function(){
               edit(object);
             })
		});
    }
	
</script>