<div class="contentbox">
	<table cellspacing="2" cellpadding="5" width="100%">
	<tr>
		<th colspan="7" align="left">赞助商列表</th>
	</tr>
	<tr>
		<th width="60"><label><input type="checkbox" class="quxuanall" value="checkbox" />选择</label></th>
		<th>赞助商名称</th>
		<th>提供礼物</th>
		<th>提供礼物数量</th>
		<th>操作</th>
	</tr>
	<?php 
	if(!empty($businesslist)){
	    $i = 99;
	    foreach($businesslist as $row){
	    ?>
	<tr>
	<td><input type="checkbox" name="quanxuan" value="<?php echo $row['business_id'];?>" class="gids"/></td>
	<td><?php echo $row['business_name']?></td>
	<td>
    	<select onchange="getincept(this.id)" id="<?php echo $i?>">
    	<option value="ALL" id="<?php $row['business_id']?>">所有</option>
		<?php if(!empty($row['gift_info'])){
		          foreach( $row['gift_info'] as $gift_list ){?>
    		<option value="<?php echo $gift_list['gift_id']?>" id="<?php $row['business_id']?>"><?php echo $gift_list['gift_name']?></option>
    	<?php }}?>
    	</select>
	</td>
	<td><?php echo $row['gift_incept_sum']?></td>
	<td>
	<a href="goods.php?type=business_info&id=<?php $row['id']?>" title="编辑"><img src="<?php echo $this->img('icon_edit.gif');?>" title="编辑"/></a>&nbsp;
	<img src="<?php echo $this->img('icon_drop.gif');?>" title="删除" alt="删除" id="<?php echo $row['business_id']?>" class="delcateid"/>
	</td>
	</tr>
	<?php $i++;}}?>
	<tr>
		<td colspan="7"> <input type="checkbox" class="quanxuanall" value="checkbox"/>
			<input type="button" name="button" value="批量删除" disabled="disabled" class="bathdel" id="bathdel" />
		</td>
	</tr>

	</table>
</div>
<?php $thisurl = ADMIN_URL.'goods.php'; ?>
<script type="text/javascript">

function getincept(id){
	
   
	var myselect = document.getElementById(id);
	var index = myselect.selectedIndex;
	var giftid = myselect.options[index].value;

}

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
   		if(confirm("确定删除吗？将会删除下级分类及所在的商品！考虑清楚吗")){
			createwindow();
			var arr = [];
			$('input[name="quanxuan"]:checked').each(function(){
				arr.push($(this).val());
			});
			var str=arr.join('+'); 
			$.post('<?php echo $thisurl;?>',{action:'cate_dels',ids:str},function(data){
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
   
   $('.delcateid').click(function(){
   		ids = $(this).attr('id');
		thisobj = $(this).parent().parent();
		if(confirm("确定删除吗？将会删除分类下的文章！考虑清楚吗")){
			createwindow();
			$.post('<?php echo $thisurl;?>',{action:'cate_dels',ids:ids},function(data){
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
		cid = $(this).attr('id'); 
		type = $(this).attr('lang');
		obj = $(this);
		$.post('<?php echo $thisurl;?>',{action:'cate_active',active:star,cid:cid,type:type},function(data){
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
	
	//ajax排序处理
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
	   $.post('<?php echo $thisurl;?>',{action:'cate_sort',id:id,val:editval},function(data){ 
			 obj.html(editval);
           	 $(object).unbind('click');
           	 $(object).click(function(){
               edit(object);
             })
		});
    }
	
	function showhide(obj,a,b,c){
		a = parseInt(a);
		b = parseInt(b);
		c = parseInt(c);
		if(c>0){
			$(".tab"+c).toggle();
			if($(".tab"+c).css("display")=='none'){
				$(obj).html("[+]");
			}else{
				$(obj).html("[-]");
			}
			return false;
		}
		if(b>0){
			//$(".tab"+b).toggle();
			if($(".tab"+b).css("display")=='none'){
				$(obj).html("[-]");
				$(".tab"+b).show();
			}else{
				$(obj).html("[+]");
				$(".tab"+b).hide();
			}
			return false;
		}
		if(a>0){
			var t = $(obj).html();
			if(t=="[+]"){
				$(".tab"+a).hide();
				$(obj).html("[-]");
			}else{
				$(".tab"+a).show();
				$(obj).html("[+]");
			}
			return false;
		}
		return true;
	}

</script>




