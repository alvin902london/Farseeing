<div class="warehouses view">
<h2><?php echo __('Warehouse'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($warehouse['Warehouse']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($warehouse['Warehouse']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Remarks'); ?></dt>
		<dd>
			<?php echo h($warehouse['Warehouse']['remarks']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($warehouse['Warehouse']['created']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Warehouse'), array('action' => 'edit', $warehouse['Warehouse']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Warehouse'), array('action' => 'delete', $warehouse['Warehouse']['id']), array(), __('Are you sure you want to delete # %s?', $warehouse['Warehouse']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Warehouses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Warehouse'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Prices'), array('controller' => 'prices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Price'), array('controller' => 'prices', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Prices'); ?></h3>
	<?php if (!empty($warehouse['Price'])): ?>
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
	<?php foreach ($warehouse['Price'] as $price): ?>
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
