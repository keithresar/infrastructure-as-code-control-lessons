# TicketsNow Integration

After the previous section you have a functional microservices application that's hardened and ready for
production.  As traffic increased you very quickly noticed performance issues.  

Before you can implement a change that increases capacity and performance, we need to follow the
approved change management process.  Given that this is a lab environment you all have approval to
create and implement changes within your automation (rather than logging a ticket and waiting for
approval).

We will be using the [Ansible URI module](http://docs.ansible.com/ansible/latest/uri_module.html) to interact
with the simple **TicketNow** application via its API.  Feel free to become familiar with the
[TicketNow API](/i/help_ticketnow_api_intro).


<hr>

### Exercise 5.1 Creating a TicketsNow ticket via curl

Using `curl` in the CHE terminal, create a new TicketsNow ticket.  
[Review the API documentation for creating a new ticket](/i/help_ticketnow_api_post_ticketnow).

*Note - use the TicketsNow URL in your access sheet not the one specified in the documentation.*

Then [login to the TicketsNow web UI](/i/tickets) to verify your ticket was created as expected.


### Exercise 5.2 TicketsNow Role

The automation you write for use with TicketsNow will be reused by many different playbooks in the
future.  We'll start by creating a simple role to create a new ticket.

Create a new role `ticketsnow`.  For now create a new playbook `ticketsnow_testing.yml`.

Make use of the URI module to create a ticket.  Use variables to specify the two parameters
sent to the API:

* subject
* body

Store the response tickets ID to the variable `tickets_id`.


### Exercise 5.3 Add Routing to Your Role

Using a **routing** pattern we can perform multiple related tasks using a single role.

Implement this pattern by:

* When calling your role include the variable `state` as either `new`, `open`, or `closed`.
* Also include variables such as `ticket_subject`, `ticket_comment`, and `tickets_id`
  as appropriate
* In your roles `main.yml` use a switching mechanism like the following and remove all other
  content from the main.yml file.

```
---
- include_tasks: "{{ state }}.yml"
```

Verify you can still create a new ticket.


### Exercise 5.4 Commenting on an Existing Ticket

Add a new state file inside your role called `update.yml`.

Implement the [TicketNow API for modifying existing tickets](/i/help_ticketnow_api_put_ticketnow).


### Exercise 5.5 Changing Status on an Existing Ticket

Add a new state file inside your role called `closed.yml`.

Implement the [TicketNow API for modifying existing tickets](/i/help_ticketnow_api_put_ticketnow).


### 📗 Resources

 - [TicketNow API](/i/help_ticketnow_api_intro)
 - [Ansible URI module](http://docs.ansible.com/ansible/latest/uri_module.html)
 - [Ansible debug module](http://docs.ansible.com/ansible/latest/debug_module.html)


