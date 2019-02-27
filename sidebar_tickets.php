<?php

/*

    Find all tickets with the sepcified status.
    If none specified then assume open.

    Foreach ticket display the ticket number, status,
    number of comments, and last update.

 */

//if (!array_key_exists("status_filter",$_REQUEST))  $_REQUEST['status_filter'] = 'Open';

?>

<?php // TODO - display filter form select ?>

<?php 

// query for tickets and load them into array
$tickets = array();
foreach (scandir($GLOBALS['TICKETNOW_DIR'],SCANDIR_SORT_DESCENDING) as $file)  {
    if (!preg_match("/^(\d+).json$/",$file,$match))  continue;

    $cur_ticket = json_decode(file_get_contents(sprintf("%s/%05d.json",$GLOBALS['TICKETNOW_DIR'],$file)),true);
    if ($cur_ticket)  {
        // TODO - apply filters
        //if ($ticket['status']==$_REQUEST['status_filter'])  $tickets[] = $ticket;
        $tickets[] = $cur_ticket;
    }
}

?>
<nav class="col-sm-3 col-md-3 d-none d-sm-block bg-light sidebar">

  <ul class="nav nav-pills flex-column" style="margin-left: 1em;">
  <?php foreach ($tickets as $cur_ticket)  { ?>

    <li class="nav-item">
      <div>
        <a class="nav-link <?php echo array_key_exists('tickets_id',$_REQUEST) && $_REQUEST['tickets_id']==$cur_ticket['tickets_id']?'active':'';?>" 
           href="/i/tickets/?tickets_id=<?php echo $cur_ticket['tickets_id'];?>">
          <span class="badge badge-success">#<?php echo $cur_ticket['tickets_id'];?></span>
          <?php echo $cur_ticket['status'];?>
          (updated: <?php echo TimeUtils::FuzzyTimeDelta(time()-$cur_ticket['last_update']);?> ago)
        </a>
        <div style="margin:0 0 1em 2em;">
          <div>
            <?php echo $cur_ticket['subject'];?>
          </div>
          <div>
            <?php echo $cur_ticket['owner'];?>
            (<?php echo count($cur_ticket['comments']);?> comments)
          </div>
        </div>
      </div>
    </li>

  <?php } ?>
  </ul>

  <hr>
  <center>
    <a href="/i/tickets_new" class="btn btn-primary">Create New Ticket</a>
  </center>


</nav>

