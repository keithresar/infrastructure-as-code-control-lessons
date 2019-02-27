# Verifying Connectivity

Now that Ansible is (hopefully) configured in for your lab we need to verify everything is working as expected.

None of the rest of our work will succeed if this test fails.

<hr>

### 💪  Exercise 2.3 - Ansible Ping

Ansible include a `ping` module - but this is far more than a simple network ICMP ping.

The Ansible `ping` module reports on a minimum level of functionality required for successful
automation.  This module will perform the following tests for you:

* Verify functional `ansible.cfg`
* Verify valid `inventory` file
* Confirm network (ssh) connectivity
* Verify successful authentication
* Verify target host pre-reqs (primarily `python`)

If all of the above succeed then this job will return success.

While we can write a playbook for this simple test, this is most often done via the command
line instead (fun facts - you can do a LOT with Ansible via the command line, but this clearly
breaks a typical infrastructure and code mission statement).

For our first playbook, we are only going to write one play and two tasks.

Create a new file called `install_apache.yml` on the control server.  There are two ways to do this:

 - From the control server using `vi`, `nano`, or any other Linux editor you are already familiar with
 - Using the web-based editor at http://ansibleallthethings.com/i/editor and clicking the `new file` button

In the `install_apache.yml` file, add the following lines:

```
---
- hosts: lab_server
  name: Install the apache web service
  become: yes
```

Note that spacing is important in yaml files - keep each of the keys "hosts", "name", and "become" lined up.

A *very* brief primer on yaml syntax:

 - **`---`** -  Defines the beginning of YAML
 - Anything with a **`:`** defines a key/value pair
 - Anything with a **`-`** defines a list entry

Now getting to the three lines of ansible you just wrote.  These lines mean the following:

 - **`hosts:`** - Defines the host group in your inventory on which this play will run against
 - **`name:`** - This is a free-text description of what we are going to do
 - **`become:`** - Specifies that we will execute as root (we will **become** root via sudo).
   This enables user privilege escalation. While the default is sudo,  su, pbrun, and several others are also supported


### 💪  Exercise 2.5 - Adding Tasks to Your Play

Now that we’ve defined your play, let’s add some tasks to get some things done. 

Inside the same `install_apache.yml` file, add the following lines.  Note that the `t` in "task" but align with the `b` in "become".
Spacing continues to be important and its this spacing that establishes the parent/child relationship between elements throughout
the yaml file.

**Note** If you want to see the entire playbook for reference, skip to the bottom of this exercise or review the solutions shown on your
control server inside the `workshop_solutions/` directory.
 
```
  tasks:
    - name: install apache
      yum:
        name: httpd
        state: present
  
    - name: start httpd
      service:
        name: httpd
        state: started
``` 
 
Now getting to the lines of ansible you just wrote.  These lines mean the following:

 - **`tasks:`**  - This denotes that one or more tasks are about to be defined.  What follows will be an ordered list of tasks.
   Remember, an ordered list is identified by the `-` element preceeding the line.  Since the list is "owned" by the `tasks` keyword,
   the elements must be indented to show that parent/child relationship
 - **`  - name:`** -  Each task requires a name which will print to standard output when you run your playbook. Therefore, give your 
   tasks a name that is short, sweet, and to the point
 - **`    yum:`** - This line, and the `service` line in the second element, refer to the module we are calling with this automation.
   There are over 1400 different modules that ship with ansible, most of which are written in Python.  These modules do the actual
   work
 - **`      state:`** - This line, along with a re-use of `name` indented under the yum/service module sections, are parameters to the
   specified modules.  Each module take zero or more parameters.  These parameters affect how the module executes.  In this example,
   `state: present` is common pattern used by ansible to mean "make sure this thing exists".  In the case of the `yum` module, the thing is
   `httpd` - the Apache web server package
 
For good measure, let’s repeat ourselves a bit here because this is important.
These three lines below are calling the ansible module `yum` to install `httpd`. 
The ansible documentation for each module is **fantastic**, and you should never miss an opportunity to make use of it.
[Click here to see all options for the yum module](http://docs.ansible.com/ansible/latest/yum_module.html).
 
```
    - name: install apache
      yum:
        name: httpd
        state: present
```
 
The second task in our play is below.  These lines are using the ansible `service` module to start the `httpd` service. 
The `service` module is the preferred way of controlling services on remote hosts. 
[Click here to learn more about the service module](http://docs.ansible.com/ansible/latest/service_module.html).
 
```
    - name: start httpd
      service:
        name: httpd
        state: started
``` 

Now that you’ve completed writing your playbook, it would be a shame not to keep it.

If using `vi` use the write/quit method to save your playbook, e.g.. Esc `:wq!`

And that should do it. You should now have a fully written playbook called `install_apache.yml`. You are ready to automate!
 
Ansible (well, YAML really) can be a bit particular about formatting especially around indentation/spacing. When you all get back 
to the office, read up on this YAML Syntax a bit more and it will save you some headaches later. In the meantime, your completed 
playbook should look like this. Take note of the spacing and alignment.

Here is a copy of the complete playbook ready to go if you want to cheat and copy/paste.  That said, if you are cheating you will
have the best luck using the solution file that already exists on your control server.

```
---
 - hosts: lab_server
   name: Install the apache web service
   become: yes

   tasks:
     - name: install apache
       yum:
         name: httpd
         state: present

     - name: start httpd
       service:
         name: httpd
         state: started
```

(the solution file on your control node is in `workshop_solutions/apache_install.yml`).


### 💪  Exercise 2.6 - Running Your Playbook

Ansible playbooks are executed using a different binary than the ad-hoc command we worked with in the last section.

Run the following command on your control node from your home directory (this is the directory you were placed in when
you first logged into the server).

```
> ansible-playbook apache_install.yml
```

(or, if you are cheating this command will execute using the solution file directly):

```
> ansible-playbook workshop_solutions/apache_install.yml
```


### ☢ Exercise 2.6 Results

Ansible will execute the two tasks you defined and will display output as is progresses.  The output is color coded, so
take note of the following mostly commonly seen colors:

 - **green** - No change / Success
 - **red** - Error.  Ansible stops executing subsequent tasks for the host in question after a fatal error
 - **orange** - Changed.  The target state was changed to meet what was defined in your task.

(also note, that the color highlighting in this exercise will not match what you see on your screen.  Blame my syntax
highlighter for that gap).

```
> ansible-playbook workshop_solutions/apache_install.yml

PLAY [Install the apache web service] **************************************************************************************************************************

TASK [Gathering Facts] *****************************************************************************************************************************************
ok: [54.84.199.50]

TASK [install apache] ******************************************************************************************************************************************
changed: [54.84.199.50]

TASK [start httpd] *********************************************************************************************************************************************
changed: [54.84.199.50]

PLAY RECAP *****************************************************************************************************************************************************
54.84.199.50               : ok=3    changed=2    unreachable=0    failed=0
```

Notice that the play and each task is named so that you can see what is being done and to which node it is being done to. 
You also may notice a task in there that you didn’t write; <cough> setup <cough>. This is because the setup module runs by default. 
 
To turn if off, you can specify `gather_facts: false` in your play definition like this:
  
```
---
- hosts: web
  name: Install the apache web service
  become: yes
  gather_facts: false

  ...
```

Finally, if you repeatedly run the `ansible-playbook` command the colors will change after the first run.  This is because
on the first execution `httpd` was installed and started, but for subsequent runs no changes were made. Ansible is
idempotent - meaning you can execute the same task repeatedly and it will only make changes if the target state does not
match the current state.


### 💪  Exercise 2.7 - Removing Apache

Now we’re going to be less explicit about how to complete the exercise.  

Duplicate the content in your existing file and name it `apache_uninstall.yml`.

Modify your file so it successfully removes apache (don’t forget to stop the service first).
Reference the [yum module](http://docs.ansible.com/ansible/latest/yum_module.html) and 
[service module](http://docs.ansible.com/ansible/latest/service_module.html) documentation to help.

Then, execute `ansible-playbook` to affect change.


### ☢ Exercise 2.7 Results

The solution is available in the file `workshop_solutions/apache_uninstall.yml`


### 📗 Resources

 - [Ansible yum module](http://docs.ansible.com/ansible/latest/yum_module.html)
 - [Ansible service module](http://docs.ansible.com/ansible/latest/service_module.html)

