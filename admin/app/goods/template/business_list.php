<div class="contentbox">
	<table cellspacing="2" cellpadding="5" width="100%">
	<tr>
		<th colspan="7" align="left">赞助商列表</th>
	</tr>
	<tr>
		<th>赞助商名称</th>
		<th>提供礼物</th>
		<th>提供礼物数量</th>
		<th>操作</th>
	</tr>
	<?php 
	if(!empty($businesslist)){
	    foreach($businesslist as $row){

	    ?>
	<tr>
	<td><?php echo $row['business_name']?></td>
	
	<select>
		<option value="<?php echo $row['gift_name']?>"><?php echo $row['gift_name']?></option>
	</select>
	
	<td><?php echo $row['gift_sum']?></td>
	<td>
	<a href="goods.php?type=business_info&id=<?php $row['id']?>" title="编辑"><img src="<?php echo $this->img('icon_edit.gif');?>" title="编辑"/></a>&nbsp;
	<img src="<?php echo $this->img('icon_drop.gif');?>" title="删除" alt="删除" id="<?php echo $row['business_id']?>" class="delcateid"/>
	</td>
	</tr>
	
	<?php }}?>
	
	<tr>
		<td colspan="7"> <input type="checkbox" class="quanxuanall" value="checkbox"/>
			<inpu type="button" name="button" value="批量删除" disabled="disabled" calss="bathdel" id="bathdel" />
		</td>
	</tr>

	</table>
</div>