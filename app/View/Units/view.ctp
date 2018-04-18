<div class="units view">
<h2><?php echo __('Unit'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($unit['Unit']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($unit['Unit']['name']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Unit'), array('action' => 'edit', $unit['Unit']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Unit'), array('action' => 'delete', $unit['Unit']['id']), array(), __('Are you sure you want to delete # %s?', $unit['Unit']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Units'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Prices'), array('controller' => 'prices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Price'), array('controller' => 'prices', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Prices'); ?></h3>
	<?php if (!empty($unit['Price'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Company Id'); ?></th>
		<th><?php echo __('Product Id'); ?></th>
		<th><?php echo __('Price'); ?></th>
		<th><?php echo __('Unit Id'); ?></th>
		<th><?php echo __('Date'); ?></th>
		<th><?php echo __('Is Cleared'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($unit['Price'] as $price): ?>
		<tr>
			<td><?php echo $price['id']; ?></td>
			<td><?php echo $price['company_id']; ?></td>
			<td><?php echo $price['product_id']; ?></td>
			<td><?php echo $price['price']; ?></td>
			<td><?php echo $price['unit_id']; ?></td>
			<td><?php echo $price['date']; ?></td>
			<td><?php echo $price['is_cleared']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'prices', 'action' => 'view', $price['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'prices', 'action' => 'edit', $price['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'prices', 'action' => 'delete', $price['id']), array(), __('Are you sure you want to delete # %s?', $price['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Price'), array('controller' => 'prices', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
