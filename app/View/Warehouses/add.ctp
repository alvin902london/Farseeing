<div class="warehouses form">
<?php echo $this->Form->create('Warehouse'); ?>
	<fieldset>
		<legend><?php echo __('Add Warehouse'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('remarks');
		echo $this->Form->input('Price');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Warehouses'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Prices'), array('controller' => 'prices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Price'), array('controller' => 'prices', 'action' => 'add')); ?> </li>
	</ul>
</div>
