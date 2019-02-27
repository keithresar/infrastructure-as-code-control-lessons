
<?php if (array_key_exists('login_error',$GLOBALS) && $GLOBALS['login_error'])  { ?>
<div class="alert alert-danger" role="alert">
  Error logging in, please try again.
</div>
<?php } ?>

<p>
Before you can use the web-based editor please login using your student account.
</p>

<p>
This will be the same user and password used to access the server where Ansible is run.
</p>


<form method="post" action="/i/login">
  <div class="form-group">
    <label for="exampleInputEmail1">User</label>
    <input name="user" type="text" class="form-control" placeholder="Enter username">
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input name="password" type="password" class="form-control" placeholder="Password">
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
</form>


