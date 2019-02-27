<?php

$GLOBALS['SCRIPTS_ARR']['/js/sidebar_expand.js'] = true;
$GLOBALS['SCRIPTS_ARR']['/js/highlight_apply.js'] = true;

?>

<div class="lesson">
  <?php
  $parsedown = new Parsedown();
  echo $parsedown->text($GLOBALS['md_raw']);
  ?>
</div>

<div style="margin-bottom: 10em;"></div>
