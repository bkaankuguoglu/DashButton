<!DOCTYPE html>
<html lang="en">
<?php echo $this->Html->css('style'); ?>
<body>
    <!-- Page Content -->
      <div id="content" class="container">
      <?= $this->Flash->render() ?>
      <div class="row">
          <?= $this->fetch('content') ?>
      </div>
    </div>

</body>
</html>
