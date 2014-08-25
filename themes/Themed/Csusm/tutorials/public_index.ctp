<h3><?php echo Configure::read('user_config.application_title') ?> [beta]</h3>
<ul>
<?php

  foreach($tutorials as $tutorial) {
    echo "<li>";
    echo $this->Html->link(
      $tutorial['Tutorial']['title'],
      array('action' => 'view', $tutorial['Tutorial']['id']),
      array('target' => '_blank')
    );
    echo ' ';
    echo $this->Html->link(
      '[information]',
      array('action' => 'view_information', $tutorial['Tutorial']['id'])
    );
    echo "</li>";
  }
[beta]
  echo $this->element('paging');
?>
</ul>
[beta]
