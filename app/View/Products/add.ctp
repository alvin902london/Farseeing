<div class="products form">
<?php echo $this->Form->create('Product'); ?>
	<fieldset>
		<legend><?php echo __('Add Product'); ?></legend>
	<?php
		if (isset($country_param)) {
	    	echo $this->Form->input('country_id', array('selected' => $country_param));
	    } else {
			echo $this->Form->input('country_id');
	    }	

		echo $this->Form->input('Country.name');

		if (isset($brand_param)) {	 		
			echo $this->Form->input('brand_id', array('selected' => $brand_param));
		} else {
			echo $this->Form->input('brand_id');
		}		

		echo $this->Form->input('Brand.name');	

		if (isset($category_param)) {	 		
			echo $this->Form->input('category_id', array('selected' => $category_param));
		} else {
			echo $this->Form->input('category_id');
		}				

		echo $this->Form->input('Category.name');

		if (isset($feature_param[0])) {
			echo $this->Form->input('Feature.Feature.0', array('label' => 'Feature 1', 'options' => $features, 'empty' => 'Please select', 'selected' => $feature_param[0]));
		} else {
			echo $this->Form->input('Feature.Feature.0', array('label' => 'Feature 1', 'options' => $features, 'empty' => 'Please select'));
		}

		echo $this->Form->input('New.0.name');	
	
		if (isset($feature_param[1])) {		
			echo $this->Form->input('Feature.Feature.1', array('label' => 'Feature 2', 'options' => $features, 'empty' => 'Please select', 'selected' => $feature_param[1]));				
		} else {			
			echo $this->Form->input('Feature.Feature.1', array('label' => 'Feature 2', 'options' => $features, 'empty' => 'Please select'));
		}

		echo $this->Form->input('New.1.name');		

		if (isset($feature_param[2])) {	
			echo $this->Form->input('Feature.Feature.2', array('label' => 'Feature 3', 'options' => $features, 'empty' => 'Please select', 'selected' => $feature_param[2]));
		} else {					
			echo $this->Form->input('Feature.Feature.2', array('label' => 'Feature 3', 'options' => $features, 'empty' => 'Please select'));
		}	

		echo $this->Form->input('New.2.name');			

		if (isset($feature_param[3])) {	
			echo $this->Form->input('Feature.Feature.3', array('label' => 'Feature 4', 'options' => $features, 'empty' => 'Please select', 'selected' => $feature_param[3]));		
		} else {				
			echo $this->Form->input('Feature.Feature.3', array('label' => 'Feature 4', 'options' => $features, 'empty' => 'Please select'));		
		}

		echo $this->Form->input('New.3.name');			
		
		if (isset($feature_param[4])) {	
			echo $this->Form->input('Feature.Feature.4', array('label' => 'Feature 5', 'options' => $features, 'empty' => 'Please select', 'selected' => $feature_param[4]));
		} else {	
			echo $this->Form->input('Feature.Feature.4', array('label' => 'Feature 5', 'options' => $features, 'empty' => 'Please select'));		
		}	

		echo $this->Form->input('New.4.name');			

		if (isset($feature_param[5])) {	
			echo $this->Form->input('Feature.Feature.5', array('label' => 'Feature 6', 'options' => $features, 'empty' => 'Please select', 'selected' => $feature_param[5]));	
		} else {	
			echo $this->Form->input('Feature.Feature.5', array('label' => 'Feature 6', 'options' => $features, 'empty' => 'Please select'));	
		}		
		
		echo $this->Form->input('New.5.name');								
	?>
	</fieldset>
	<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Products'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Countries'), array('controller' => 'countries', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Country'), array('controller' => 'countries', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Brands'), array('controller' => 'brands', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Brand'), array('controller' => 'brands', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Categories'), array('controller' => 'categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Category'), array('controller' => 'categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Prices'), array('controller' => 'prices', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Price'), array('controller' => 'prices', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Features'), array('controller' => 'features', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feature'), array('controller' => 'features', 'action' => 'add')); ?> </li>
	</ul>
</div>
