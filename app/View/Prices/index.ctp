<div class="prices index">
	<h2><?php echo __('Prices'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tbody>
		<tr>
			<?php echo $this->Form->create('Price'); ?>
			<th><?php echo $this->Form->input('company_id', array('empty' => 'Please select')); ?></th>
			<th><?php echo $this->Form->input('date', array('empty' => 'Please select')); ?></th>			
			<th><?php echo $this->Form->end(__('Submit')); ?></th>
		</tr>
	</tbody>
	</table>	
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
		<th><?php echo $this->Paginator->sort('Product'); ?></th>
		<th><?php echo $this->Paginator->sort('Price'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php if (!empty($prices)) { $prices = sort_prices($prices); } ?>
	<?php foreach ($prices as $price): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($price['Company']['name'], array('controller' => 'companies', 'action' => 'view', $price['Company']['id'])); ?>&nbsp;
			<?php echo $this->Html->link($price['Product']['Country']['name'], array('controller' => 'countries', 'action' => 'view', $price['Product']['Country']['id'])); ?>&nbsp;
			<?php echo $this->Html->link($price['Product']['Brand']['name'], array('controller' => 'brands', 'action' => 'view', $price['Product']['Brand']['id'])); ?>&nbsp;

			<?php echo $this->Html->link($price['Product']['Category']['name'], array('controller' => 'categories', 'action' => 'view', $price['Product']['Category']['id'])); ?>&nbsp;

			<?php foreach ($price['Product']['Feature'] as $feature) {
				if ($feature['ProductsFeature']['id'] <= 70000) {
					echo $this->Html->link($feature['name'], array('controller' => 'features', 'action' => 'view', $feature['id'])) . '&nbsp;';
				} else {
					echo $feature['name'] . '&nbsp;';
				}
			} ?>
		</td>
		<td width = 30%>
		<?php foreach ($price['Warehouse'] as $key => $val) {
			$location[] = $val['name'];
		}
		$locations = implode(', ', $location);
		$location = array();
		?>
		<?php if ($price['Price']['is_cleared'] == '1') {
			echo '<s>' . h($price['Price']['price']) . $price['Unit']['name'] . '&nbsp;' . $locations . '(' . h($price['Price']['date']) . ')</s>' . '&nbsp;' . __('清');
		} else {
			echo h($price['Price']['price']) . $price['Unit']['name'] . '&nbsp;' . $locations . '&nbsp;(' . h($price['Price']['date']) . ')';
		}
		?></td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $price['Price']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $price['Price']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $price['Price']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $price['Price']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Price'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Companies'), array('controller' => 'companies', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Company'), array('controller' => 'companies', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Units'), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit'), array('controller' => 'units', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Warehouses'), array('controller' => 'warehouses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Warehouse'), array('controller' => 'warehouses', 'action' => 'add')); ?> </li>
	</ul>
</div>
