<div class="tutorials index">
	<h1><?php echo __('Tutorials');?></h1>
  <div class="row">
    <div class="span12">
    <?php
      echo $this->Html->link(__('Create a Tutorial'), array('action' => 'add'),
        array('id' => 'create', 'class' => 'btn btn-success'));
    ?>
    </div>
  </div>

  <div id="tutorial-list" class="paginated-list row">
    <div class="span12">
      <table class="table table-striped table-hover">
        <tr>
          <th>Tutorial</th><th>Actions</th></tr>
        <?php
      	$i = 0;
      	foreach ($tutorials as $tutorial):
      		$class = ' class=""';
      		if ($i++ % 2 == 0) {
      			$class = ' class=""';
      		}
      	?>
      	<tr<?php echo $class;?>>
      		<td>
            <?php
            echo $this->Html->link($tutorial['Tutorial']['title'], array('action' => 'view', $tutorial['Tutorial']['id']));
            ?>
          </td>
      		<td>
      			<?php echo $this->Html->link(__('Edit'), array('action' => $tutorial['Tutorial']['edit_action'], $tutorial['Tutorial']['id']), array('class' => 'btn btn-small btn-info')); ?>
      			<?php echo $this->Html->link(__('Delete'), array('action' => 'delete', $tutorial['Tutorial']['id']), array('class' => 'btn btn-small btn-warning'), null,
              sprintf(__('Are you sure you want to delete tutorial %s?'), $tutorial['Tutorial']['title'])); ?>
      		</td>
      	</tr>
        <?php endforeach ?>
      </table>
    </div>
    <?php echo $this->element('paging') ?>
  </div>

  <div class="row">
    <div class="span12">
      <?php
        echo $this->Html->link('View the public interface', array('action' => 'search'), array('target' => '_blank'));
      ?>
    </div>
  </div>
  <div class="row">
    <div class="span12">
      <?php
      if ($is_admin) {
        echo $this->Html->link('Manage users', array('controller' => 'users'));
      }
      ?>
    </div>
  </div>
</div>
