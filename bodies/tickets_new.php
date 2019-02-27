<h1>
  Create New Ticket
</h1>

<div class="card">
  <div class="card-header">
  </div>
  <div class="card-body">

    <form method="post" action="/i/tickets_new/">
      <input type="hidden" name="action" value="create_ticket">
      <div class="form-group">
        <label for="exampleFormControlInput1">Subject</label>
        <input name="subject" type="text" class="form-control" id="exampleFormControlInput1">
      </div>
      <div class="form-group">
        <label for="exampleFormControlTextarea1">Ticket Details</label>
        <textarea name="body" class="form-control" id="exampleFormControlTextarea1" rows="5"></textarea>
      </div>
      <button type="submit" class="btn btn-primary">Create Ticket</button>
    </form>
  </div>
</div>

<div style="margin-bottom: 10em;"></div>


