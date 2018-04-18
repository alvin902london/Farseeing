<div class="pricesWarehouses form">
<?php echo $this->Form->create('PricesWarehouse'); ?>
	<fieldset>
		<legend><?php echo __('Edit Prices Warehouse'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('price_id');
		echo $this->Form->input('warehouse_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('PricesWarehouse.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('PricesWarehouse.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Prices Warehouses'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Prices'), array('controller' => 'prices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Price'), array('controller' => 'prices', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Warehouses'), array('controller' => 'warehouses', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Warehouse'), array('controller' => 'warehouses', 'action' => 'add')); ?> </li>
	</ul>
</div>
