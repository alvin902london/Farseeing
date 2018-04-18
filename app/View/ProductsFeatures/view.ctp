<div class="productsFeatures view">
<h2><?php echo __('Products Feature'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($productsFeature['ProductsFeature']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Product'); ?></dt>
		<dd>
			<?php echo $this->Html->link($productsFeature['Product']['id'], array('controller' => 'products', 'action' => 'view', $productsFeature['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Feature'); ?></dt>
		<dd>
			<?php echo $this->Html->link($productsFeature['Feature']['name'], array('controller' => 'features', 'action' => 'view', $productsFeature['Feature']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Products Feature'), array('action' => 'edit', $productsFeature['ProductsFeature']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Products Feature'), array('action' => 'delete', $productsFeature['ProductsFeature']['id']), array(), __('Are you sure you want to delete # %s?', $productsFeature['ProductsFeature']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Products Features'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Products Feature'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products'), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product'), array('controller' => 'products', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Features'), array('controller' => 'features', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Feature'), array('controller' => 'features', 'action' => 'add')); ?> </li>
	</ul>
</div>
