# TicketsNow Integration

After the previous section you have a functional microservices application that's hardened and ready for
production.  As traffic increased you very quickly noticed performance issues.  

Before you can implement a change that increases capacity and performance, we need to follow the
approved change management process.  Given that this is a lab environment you all have approval to
create and implement changes within your automation (rather than logging a ticket and waitinf for
approval).

We will be using the [Ansible URI module](http://docs.ansible.com/ansible/latest/uri_module.html) to interact
with the simple **TicketNow** application via its API.  Feel free to become familiar with the
[TicketNow API](/i/help_ticketnow_api_intro).


<hr>

### Exercise 5.1 Creating a TicketsNow ticket via curl

Using `curl`, create a new TicketsNow ticket.  
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


-------------------------------------------------




### 💪  Exercise 3.6 - Creating a New Ticket 

Making API calls follows a different pattern than we’ve used thus far.

Create a new file called `ticketnow_create.yml`.  Starty adding the following header:

```
---
 - hosts: localhost
   name: Create a new TicketNow ticket
   vars:
     api_user: "{{ ansible_user }}"
     api_password: "{{ ansible_password }}"
```

*(note, you can reference/copy the entire file on your control server in the solutions diretory, `workshop_solutions/ticketnow_create.yml`).*


There are two things to note at this point:

 - **`hosts: localhost`** - Instead of refering to a server in your inventory, this is run on the control server
 - **`api_user`** and **`api_password`** - We will use these variables in the subsequent tasks.  For now we are just
   assigning them to your current user and password already used to access the control server.  Depending on the
   scenario these could be defined elsewhere or could be a string literal.

Next we need a task to do the actual work, which will be done with the
[URI module](http://docs.ansible.com/ansible/latest/uri_module.html).  
Append the following to your `ticketnow_create.yml` file:

```
   tasks:
     - name: Create Ticket
       uri:
         # Request
         url: http://ansibleallthethings.com/ticketnow
         method: POST

         # Authentication
         user: "{{ api_user }}"
         password: "{{ api_password }}"
         force_basic_auth: yes

         # Data
         body_format: json
         body:
           subject: "{{ api_user }}'s first ticket"
           body: "lorem ipsum"

         # Response
         return_content: yes
       register: response
```

There is quite a bit going on here, so we have added some spacing to ease explanations for each section:

 - **Request** - Specify the URL target and also the type of request.  The API definition requires a `POST`
   type request when creating a new ticket, though other types of requests such as `GET`, `PUT`, `DELETE`,
   etc. could be used for other purposes
 - **Authentication** - The API definition notes that all requests must be authenticated, so here we supply
   the parameters for digest authentication
 - **Data** - The API expects two data parameters to be supplied as json within the request body.  Ansible
   very helpfully encodes the key/value pairs we supply into the appropriate escaped and formatted json that
   our API accepts.
 - **Response** - This introduces a new task-level keyword `register`, which can be used in nearly any task
   to define a new variable (in this case `response`) with the output from the command.

Execute your playbook:

```
> ansible-playbook ticketnow_create.yml
```

Examine the output from running your playbook:

- What output did you see?  
- If the execution was successful, what ticket ID was created?
- If the execution had an error, what was the problem?


### 💪  Exercise 3.7 - Debugging Your Statements

Now create a second task which allows us to peak inside the `response` variable we just populated. 
When developing playbooks, use of the [debug module](http://docs.ansible.com/ansible/latest/debug_module.html)
allows us to print statements during execution and can be useful for debugging variables or expressions without 
necessarily halting the playbook. 

Add another task to your playbook `ticketnow_create.yml`:

```
     - name: Output Raw Response
       debug:
         msg: "{{ response }}"
```

Now execute your playbook again:

```
> ansible-playbook ticketnow_create.yml
```

You’ll notice the variable `response` was output as part of the second task.  Also take note of:

 - The output is in json file format
 - The output contains a lot of details of the URI response.  Do you see error codes?  The returned content itself?
 - As a convenience, ansible automatically partsed the response content into a json variable as well, allowing you
   to quickly gain access to API response components


### 💪  Exercise 3.8 - Interacting With Variables

Add two other tasks to your playbook `ticketnow_create.yml`:

```
     - name: Output Status Code
       debug:
         msg: "create ticket response status: {{ response.status }}"

     - name: Output Ticket ID
       debug:
         msg: "create new ticket with ID: {{ response.json.tickets_id }}"
```

Now execute your playbook again:

```
> ansible-playbook ticketnow_create.yml
```

See how you were able to access different parts of the variable using **.**-notation.


### 💪  Exercise 3.9 - Adding Comments to Your Ticket

Review the [TicketsNow API](/i/help_ticketnow_api_put_ticketnow) and documentation about how to update a ticket.

Create a new playbook called `ticketnow_comment.yml`.

Using what you’ve already learned in the previous exercise, create the following:

 - Define a variable named `tickets_id` and assign the value of a ticket you’ve previously created
 - Create a task to update the ticket with a `Closed` status and an appropriate `subject`/`comment`

After executing this playbook, verify success from the [TicketsNow web UI](/i/tickets) or you can create
another task to issue an appropriate `GET` request.


### 📗 Resources

 - [TicketNow API](/i/help_ticketnow_api_intro)
 - [Ansible URI module](http://docs.ansible.com/ansible/latest/uri_module.html)
 - [Ansible debug module](http://docs.ansible.com/ansible/latest/debug_module.html)


