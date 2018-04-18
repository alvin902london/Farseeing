<div class="companies view">
<h2><?php echo __('Company'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($company['Company']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($company['Company']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Remarks'); ?></dt>
		<dd>
			<?php echo h($company['Company']['remarks']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Company'), array('action' => 'edit', $company['Company']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Company'), array('action' => 'delete', $company['Company']['id']), array(), __('Are you sure you want to delete # %s?', $company['Company']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Companies'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Prices'), array('controller' => 'prices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Price'), array('controller' => 'prices', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Prices'); ?></h3>
	<?php if (!empty($company['Price'])): ?>
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
	<?php foreach ($company['Price'] as $price): ?>
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
