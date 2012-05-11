<?php 
echo $this->Html->css('/cc_octoland/css/style');
?>
<h1><?php echo __d('cc_octoland', 'Octoland');?></h1>
<table>
	<tr>
<?php $i = 0; ?>
<?php foreach ( $images as $id => $row): ?>
	<td style="text-align:center; border: #333 solid 1px; padding:10px">
		<?php echo $this->Html->image(
		'/cc_octoland/img/' . $row['img'],
		array(
			'width' => '140',
			'height' => '140',
			'class' => 'sticker'
		)
	);?><br/><strong><?php echo $row['name']?></strong></td>
<?php
	$i++;
	if ($i == 4) {
		echo '</tr><tr>';
	}
?>
<?php endforeach; ?>
	</tr>
</table>

<?php
	echo $this->Form->create(null, array( 'action' => 'gacha'));
	echo $this->Form->submit(
		__d('cc_octoland', 'Get Octocat'),
		array('style' => 'width:600px; height:100px;')
	);
	echo $this->Form->end();
?>

<h3><?php
   echo __d('cc_octoland', 'Amount uou spent:') . $count * 100;
?></h3>