<style type="text/css">
.order_basic table td{ border:1px solid #F4F6F1; }
.order_basic td p{background:#F5F7F2; text-align:center; line-height:25px; font-size:13px; font-weight:bold; margin-bottom:0px; margin-top:0px}
</style>
<div class="contentbox">
<div class="openwindow"><img src="<?php echo $this->img('loading.gif');?>"  align="absmiddle"/><br />正在操作，请稍后。。。</div>
<table cellspacing="2" cellpadding="5" width="100%" class="order_basic">
	 <tr>
		<th align="left">订单详情列表</th>
	</tr>
	<tr>
		<td>
		<p>基本信息</p>
		</td>
	</tr>
	<tr>
		<td>
		<table cellspacing="0" cellpadding="0" width="100%">
			<tr>
				<td class="label" width="15%">订单号：</td>
				<td width="35%" id="order_id"><?php echo $rt['orderinfo']['order_id'];?></td>
				<td class="label" width="15%">订单状态：</td>
				<td width="35%"><?php echo $rt['orderinfo']['state'];?></td>
			</tr>
			<tr>
				<td class="label" width="15%">下单时间：</td>
				<td width="35%"><?php echo !empty($rt['orderinfo']['TIMESTAMP']) ? date('Y-m-d H:i:s',$rt['orderinfo']['TIMESTAMP']) : '未知';?></td>
				<td class="label" width="15%">物流信息:</td>
				<td>
				<select name="shopping_id" id="shopping_id">
            	<option value="0">选择物流</option>
            	<?php if(!empty($shoppinglist))foreach($shoppinglist as $item){?>
            	<option value="<?php echo $item['shipping_id'];?>"<?php if($item['shipping_id']==$rt['orderinfo']['shipping_id_true']){ echo ' selected="selected"';} ?>><?php echo $item['shipping_name'];?></option>
            	<?php } ?>
            	</select>
            	</td>
				<td width="35%"><input id="sn_id" type="text" value="<?php echo !empty($rt['orderinfo']['sn_id']) ? $rt['orderinfo']['sn_id'] : '未发货'?>" onblur="setSnid(this.value)"></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>
		<p>收货人信息</p>
		</td>
	</tr>
	<tr>
		<td>
		<table cellspacing="0" cellpadding="0" width="100%" class="order_basic">
			<tr>
				<td class="label" width="15%">收货人：</td>
				<td width="35%"><a href="user.php?type=userress&id=<?php echo $rt['orderinfo']['user_id'];?>" style="color:#FE0000" title="查看详情"><?php echo $rt['orderinfo']['delivery_name'];?></a></td>
				
				<td class="label" width="15%">货运贴士：</td>
				<!-- <td width="35%"><?php echo $rt['orderinfo']['shipping_name'];?></td> -->
				<td width="35%"><?php echo $rt['orderinfo']['delivery_tips'];?></td>
			</tr>
			<tr>
				<td class="label" width="15%"><?php echo $rt['orderinfo']['shipping_id']=='6' ? '提货店址' : '收货地址';?>：</td>
				<td width="35%"><?php echo $rt['orderinfo']['delivery_address'];?></td>
				<td class="label" width="15%">电话|手机：</td>
				<td width="35%"><?php echo $rt['orderinfo']['delivery_phone'];?><?php echo $rt['orderinfo']['mobile'];?></td>
			</tr>
		</table>
		</td>
	</tr>
	<tr>
		<td>
		<p>礼物信息</p>
		</td>
	</tr>
	<tr>
		<td>
		<table cellspacing="0" cellpadding="0" width="100%" >
			<tr align="center" >
				<td ><strong>礼物ID</strong></td>
				<td ><strong>礼物名称</strong></td>
				<td><strong>数量</strong></td>
			</tr>
			<?php if(!empty($rt['ordergoods'])){
			         foreach($rt['ordergoods'] as $row){ 
			?>
			<tr align="center">
				<td><?php echo $row['gift_id'];?></td>
				<td><?php echo $row['gift_name'];?></td>
				<td><?php echo $row['gift_num'];?></td>
				<td><a href="<?php echo SITE_URL;?>goods.php?id=<?php echo $row['goods_id'];?>" target="_blank"><?php echo $row['goods_name'].(!empty($row['brand_name']) ? '['.$row['brand_name'].']' : '').'</a>'.(!empty($row['buy_more_best']) ? '<br /><em>实行<font style="color:#FE0000;font-weight:bold">['.$row['buy_more_best'].']</font>促销活动！</em>' : '');?></a></td>				
			</tr>
			<?php } ?>
			<?php }  ?>
		</table>
		</td>
	</tr>
		<tr>
		<td>
		<p>操作信息</p>
		</td>
	</tr>
	<tr>
		<td>
		<table cellspacing="0" cellpadding="0" width="100%">
<!-- 		<tr> -->
<!-- 			<td width="15%">		 -->
<!-- 			<strong>操作备注:</strong> -->
<!-- 			</td> -->
<!-- 			<td> -->
<!-- 			<textarea name="action_note" cols="80" rows="3"></textarea> -->
<!-- 			</td> -->
<!-- 		</tr> -->
		<tr>
			<td width="15%"><strong>当前可执行操作:</strong></td>
			<td id="get_button">
			<?php echo $rt['order_action_button'];?>
			 <!--<input name="confirm" value="确认" class="confirm_order" type="button">
			 <input name="remove" value="移除" class="remove_order" onclick="return window.confirm('删除订单将清除该订单的所有信息。您确定要这么做吗？');" type="submit">
             <input name="order_id" value="18" type="hidden">-->
			</td>
		</tr>
		<?php if($rt['orderinfo']['orderdesc']){?>
		<tr>
			<td width="15%"><strong>退款信息:</strong></td>
			<td align="left">
			<p style="text-align:left; color:#FF0000"><?php echo $rt['orderinfo']['orderdesc'];?></p>
			<p style="text-align:left; color:#FF0000"><?php echo $rt['orderinfo']['ordertxt'];?></p>
			</td>
		</tr>
		<?php } ?>
		</table> 
		</td>
	</tr>
	<tr>
		<td id="action_list">
		<?php $this->element('goods_order_action_ajax',array('action_info'=>$rt['action_info']));?>
		</td>
	</tr>
</table>
</div>
<?php  $thisurl = ADMIN_URL.'goods_order.php'; ?>

<script type="text/javascript">

/*$.ajax({
   type: "POST",
   url: "<?php echo $thisurl;?>",
   data: "action=op_status&opstatus=" + opstatus + "&opremark=" + opremark + "&opid=" + id,
   dataType: "json",
   success: function(data){
		if (data.err_msg == 0)
		{
		  var layer = document.getElementById('RECOMEND_GOODS');
		  if (layer)
		  {
			layer.innerHTML = data.result;
		  }
		}
   }
}); //end ajax
*/


$('.order_action').live('click',function(){
	createwindow();
	opstatus = $(this).attr('id');

	opremark = $("textarea[name='action_note']").val();
	
	id = '<?php echo $_REQUEST['id'];?>';//订单号

//	order_id = '<?php echo $rt['orderinfo']['order_id'];?>';
	
	$.post('<?php echo $thisurl;?>',{action:'op_status',opstatus:opstatus,opremark:opremark,opid:id},function(data){
		$("textarea[name='action_note']").val("");
		if(data !=""){
			$.post('<?php echo $thisurl;?>',{action:'get_status_button',status:opstatus},function(datas){
				if(datas !=""){
					$("#get_button").html("")
					$("#get_button").html(datas)
				}
			});
			$("#action_list").html("")
			//$('#action_list').html(data);
			$("#action_list").html(data)
		}else{
			alert("操作失败！");
		}
		removewindow();

	});
});

function setSnid(sn_id){

	o_id = document.getElementById("order_id").innerText;
	var ship_id = document.getElementById("shopping_id").value;
	
	
	$.post('<?php echo $thisurl;?>',{action:'updatesnid',order_id:o_id,sn_id:sn_id,ship_id:ship_id});
}















</script>