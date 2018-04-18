<div class="pricesWarehouses view">
<h2><?php echo __('Prices Warehouse'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($pricesWarehouse['PricesWarehouse']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Price'); ?></dt>
		<dd>
			<?php echo $this->Html->link($pricesWarehouse['Price']['id'], array('controller' => 'prices', 'action' => 'view', $pricesWarehouse['Price']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Warehouse'); ?></dt>
		<dd>
			<?php echo $this->Html->link($pricesWarehouse['Warehouse']['name'], array('controller' => 'warehouses', 'action' => 'view', $pricesWarehouse['Warehouse']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Prices Warehouse'), array('action' => 'edit', $pricesWarehouse['PricesWarehouse']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Prices Warehouse'), array('action' => 'delete', $pricesWarehouse['PricesWarehouse']['id']), array(), __('Are you sure you want to delete # %s?', $pricesWarehouse['PricesWarehouse']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Prices Warehouses'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prices Warehouse'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Prices'), array('controller' => 'prices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Price'), array('controller' => 'prices', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Warehouses'), array('controller' => 'warehouses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Warehouse'), array('controller' => 'warehouses', 'action' => 'add')); ?> </li>
	</ul>
</div>
