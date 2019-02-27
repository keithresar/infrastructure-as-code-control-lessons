# `POST /ticketnow`

A POST request to `/ticketnow` is used to create a new ticket.

New tickets **require** the following parameters, which must be provided json encoded in the request body:

 - **`subject`** - Subject for the ticket
 - **`body`** - Body text for the ticket

This is an authenticated request.

If testing with `curl`, consider the following command (make sure to replace your actual username and password):

```
> curl --user 'username:password' \
       -H "Content-Type: application/json" \
       -d '{ "subject": "Test Ticket", "body": "This is my test body" }' \
       -X POST \
       http://ansibleallthethings.com/ticketnow
```

A successful API request returns `200` response code, and also includes a json formated response containing the ID for the newly created ticket:

```
{"tickets_id":6}
```

Be aware for the following errors:

 - **401 Unauthorized** - Invalid or missing username/password credentials
 - **400 Bad Request** - Missing required parameters, or invalid json formatting


### 📗 Resources

 - [Ansible URI module](http://docs.ansible.com/ansible/latest/uri_module.html)

