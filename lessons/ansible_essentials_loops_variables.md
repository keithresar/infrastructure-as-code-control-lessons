# Adding Variables, Loops and a Handler

Ansible has all the common constructs you’d expect of a programming or scripting language, including
conditions, variables, and loops.  In the next excercise we explore these.

<hr>

###  Exercise 2.9 - Defining Variables

Change to the `2.9_loops_variables` directory.  We will be building on the content you've already created,
so either copy your `2.5_first_playbook/install_apache.yml` file to this directory or modify the template
`install_apache.yml` that we've provided.

We start by defining variables.  There are two dozen different levels of scope within ansible.  Yes, this
is intimidating if you actually try to understand them all (see resources below if you want to read up on
them).  Practically though, what this means is you can define just the right variables when you need them.
All while making re-use and modularity super simple (more on that later).

Modify the play definition to add in the `vars` definition below.  

 - Modify the `httpd_test_message` variable - this is a simple string / scalar type and contains any 
   freetext you can think of
 - Take note of the `httpd_packages` variable.  This is another list - just like what we have already used
   for our tasks.  A list can contain one or more elements

```
---
 - hosts: web
   name: Install the apache web service
   become: yes
   vars:
     httpd_test_message: Hello, this is my test message
     httpd_port: 80
     httpd_packages:
       - httpd
       - mod_wsgi
```

###  Exercise 2.10 - Using Variables in a Loop

Modify the task that calls the `yum` module so it looks like the following:

```
   tasks:
     - name: Install packages
       yum:
         name: "{{ item }}"
         state: present
       loop: "{{ httpd_packages }}"
```

We are introducing two new elements with this task:

 - **`loop:`** - This keyword is used to initiate a loop.  The loop will iterate over the `yum` module task
   once with each element in the `httpd_packages` list variable.
 - **`{{ item }}`** - This is a special variable that is declared by the loop itself.  With each iteration the
   value is updated to the next value in the list.  (ignore the `{{ }}` notation for now).

This task will effective run the following two operations for us:

 - Install package httpd
 - Install package mod_wsgi


###  Exercise 2.11 - Configure Apache

Ansible provides an awesome toolset for managing files and configurations.  One element of this is available from the
`lineinfile` module.  This module garauntees that a line is present/absent or set to contain specific content.

Create a new task following `Install packages` that modifies the apache configuration:

```
     - name: set httpd port
       lineinfile:
         path: /etc/httpd/conf/httpd.conf
         regexp: "^Listen "
         line: "Listen {{ httpd_port }}"
```

Here we are using the variable `httpd_port` and inserting it into the apache configuration file so we can manage the port
Apache is listening on.  Since we only modified a specific line, there is no risk to tainting the rest of the configuration
which makes patches safer and also allows us to execute this standardization across hosts with a divergent configuration.


###  Exercise 2.12 - Start the Apache Service

Start the http service using the same command as in your first playbook.


###  Exercise 2.13  Make Your Web Page

If you access your web server now you will see a default placeholder page.  We can do better than that.

Add a new task at the end of your task list to make this web page.  The task ordering at this point should be:

 - Install with `yum`
 - Configure with `lineinfile`
 - Start with `service`
 - Customize web page with `template`

Make your new task look like this:

```
     - name: Create web page
       template:
         src: index.html.j2
         dest: /var/www/html/index.html
```

The `template` does two things - it generates a custom file from a static source then migrates it to the target host.
Here is a bit more detail on the flow:

 - The source file is located on your local server (is it hidden in the `templates/` directory)
 - The file is run through a templating engine called `jinja2`
 - If the newly generated file differs from what exists at the target,
   Ansible copies the new file to the target

Do not skim over this - the `template` module is a game changer if you are coming from managing things from a bash script.

The template source file we are referring to contains the following:

```
<p>
{{ httpd_test_message | default('This is a really bad web page') }}

<p>
Page is hosted on {{ ansible_host }} and should be listening on port {{ httpd_port }}.
```

Let’s start examining the interesting elements introduced in this file:

 - Variables in the file, much like in our playbook, have the `{{` and `}}` to signify the start and end of what’s processed
   by the `jinja2` templating engine.  Any text in the file outside of the double mustache is ignored.  Most of the time
   you can take a known good file and replace a few elements with these variables and you are ready to rock.
 - The `| default('...')` is a filter - `jinja2` provides a few dozen of these - to further modify what is ultimately
   saved inside the file.  In this case the filter applies a default value if `httpd_test_message` is undefined.
 
Feel free to review the [template module](http://docs.ansible.com/ansible/latest/template_module.html) documentation for more detail.


###  Exercise 2.14- Execute Your Playbook

Time to execute your playbook:

```
> ansible-playbook install_apache.yml
```

Expect to see output similar to this after a successful execution

```

PLAY [Install the Apache web service] **********************************************************************************************************************************************************************************************************************************************************************************************************************************

TASK [Gathering Facts] *************************************************************************************************************************************************************************************************************************************************************************************************************************************************
ok: [10.10.10.69]

TASK [Install packages] ************************************************************************************************************************************************************************************************************************************************************************************************************************************************
changed: [10.10.10.69] => (item=httpd)
changed: [10.10.10.69] => (item=mod_wsgi)

TASK [Configure Apache] ************************************************************************************************************************************************************************************************************************************************************************************************************************************************
ok: [10.10.10.69]

TASK [Start httpd] *****************************************************************************************************************************************************************************************************************************************************************************************************************************************************
changed: [10.10.10.69]

TASK [Create web page] *************************************************************************************************************************************************************************************************************************************************************************************************************************************************
changed: [10.10.10.69]

PLAY RECAP *************************************************************************************************************************************************************************************************************************************************************************************************************************************************************
10.10.10.69                : ok=5    changed=3    unreachable=0    failed=0    skipped=0    rescued=0    ignored=0
```

If everything goes right, when you point your web browser at your lab server host following the playbook execute you should see
your new web page, custom content and all, instead of the default placeholder.



###  Exercise 2.16 - Changing Your Apache Configuration Again

Web over port 80 is so boring.  Change the `httpd_port` variable to `81` and re-execute your playbook.

```
> ansible-playbook apache_basic.yml
```

Did the configuration task mark as changed?
Point your browser at your lab server but specify port `81`.  For example, if your lab server was at the IP address `192.168.30.1`
then you would enter the URL:

```
http://192.168.30.1:81
```

Where you able to access the web page on your new port?

If not, why not?


###  Exercise 2.16 - Changing Your Apache Configuration For Real Using a Handler

configuration changes to your apache web server only take affect when reloading or restarting the service.

Since the web server was already running your `start httpd` task never ran again.  We need to fix that.

First, modify your `set httpd port` task to add a `notify` line at the end:

```
     - name: set httpd port
       lineinfile:
         path: /etc/httpd/conf/httpd.conf
         regexp: "^Listen "
         line: "Listen {{ httpd_port }}"
       notify: restart httpd
```

Now, add a new section called `handlers` after your tasks.  This new section will need the same number of leading spaces as the 
`tasks` keyword.  `handlers` will conitain a list that is indented at the same level as your existing tasks.

The entire handlers section will read as follows:

```
   handlers:
     - name: restart httpd
       service:
         name: httpd
         state: restarted
```

Before re-executing your playbook you will need to change the `httpd_port` to yet another value, maybe `82`.  This is
because the handler only fires when a change is made to the notifying task.

If you are lost, below is a full dump of what our current file looks like.  You can also see this same file at 
`workshop_solutions/ansible_loops.yml` on your control server.

```
---
 - hosts: lab_server
   name: Install the apache web service
   become: yes
   vars:
     httpd_test_message: Hello, this is my test message
     httpd_port: 82
     httpd_packages:
       - httpd
       - mod_wsgi

   tasks:
     - name: install apache
       yum:
         name: "{{ item }}"
         state: present
       with_items: "{{ httpd_packages }}"

     - name: set httpd port
       lineinfile:
         path: /etc/httpd/conf/httpd.conf
         regexp: "^Listen "
         line: "Listen {{ httpd_port }}"
       notify: restart httpd

     - name: start httpd
       service:
         name: httpd
         state: started

     - name: create web page
       template:
         src: workshop_solutions/templates/index.html.j2
         dest: /var/www/html/index.html

   handlers:
     - name: restart httpd
       service:
         name: httpd
         state: restarted
```

Re-execute your playbook with the command below:

```
> ansible-playbook apache_basic.yml
```

Now use your browser to access your site again:

```
http://192.168.30.1:82
```

One other tidbit about handlers - if you notify the same handler several times it will actually only execute once, after all
the tasks have completed.  This decreases run time and dramatically increases safety.



### 📗 Resources

 - [Ansible playbook variables](http://docs.ansible.com/ansible/latest/playbooks_variables.html)
 - [Ansible loops](https://docs.ansible.com/ansible/latest/user_guide/playbooks_loops.html)
 - [Ansible lineinfile module](http://docs.ansible.com/ansible/latest/lineinfile_module.html)
 - [Ansible template module](http://docs.ansible.com/ansible/latest/template_module.html)

