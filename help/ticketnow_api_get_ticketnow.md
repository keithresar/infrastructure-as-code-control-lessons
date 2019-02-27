# `GET /ticketnow/tickets_id`

A GET request to `/ticketnow/tickets_id` is used to retrieve an existing ticket.

GET requests **must** reference the tickets_id in the URI request.

This is an authenticated request.

If testing with `curl`, consider the following command (make sure to replace your actual username and password):

```
> curl --user 'username:password' \
       http://ansibleallthethings.com/ticketnow/6
```

A successful API request returns `200` response code, and also includes a json formated response containing the entire ticket:

```
{
  "tickets_id": 6,
  "subject": "Test Ticket",
  "body": "This is my test body",
  "owner": "student1",
  "status": "Closed",
  "date_created": 1511106594,
  "last_update": 1511107359,
  "comments": [
    {
      "subject": "Request completed",
      "comment": "This work is finished",
      "date_created": 1511107359,
      "owner": "student1"
    }
  ]
}
```

Be aware for the following errors:

 - **401 Unauthorized** - Invalid or missing username/password credentials
 - **404 Not Found** - The supplied ticket ID was not found


### 📗 Resources

 - [Ansible URI module](http://docs.ansible.com/ansible/latest/uri_module.html)

