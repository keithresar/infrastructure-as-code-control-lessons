# Modularity Via Roles

While it is possible to write a playbook in one file as we’ve done throughout this workshop, eventually you’ll 
want to reuse files and start to organize things.
 
Ansible Roles is the way we do this. When you create a role, you deconstruct your playbook into parts and those 
parts sit in a directory structure. 
 
For this exercise, you are going to take the playbook you just wrote and refactor it into a role.  
In addition, you’ll learn to use Ansible Galaxy.
 
Let’s begin with seeing how your `install_apache.yml` will break down into a role.  The flow of this section is:

 - Quick learning - what is a role (watch some slides for that)
 - Create the scaffolding for a role
 - Decompose your `install_apache.yml` playbook into the role
 - Execute your playbook and hopefully everything still works

Sure, this seems like a lot of work but this is just a toy example here.  Roles are typically implemented for
two primary reasons:

 - Keeping all dependencies together within a single version controlled repo
 - Permitting re-use across different playbooks

Given the above, most roles will actually be used for repeated tasks such as server hardening, changing
load balancer membership, or modifying a change control ticket.

<hr>

###  Exercise 2.17 - Creating Scaffolding for Your Role

Change to the `2.17_roles` directory.  We will be building on the content you've already created,
so either copy your `2.17_loops_variables/install_apache.yml` file to this directory or modify the template
`install_apache.yml` that we've provided.

Roles are defined by a large directory structure, replicated below:

```
apache_simple/
├── defaults
│   └── main.yml
├── files
├── handlers
│   └── main.yml
├── meta
│   └── main.yml
├── README.md
├── tasks
│   └── main.yml
├── templates
├── tests
│   ├── inventory
│   └── test.yml
└── vars
    └── main.yml
```

Use the easy button to create this scaffolding on your control node by using the `ansible-galaxy` command:

```
> ansible-galaxy init apache-simple
```


###  Exercise 2.18 - Decomposing Your Playbook into the Role

The tasks and external dependencies used in your playbook will reside within files inside the role directory `apache_simple/`
rather than within your playbook once everything is done.

**vars**

Move `httpd_test_message` and `httpd_port` to the file `defaults/main.yml`.  The format for this file is just key/value, so
it should look like this:

```
---
# defaults file for apache_basic
httpd_test_message: Hello, this is my test message
httpd_port: 81
```

Move the `httpd_packages` variable to the `vars/main.yml` file, which should now look like this:

```
---
# vars file for apache_basic
httpd_packages:
  - httpd
  - mod_wsgi
```

Hey, wait just a minute there buster… did you just have us put variables in two separate places?
Yes… yes we did. Variables can live in quite a few places. Just to name a few:
 
 - `vars/` directory
 - `defaults/` directory
 - `group_vars/` directory
 - In the playbook under the `vars:` section
 - In any file which can be specified on the command line using the `--extra_vars` option
 
Bottom line, you need to read up on variable precedence to understand both where to define variables and which locations take 
precedence. In this exercise, we are using role defaults to define a couple of variables and these are the most malleable. After 
that, we defined some variables in `vars/` which have a higher precedence than defaults and can’t be overridden as a default variable.

**templates**

Roles are self-contained - no external dependencies.  This is awesome, and forces good hygiene for your "nfrastructure as code".
Copy the `index.html.j2 we used into your role’s `templates/` directory.  Once that’s done, any task that uses the `template`
module will automatically look for the template in that directory (take note of this, and update your task appropriately).

```
> cp ../2.9_loops_variables/templates/index.html.j2 apache_basic/templates/
```

**tasks**

Move our tasks to the `tasks/main.yml` file.

**handlers**

Move our handler to the `handlers/main.yml` file.

**playbook**

Now that everything is done, we can re-write your playbook.  Create a new file `ansible_role.yml` and add the following content:

```
---
 - hosts: web
   name: Install the Apache web service
   become: yes

   roles:
     - apache_basic
```

Isn’t that just the shortest playbook you’ve ever seen?  And if we need to add additional roles just append them to the list
that is already started.


### ☢ Exercise 2.18 Results

Execute your playbook using the same command format as always:

```
> ansible-playbook install_apache.yml
```

Notice your output is very similar to what is has always been, with the exception that the task names are prepended with
the name of your role.

```

PLAY [Install the Apache web service] **********************************************************************************************************************************************************************************************************************************************************************************************************************************

TASK [Gathering Facts] *************************************************************************************************************************************************************************************************************************************************************************************************************************************************
ok: [10.10.10.69]

TASK [apache_basic : Install packages] *********************************************************************************************************************************************************************************************************************************************************************************************************************************
ok: [10.10.10.69] => (item=httpd)
ok: [10.10.10.69] => (item=mod_wsgi)

TASK [apache_basic : Configure Apache] *********************************************************************************************************************************************************************************************************************************************************************************************************************************
ok: [10.10.10.69]

TASK [apache_basic : Start httpd] **************************************************************************************************************************************************************************************************************************************************************************************************************************************
ok: [10.10.10.69]

TASK [apache_basic : Create web page] **********************************************************************************************************************************************************************************************************************************************************************************************************************************
ok: [10.10.10.69]

PLAY RECAP *************************************************************************************************************************************************************************************************************************************************************************************************************************************************************
10.10.10.69                : ok=5    changed=0    unreachable=0    failed=0    skipped=0    rescued=0    ignored=0
```


### 📗 Resources

 - [Ansible roles](http://docs.ansible.com/ansible/latest/playbooks_reuse_roles.html)
 - [Ansible Galaxy](https://galaxy.ansible.com/)

