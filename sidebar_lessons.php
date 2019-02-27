<nav class="col-sm-3 col-md-3 d-none d-sm-block bg-light sidebar">

  <?php foreach ($GLOBALS['LESSONS'] as $name => $sections)  { 
            $name_f = preg_replace("/[^a-z0-9]/","_",strtolower($name));
  
  ?>

  <a class="nav-link" data-toggle="collapse" href="#sidebar_<?php echo $name_f;?>">§ <?php echo $name;?></a>
  <div class="collapse" id="sidebar_<?php echo $name_f;?>">
    <ul class="nav nav-pills flex-column" style="margin-left: 1em;">
      <?php foreach ($sections as $pn => $section)  { ?>
      <li class="nav-item">
        <a class="nav-link <?php echo $_REQUEST['pn']==$pn?'active':'';?>" href="/i/<?php echo $pn;?>">⌞ <?php echo $section;?></a>
      </li>
      <?php } ?>
    </ul>
  </div><!-- end <?php echo $name_f;?> -->
  <?php } ?>


</nav>

