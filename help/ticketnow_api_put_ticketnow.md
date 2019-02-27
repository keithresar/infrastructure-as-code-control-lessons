# `PUT /ticketnow/tickets_id`

A PUT request to `/ticketnow/tickets_id` is used to modify an existing ticket, such as changing the status or
adding a new comment.

PUT requests **must** reference the tickets_id in the URI request.

PUT requests **may have** the following parameters (they are not all required), which must be provided json encoded in the request body:

 - **`status`** - Ticket status, one of `New`, `Open`, `Closed`.  This is case sensitive
 - **`subject`** - Subject for the new ticket comment
 - **`comment`** - Text for the new ticket comment

This is an authenticated request.

If testing with `curl`, consider the following command (make sure to replace your actual username and password):

```
> curl --user 'username:password' \
       -H "Content-Type: application/json" \
       -d '{ "status": "Closed", "subject": "Request completed", "comment": "This work is finished" }' \
       -X PUT \
       http://ansibleallthethings.com/ticketnow/6
```

A successful API request returns a `200` response code.

Be aware for the following errors:

 - **401 Unauthorized** - Invalid or missing username/password credentials
 - **400 Bad Request** - Missing required parameters, invalid json formatting, or invalid status type (if provided)
 - **404 Not Found** - The supplied ticket ID was not found


### 📗 Resources

 - [Ansible URI module](http://docs.ansible.com/ansible/latest/uri_module.html)

