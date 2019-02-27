<?php

global $ticket;

if (array_key_exists('tickets_id',$_REQUEST))  {

?>

<h1>
  <span class="badge badge-secondary">#<?php echo $ticket['tickets_id'];?></span>
  <?php echo $ticket['subject'];?>
</h1>

<div class="ticket">
  <div>
    Logged by <?php echo $ticket['owner'];?> on <?php echo date("F j, Y, g:i a",$ticket['date_created']);?> 
    (last update <?php echo TimeUtils::FuzzyTimeDelta(time()-$ticket['last_update']);?> ago)
  </div>

  <div style="margin-top:2em;">
    <div class="card">
      <div class="card-body">
        <?php echo $ticket['body'];?>
      </div>
    </div>
  </div>
</div>

<?php if (count($ticket['comments']))  { ?>
<hr>

  <?php foreach ($ticket['comments'] as $comment)  { ?>
  <div class="card" style="margin-bottom:2em;">
    <div class="card-body">
      <h4 class="card-title"><?php echo $comment['subject'];?></h4>
      <h6 class="card-subtitle mb-2 text-muted">
        by <?php echo $comment['owner'];?> on <?php echo date("F j, Y, g:i a",$comment['date_created']);?> 
        (<?php echo TimeUtils::FuzzyTimeDelta(time()-$comment['date_created']);?> ago)
      </h6>
      <p class="card-text"><?php echo $comment['comment'];?></p>
    </div>
  </div>
  <?php } ?>

<?php } ?>


<hr>
<div class="card">
  <div class="card-header">
  Add new comment
  </div>
  <div class="card-body">

    <form method="post" action="/i/tickets/">
      <input type="hidden" name="tickets_id" value="<?php echo $_REQUEST['tickets_id'];?>">
      <input type="hidden" name="action" value="add_comment">
      <div class="form-group">
        <label for="exampleFormControlInput1">Subject</label>
        <input name="comment_subject" type="text" class="form-control" id="exampleFormControlInput1">
      </div>
      <div class="form-group">
        <label for="exampleFormControlSelect1">Status</label>
        <select name="comment_status" class="form-control" id="exampleFormControlSelect1">
          <option>New</option>
          <option>Open</option>
          <option>Closed</option>
        </select>
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Comment Details</label>
        <textarea name="comment_comment" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Add Comment</button>
    </form>
  </div>
</div>

<div style="margin-bottom: 10em;"></div>

<?php } ?>
