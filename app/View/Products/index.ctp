<div class="products index">
	<h2><?php echo __('Products'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<tbody>
		<tr>
			<?php echo $this->Form->create('Product'); ?>
			<td colspan="3">
				<div class="FAQ">
   					<a href="#hide1" class="hide" id="hide1">+ Select Features</a>
    				<a href="#show1" class="show" id="show1">- Close Features</a>
        			<div class="list">
						<div class="box"><?php echo $this->Form->input('feature_id', array('class' => 'checkbox-inline', 'multiple' => 'checkbox')); ?>
        			</div> 							
					</div>
				</div>
			</td>
		</tr>
		<tr>	
			<td><?php echo $this->Form->input('id', array('empty' => 'Please select')); ?><?php echo $this->Form->input('country_id', array('empty' => 'Please select')); ?></td>
			<td><?php echo $this->Form->input('brand_id', array('empty' => 'Please select')); ?></td>
			<td><?php echo $this->Form->input('category_id', array('empty' => 'Please select')); ?></td>
		</tr>
		<tr>			
			<td colspan="3"><?php echo $this->Form->submit('Submit', array('name'=>'Product')); ?></td>
		</tr>
		<tr>
			<td colspan="3"><?php echo $this->Form->submit('Add this product', array('name'=>'ProductAdd')); ?></td>

		</tr>
	</tbody>
	</table>	
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
		<th><?php echo $this->Paginator->sort('Product'); ?></th>
		<th><?php echo $this->Paginator->sort('Last Price'); ?></th>			
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($products as $product): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($product['Country']['name'], array('controller' => 'countries', 'action' => 'view', $product['Country']['id'])); ?>&nbsp;<?php echo $this->Html->link($product['Brand']['name'], array('controller' => 'brands', 'action' => 'view', $product['Brand']['id'])); ?>&nbsp;<?php echo $this->Html->link($product['Category']['name'], array('controller' => 'categories', 'action' => 'view', $product['Category']['id'])); ?>&nbsp;<?php foreach ($product['Feature'] as $key => $val) { 
				//debug($val);
				if (!($val['is_weight'])) {
					echo $this->Html->link($val['name'], array('controller' => 'features', 'action' => 'view', $val['id'])) . '&nbsp;';
				} else {
					echo $val['name'] . '&nbsp;';
				}
			} ?>
			
		</td>
		<td>
			<?php
				if (!empty($product['Price'])) {
					foreach ($companies as $key => $val) {
						$filtered_prices = filter_companies($product, $key);
						$product_sorted = sort_price($filtered_prices);
						if (!empty($product_sorted['Price'])) {
							//default colour
							$color = '';
							//reset($product_sorted['Price']);
							$first_key = key($product_sorted['Price']);
							//Auto calculation for kg
							if ($product_sorted['Price'][$first_key]['unit_id'] == 1) {
								$num = round($product_sorted['Price'][$first_key]['price']/2.2046, 2);
								$cal = '<tr><td>In lb:</td></tr><tr><td>~<b>' . $num . '</b>' . $units[2] . '</td></tr>';
							} else {
								$cal = '';
							}
							//Prepare menu in dropdown & colour
							if (count($product_sorted['Price']) > 1) {
								//menu
								$product_sorted_temp = $product_sorted['Price'];
								array_splice($product_sorted_temp, 0, 1);
								$dropdown_menu = '<table cellpadding="0" cellspacing="0">' . $cal . '<tr><td>History:</td></tr>';
								foreach ($product_sorted_temp as $key2 => $val2) {
									foreach ($val2['Warehouse'] as $key3 => $val3) {
										$location[] = $val3['name'];

									}
									$locations = implode(', ', $location);
									$location = array();
									$dropdown_menu .= '<tr><td><b>' . $product_sorted_temp[$key2]['price'] . '</b>' . $units[$product_sorted_temp[$key2]['unit_id']] . '&nbsp;' . $locations . '&nbsp;(' . date("d/m/y", strtotime($product_sorted_temp[$key2]['date'])) . ')</td></tr>';
								}
								$dropdown_menu .= '</table>';

								//colour
								$keys = array_keys($product_sorted['Price']);
								if ($product_sorted['Price'][$keys[0]]['price'] - $product_sorted['Price'][$keys[1]]['price'] > 0) {
									$color = 'green';
								} else if ($product_sorted['Price'][$keys[0]]['price'] - $product_sorted['Price'][$keys[1]]['price'] == 0) { 
									$color = 'orange';
								} else {
									$color = 'red';
								}
							} else {
								$dropdown_menu = '<table cellpadding="0" cellspacing="0">' . $cal . '<tr><td>No Record</td></tr></table>';
							}

							//Prepare dropdown
							$dropdown_front = '<div class="dropdown">';
							$dropdown_end = '<div class="dropdown-content">' . $dropdown_menu . '</div></div>';
							if ($product_sorted['Price'][$first_key]['is_cleared'] == '0') {
								foreach ($product_sorted['Price'][$first_key]['Warehouse'] as $key => $val) {
									$location[] = $val['name'];
								}
								$locations = implode(', ', $location);
								$display[] = $dropdown_front . $companies[$product_sorted['Price'][$first_key]['company_id']] . '&nbsp;<b><font color="' . $color . '">' . $product_sorted['Price'][$first_key]['price'] . '</font>' . $units[$product_sorted['Price'][$first_key]['unit_id']] . '</b>&nbsp;' . $locations . '&nbsp;(' . date("d/m/y", strtotime($product_sorted['Price'][$first_key]['date'])) . ')' . $dropdown_end;
								$location = array();
							} else {
								$display[] = $dropdown_front . $companies[$product_sorted['Price'][$first_key]['company_id']] . '&nbsp;<b>' . __('清') . '</b>&nbsp;(' . $product_sorted['Price'][$first_key]['date'] . ')&nbsp;' . $dropdown_end;
							}		

						}
					}
					echo implode(' | ', $display);
					$display = array();
					$dropdown_end = '';
				}
			?>
		</td>		
		<td class="actions">
			<?php echo $this->Html->link(__('Add Price'), array('controller' => 'prices', 'action' => 'add', 'ref' => $product['Product']['id'])); ?>
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $product['Product']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $product['Product']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $product['Product']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $product['Product']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Product'), array('action' => 'add')); ?></li>
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
