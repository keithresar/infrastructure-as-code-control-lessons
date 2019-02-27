# TicketNow API Authentication

All requests must be authenticated using digest authentication.

The credentials are as follows:

 - **user:** Use the same `student` username use to access the control server
 - **password:** Use the same password already used to access the control server

If testing with `curl`, use the following *partial* command to authenticate (note that
additional data parameters are required - see call specific examples in subsequent sections):

```
> curl --user 'username:password' http://ansibleallthethings.com/ticketnow 
```


### 📗 Resources

 - [Ansible URI module](http://docs.ansible.com/ansible/latest/uri_module.html)

