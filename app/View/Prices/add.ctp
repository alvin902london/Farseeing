<div class="prices form">
<?php echo $this->Form->create('Price'); ?>
	<fieldset>
		<legend><?php 
		if (isset($from)) {
			echo __('Add Price') . '&nbsp;' . $from;
		} else {
			echo __('Add Price');
		}
		?></legend>
	<?php
		echo $this->Form->input('company_id');
		echo $this->Form->input('Company.name');		
		if (isset($from)) { ?>
			<input type="hidden" name="data[Price][product_id]" id="PriceProduct_id" value="<?php echo $from; ?>"/>
		<?php } else {
			echo $this->Form->input('product_id');
		}
		echo $this->Form->input('price');
		echo $this->Form->input('unit_id');
		echo $this->Form->input('date');
		echo $this->Form->input('is_cleared');
		echo $this->Form->input('Warehouse');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Prices'), array('action' => 'index')); ?></li>
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
