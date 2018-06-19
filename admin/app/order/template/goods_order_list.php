<?php
$thisurl = ADMIN_URL.'goods_order.php'; 
if(isset($_GET['asc'])){
$oi = $thisurl.'?type=list&desc=order_id&w='.$w;
$ui = $thisurl.'?type=list&desc=user_id';
$os = $thisurl.'?type=list&desc=order_sn';
$tprice = $thisurl.'?type=list&desc=goods_amount';
$own = $thisurl.'?type=list&desc=delivery_name';
$gi = $thisurl.'?type=list&desc=gift_id&w='.$w;
$dt = $thisurl.'?type=list&desc=TIMESTAMP&w='.$w;
}else{
$oi = $thisurl.'?type=list&asc=order_id&w='.$w;
$ui = $thisurl.'?type=list&asc=user_id';
$os = $thisurl.'?type=list&asc=order_sn';
$tprice = $thisurl.'?type=list&asc=goods_amount';
$own = $thisurl.'?type=list&asc=delivery_name';
$gi = $thisurl.'?type=list&asc=gift_id&w='.$w;
$dt = $thisurl.'?type=list&asc=TIMESTAMP&w='.$w;
}
?>
<div class="contentbox">

     <table cellspacing="2" cellpadding="5" width="100%">
	 <tr>
	   <th colspan="70" align="left">订单列表&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		选择时间：<input type="text" id="EntTime1" name="EntTime1" onclick="return showCalendar('EntTime1', 'y-mm-dd');"  />
		至
		<input type="text" id="EntTime2" name="EntTime2" onclick="return showCalendar('EntTime2', 'y-mm-dd');"  />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;导出当前列表的:
		<input type="text" name="pagestart" size="5" value="1" />页至
		<input type="text" name="pageend" size="5" value="50" />页&nbsp;&nbsp;
		<label>
		<input type="submit" value="确认导出" style="cursor:pointer; padding:3px;" onclick="ajax_import_order_data(this)" />
		</label>
		</th>
		
	</tr>
	<tr><th colspan="70" align="left">
    	<img src="<?php echo $this->img('icon_search.gif');?>" alt="SEARCH" width="26" border="0" height="22" align="absmiddle">
		订单号<input name="order_sn"  size="15" type="text" value="<?php echo isset($_GET['order_id']) ? $_GET['order_id'] : "";?>">
		收货人<input name="consignee"  size="15" type="text" value="<?php echo isset($_GET['delivery_name']) ? $_GET['delivery_name'] : "";?>">
		用户ID<input name="user_id" size="15" type="text" value="<?php echo isset($_GET['user_id']) ? $_GET['user_id'] : "";?>">
		订单状态 
		<?php 
		$status_option[2] = '请选择';
// 		$status_option[11] = '待确认';
// 		$status_option[200] = '待付款';
		$status_option[0] = '待发货';
		$status_option[1] = '已发货';
// 		$status_option[214] = '已完成';
// 		$status_option[1] = '取消';
// 		$status_option[4] = '无效';
// 		$status_option[3] = '退货';
// 		$status_option[2] = '退款';
		?>  
		 <select name="status" >
		 <!--2:确认订单 0:没支付 0:没发货-->
	        <?php 
			$se = 'selected="selected"';
			foreach($status_option as $k=>$var){
				echo '<option value="'.$k.'" '.($k==$_GET['status']&&isset($_GET['status']) ? $se : "").'>'.$var.'</option>';
			}
			?>
		  </select>
		<input value=" 搜索 " class="order_search" type="button">
		<a href="goods_order.php?type=list&status=2x0">待发货</a>
		<a href="goods_order.php?type=list&status=222">已发货</a>
	</th></tr>
    <tr>
	   <th width="80"><label><input type="checkbox" class="quxuanall" value="checkbox" />选择</label></th>
	   <th><a href="<?php echo $oi;?>">订单号</a></th>
	   <th><a href="<?php echo $ui?>">用户id</a></th>
	   <th><a href="<?php echo $dt;?>">下单时间</a></th>
	   <th><a href="<?php echo $own;?>">收货人</a></th>
	   <th><a href="<?php echo $gi;?>">礼物</a></th>
	   <th>订单状态</th>
	   <th>操作</th>
	</tr>
	<?php 
	if(!empty($orderlist)){
	foreach($orderlist as $row){

	?>
	<tr>
	<td><input type="checkbox" name="quanxuan" value="<?php echo $row['order_id'];?>" class="gids"/></td>
	<td><?php echo $row['order_id'];?></td>
	<td><?php echo $row['user_id']?></td>
	<td><?php echo $row['TIMESTAMP'];?></td>
	<td><font color="#FF0000"></font><?php echo $row['delivery_name'];?></td>
	<td><?php echo $row['gift_name'];?></td>
	<td><?php  echo $row['state'] == 1 ? '已发货 &nbsp;<font color=blue>&nbsp;[' .$row['shipping_name']. ']物流单：<a style="color:#fe0000"  href="http://m.kuaidi100.com/index_all.html?postid='.$row['sn_id'].'"target="_blank">'.$row['sn_id'].'</a></font>' : "未发货";?></td>
	<td>
	<a href="goods_order.php?type=order_info&id=<?php echo $row['order_id'];?>" title="编辑"><img src="<?php echo $this->img('icon_view.gif');?>" title="编辑"/></a>&nbsp;
	
	<?php if(in_array($row['state'],array('0','1','2'))){?><img src="<?php echo $this->img('icon_drop.gif');?>" title="删除" alt="删除" id="<?php echo $row['order_id'];?>" class="delorder"/><?php } ?>
	<button onclick="return printorder('<?php echo $row['order_id']?>')" style="cursor:pointer; padding:2px 4px 2px 4px; background-color:#ededed; border:1px solid #ccc;border-radius:5px;<?php echo $row['is_print']=='1' ? 'color:#330066':'color:#FE0000';?>">打印</button>
	</td>
	</tr>
	<?php
	 } ?>
	<tr>
		 <td colspan="70"> 
		 	<input type="checkbox" class="quxuanall" value="checkbox" />
			    <input name="button" id="bathconfirm" value="确认" class="bathop" disabled="true"  type="button"/>
				<input name="button" id="bathinvalid" value="无效" class="bathop" disabled="true" type="button"/>
				<input name="button" id="bathcancel" value="取消" class="bathop" disabled="true" type="button"/>
				<input name="button" id="bathdel" value="移除"  class="bathop" disabled="true" type="button"/>
			    <input name="button" id="printorder" value="打印"  class="printorder" disabled="true" type="button" onclick="return printorder()" style="cursor:pointer"/>
		 </td>
	</tr>
		<?php } ?>
	 </table>
	 <?php $this->element('page',array('pagelink'=>$pagelink));?>
</div>
<script type="text/javascript">
function ajax_import_order_data(obj){
	
	ps = $('input[name="pagestart"]').val();

	pe = $('input[name="pageend"]').val();

	time1 = $('input[name="EntTime1"]').val();  //look 添加
	
	time2 = $('input[name="EntTime2"]').val();	//look 添加
	
	o_sn = $('input[name="order_sn"]').val();
	
	own = $('input[name="consignee"]').val();

	u_id = $('input[name="user_id"]').val();
	
	sts = $('select[name="status"]').val();

	o_by = '<?php echo $orderby; ?>';

	//w_w = '<?php echo $w; ?>';

	
	window.open('<?php echo ADMIN_URL;?>goods_order.php?type=ajax_import_order_data&pagestart='+ps+'&pageend='+pe+'&order_id='+o_sn+'&delivery_name='+own+'&state='+sts+'&orderby='+o_by+'&time1='+time1+'&time2='+time2+'&user_id='+u_id);
}

//全选
 $('.quxuanall').click(function (){
      if(this.checked==true){
         $("input[name='quanxuan']").each(function(){this.checked=true;});
		 document.getElementById("bathdel").disabled = false;
		 document.getElementById("bathinvalid").disabled = false;
		 document.getElementById("bathcancel").disabled = false;
		 document.getElementById("bathconfirm").disabled = false;
		 document.getElementById("printorder").disabled = false;
	  }else{
	     $("input[name='quanxuan']").each(function(){this.checked=false;});
		 document.getElementById("bathdel").disabled = true;
		 document.getElementById("bathinvalid").disabled = true;
		 document.getElementById("bathcancel").disabled = true;
		 document.getElementById("bathconfirm").disabled = true;
		 document.getElementById("printorder").disabled = true;
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
		document.getElementById("bathconfirm").disabled = !checked;
		document.getElementById("bathcancel").disabled = !checked;
		document.getElementById("bathinvalid").disabled = !checked;
		document.getElementById("printorder").disabled = !checked;
  });
  
  //批量删除
   $('.bathop').click(function (){
   		if(confirm("确定操作吗？")){
			optype = $(this).attr('id');
			if(typeof(optype)=='undefined' || optype==""){ return false;}
			createwindow();
			var arr = [];
			$('input[name="quanxuan"]:checked').each(function(){
				arr.push($(this).val());
			});
			var str=arr.join('+'); ;
			$.post('<?php echo $thisurl;?>',{action:'bathop',type:optype,ids:str},function(data){
				removewindow();
				if(data == ""){
					location.reload();
				}else{
					alert(data);
					//location.reload();
				}
			});
		}else{
			return false;
		}
   });
 
   $('.delorder').click(function(){
   		ids = $(this).attr('id');
		thisobj = $(this).parent().parent();
		if(confirm("确定删除吗？")){
			createwindow();
			$.post('<?php echo $thisurl;?>',{action:'bathop',type:'bathdel',ids:ids},function(data){
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
		gid = $(this).attr('id'); 
		type = $(this).attr('lang');
		obj = $(this);
		$.post('<?php echo $thisurl;?>',{action:'activeop',active:star,gid:gid,type:type},function(data){
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
	
	//搜索
	$('.order_search').click(function(){
		
		time1 = $('input[name="EntTime1"]').val();  //look 添加
		
		time2 = $('input[name="EntTime2"]').val();	//look 添加
		
		o_sn = $('input[name="order_sn"]').val();
		
		own = $('input[name="consignee"]').val();

		u_id = $('input[name="user_id"]').val();
		
		sts = $('select[name="status"]').val();
		
		
		location.href='<?php echo $thisurl;?>?type=list&time1='+time1+'&time2='+time2+'&order_id='+o_sn+'&delivery_name='+own+'&state='+sts+'&user_id='+u_id;
	});
	
	
	//打印订单
	function printorder(order_id){
		if(confirm("你确定打印吗？点击按钮之后将会更改为已打印状态！")){
			var arr = [];
			$('input[name="quanxuan"]:checked').each(function(){
				arr.push($(this).val());
			});
			var str1 = arr.join('-');
			//window.location.href = '<?php echo ADMIN_URL;?>goods_order.php?type=orderprint&ids='+str;

			var str2 = order_id;

			//如果多选不为空，则打印多选，否则打印单选
			if(str1.length == 0){
			$.get('<?php echo ADMIN_URL.'cuxiao.php';?>',{type:'order_erweima',ids:str2},function(data){
				if(data !=""){
					console.log(data);
				}

			});
			window.open('<?php echo ADMIN_URL;?>goods_order.php?type=orderprint&ids='+str2);
			}else{
				$.get('<?php echo ADMIN_URL.'cuxiao.php';?>',{type:'order_erweima',ids:str1},function(data){
				if(data !=""){
					console.log(data);
				}
			});
			window.open('<?php echo ADMIN_URL;?>goods_order.php?type=orderprint&ids='+str1);
			}
		}
		return false;
	}

</script>