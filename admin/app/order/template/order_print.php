<style type="text/css">
body{padding:10px; background:#FFF}
body,td {font-size:13px;}
p{ height:22px; line-height:22px; margin:0px; padding:0px}
</style>
<?php
function format_price($price=0){
	if(empty($price)) return '0.00';
	return number_format($price, 2, '.', '');
}
?>
<?php if(!empty($orderlist))foreach($orderlist as $row){?>
<table width="100%" border="1" style="border-collapse:collapse;border-color:#333;">
	<tr>
		<td style="padding-left:2px;padding-bottom:5px;" valign="middle" colspan="2"><!--<img src="<?php echo $this->img('logo.png');?>" />--><b style="font-weight:bold; font-size:22px;">商品发货单</b></td>
		<td style="font-size:20px; font-weight:bold;padding-bottom:5px;" valign="middle">订单号：<?php echo $row['order_id'];?></td>
		<td align="center"><?php echo "<img src=http://localhost:8080/shopping/photos/order_erweima/".$row['order_id']."/1.png />"; ?><br/><?php echo $row['order_id'];?></td>
	</tr>
	<tr>
		<td colspan="5" style="padding:5px; text-align:left">
		<!--<p>如你有任何疑问，请根据以下信息与我们联系；</p>-->
		<p>微信：<?php echo $rts['site_name'];?></p>
		<p>公司地址：<?php echo $rts['company_url'];?><!--&nbsp;&nbsp;电话：<?php echo implode(',',$rts['custome_phone']);?>&nbsp;&nbsp;邮箱：<?php echo $rts['custome_email'];?></p>-->
		</td>
	</tr>
</table>

<?php 
$ab = array_slice($item,0,1);
$abc = $ab[0];
unset($ab);
?>
<p style="border-left:1px solid #333;border-right:1px solid #333;height:16px;"></p>
<table width="100%" border="1" style="border-collapse:collapse;border-color:#333;">
    <tr>
        <td width="11%">客户</td>
    	<td><?php echo $row['delivery_name']; ?></td>
        <td>收货人</td>
    	<td><?php echo $row['delivery_name']; ?></td>
        <td>收货地址</td>
        <td><?php echo $row['delivery_address'];?></td>
		
    </tr>
    <tr>
        <td>收货人联系手机</td>
        <td><?php echo $row['delivery_phone'];?></td>
        <td>下单时间</td>
        <td><?php echo date('Y-m-d H:i:s', $row['TIMESTAMP']);?></td>
        <td>订单备注</td>
        <td><?php echo $row['delivery_tips'];?></td>
    </tr>

</table>

<p style="border-left:1px solid #333;border-right:1px solid #333; height:16px;"></p>
<table width="100%" border="1" style="border-collapse:collapse;border-color:#333;">
    	<tr align="center">
			  <th bgcolor="#cccccc">礼物ID</th>
			  <th bgcolor="#cccccc">礼物名称</th>
<!-- 			  <th bgcolor="#cccccc">规格</th> -->
<!-- 			  <th bgcolor="#cccccc">优惠价</th> -->
			  <th bgcolor="#cccccc">礼物数量</th>
<!-- 			  <th bgcolor="#cccccc">小计</th> -->
		 </tr>
		 <?php
// 		  if(!empty($item)){
// 		  $total= 0;
// 		  $jifen_total = 0;
// 		  foreach($item as $k=>$rows){
		  
// 		  $stotal = $rows['goods_amount']; //每个单子的总价
// 		  $totaloff = $rows['offprice']; //每个单子的总折扣价

// 			  $zgoods = 0;
// 		  	  if(!empty($rows['goods']))foreach($rows['goods'] as $kk=>$row){
// 				  if($row['from_jifen'] > 0){
// 					$jifen_total +=$row['from_jifen'];
// 				  }else{
// 					$total +=$row['goods_price']*$row['goods_number'];
// 				  }
// 				  $zgoods += $row['goods_price']*$row['goods_number'];
// 		  ?>
		<?php if(!empty($row['gift'])) foreach ($row['gift'] as $gift){?>
		 <tr>
		 	  <td align="center"><?php echo $gift['gift_id'];?></td>
			  <td align="center"><?php echo $gift['gift_name'];?></td>
			  <td align="center" style="padding-left:5px;"><?php echo $gift['gift_num']?></td>
			  
			  <!--<td align="center"><?php echo $row['goods_attr'];?></td> -->
			  <!--<td align="center">￥<?php echo $row['goods_price'];?></td> -->
			  <!--<td align="center"><?php echo $row['goods_number'].' '.$row['goods_unit'];?></td> -->
			  <!--<td align="center">￥<?php echo $row['goods_price']*$row['goods_number']; if($row['from_jifen']>0) echo '&nbsp;&nbsp;<font color="red">[积分换取商品]</font>';?></td> -->
		   </tr>
		 <?php }
 		 ?>
		
<!--		 <tr>
				<td colspan="6" align="right">供应商会员号：<font color="red" style="font-size:14"><?php echo $rows['suppliers_id'];?></font>&nbsp;&nbsp;&nbsp;&nbsp;</td>
		</tr>
		<tr>
				<td colspan="6" align="right" style="padding-right:22px">实际支付: <font color="#FF0000">￥<?php echo format_price($zgoods-$p2);?></font></td>
		</tr>-->
		 <tr><td colspan="6">&nbsp;</td></tr>
		 <?php
// 		  }?>
		<tr>
		  <td colspan="6">
		  礼物总计: <font color="#FF0000"><?php 
		  if(!empty($row['gift']))
		      foreach( $row['gift'] as $gift){
		          echo $gift['gift_name']."×".$gift['gift_num']."&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		  }
		  ?></font>
		  </td>
		</tr>
	<?php 
// 	}
// 	?>
</table>
<table width="100%" border="0">
    <tr align="right"><!-- 订单操作员以及订单打印的日期 -->
        <td>打印时间：<?php echo date('Y-m-d H:i:s',mktime());?>&nbsp;&nbsp;&nbsp;操作者：<?php echo $this->Session->read('adminname');?></td>
    </tr>
</table>
<p style="height:20px"></p>
<?php } ?>
<script type="text/javascript">
function load_suppliers_address(sid,obj){
	/*$.post('<?php echo SITE_URL;?>user.php',{action:'get_suppliers_address',suppliers_id:sid},function(data){
		$(obj).parent().html(data);
	});
	return false;*/
}
</script>