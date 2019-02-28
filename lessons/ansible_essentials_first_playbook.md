# Your First Playbook - Installing a Web Server

Now that you’ve gotten a sense of how ansible works, we are going to write our first ansible playbook. The playbook 
is where you can take some of those ad-hoc commands you just ran and put them into a repeatable set of plays and tasks.
 
A playbook can have multiple plays and a play can have one or more tasks. The goal of a play is to map a group of hosts. 
The goal of a task is to implement modules against those hosts.
 

<hr>

### 💪  Exercise  2.5 - Defining Your Play

For our first playbook, we are only going to write one play and two tasks.

Change to the `2.5_first_playbook` directory and notice the files present as we will follow a similar
approach for all subsequent lessons:

* `install_apache.yml` - This is an empty file and where you should work
* `install_apache_SOLUTION_2.5.yml` - This is a commented file with the solutions for the labeled exercise

Now please open the empty file `install_apache.yml` and add the following lines:

```
---
- hosts: web
  name: Install the Apache web service
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
 - **`become:`** - Specifies that we will execute as root (we will **become** root via `sudo`).
   This enables user privilege escalation. While the default is `sudo`, `su`, `pbrun`, and several others are also supported



### 💪  Exercise  2.6 - Adding Tasks to Your Play

Now that we’ve defined your play, let’s add some tasks to get some things done. 

Inside the same `install_apache.yml` file, add the following lines.  Note that the `t` in "task" but align with 
the `b` in "become".

Spacing continues to be important and its this spacing that establishes the parent/child relationship between 
elements throughout the yaml file.

**Note** If you want to see the entire playbook for reference, skip to the bottom of this exercise or review 
the solutions (which include a lot of comments).
 
```
  tasks:
    - name: Install httpd
      yum:
        name: httpd
        state: present
  
    - name: Start httpd
      service:
        name: httpd
        state: started
``` 
 
Now getting to the lines of ansible you just wrote.  These lines mean the following:

 - **`tasks:`**  - This denotes that one or more tasks are about to be defined.  What follows will be an ordered list of tasks.
   Remember, an ordered list is identified by the `-` element preceeding the line.  Since the list is "owned" by the 
   `tasks` keyword, the elements must be indented to show that parent/child relationship
 - **`  - name:`** -  Each task requires a name which will print to standard output when you run your playbook. Therefore, 
   give your tasks a name that is short, sweet, and to the point
 - **`    yum:`** - This line, and the `service` line in the second element, refer to the module we are calling with 
   this automation.
   There are over 2800 different modules that ship with ansible, most of which are written in Python.  These modules 
   do the actual work
 - **`      state:`** - This line, along with a re-use of `name` indented under the yum/service module sections, are 
   parameters to the specified modules.  Each module take zero or more parameters.  These parameters affect how the 
   module executes.  In this example,
   `state: present` is common pattern used by ansible to mean "make sure this thing exists".  In the case of the 
   `yum` module, the thing is `httpd` - the Apache web server package
 
For good measure, let’s repeat ourselves a bit here because this is important.
These three lines below are calling the ansible module `yum` to install `httpd`. 
The ansible documentation for each module is **fantastic**, and you should never miss an opportunity to make use of it.
[Click here to see all options for the yum module](http://docs.ansible.com/ansible/latest/yum_module.html).
 
```
    - name: Install httpd
      yum:
        name: httpd
        state: present
```
 
The second task in our play is below.  These lines are using the ansible `service` module to start the `httpd` service. 
The `service` module is the preferred way of controlling services on remote hosts. 
[Click here to learn more about the service module](http://docs.ansible.com/ansible/latest/service_module.html).
 
```
    - name: Start httpd
      service:
        name: httpd
        state: started
``` 

The CHE editor will automatically save changes to your file

And that should do it. You should now have a fully written playbook called `install_apache.yml`. You are ready to automate!
 
Ansible (well, YAML really) can be a bit particular about formatting especially around indentation/spacing. When you all get back 
to the office, read up on this YAML Syntax a bit more and it will save you some headaches later. In the meantime, your completed 
playbook should look like this. Take note of the spacing and alignment.

Here is a copy of the complete playbook ready to go if you want to cheat and copy/paste.  That said, if you are cheating you will
have the best luck using the solution file that already existsin your work directory.

```
---
 - hosts: web
   name: Install the apache web service
   become: yes

   tasks:
     - name: Install httpd
       yum:
         name: httpd
         state: present

     - name: Start httpd
       service:
         name: httpd
         state: started
```


### 💪  Exercise 22.7 - Running Your Playbook

Ansible playbooks are executed using a different binary than the ad-hoc command we worked with in the last section.

Run the following command on your control node from your home directory (this is the directory you were placed in when
you first logged into the server).

```
> cd /projects/infrastructure-as-code-lab/2.5_first_playbook
> ansible-playbook install_apache.yml
```

(or, if you are cheating this command will execute using the solution file directly):

```
> ansible-playbook install_apache_SOLUTION_2.6.yml
```


### ☢ Exercise 2.7 Results

Ansible will execute the two tasks you defined and will display output as is progresses.  The output is color coded, so
take note of the following mostly commonly seen colors:

 - **green** - No change / Success
 - **red** - Error.  Ansible stops executing subsequent tasks for the host in question after a fatal error
 - **orange** - Changed.  The target state was changed to meet what was defined in your task.

(also note, that the color highlighting in this exercise will not match what you see on your screen.  Blame my syntax
highlighter for that gap).

```
> ansible-playbook install_apache_SOLUTION_2.6.yml

PLAY [Install the Apache web service] **********************************************************************************************************************************************************************************************************************************************************************************************************************************

TASK [Gathering Facts] *************************************************************************************************************************************************************************************************************************************************************************************************************************************************
ok: [10.10.10.69]

TASK [Install httpd] ***************************************************************************************************************************************************************************************************************************************************************************************************************************************************
changed: [10.10.10.69]

TASK [Start httpd] *****************************************************************************************************************************************************************************************************************************************************************************************************************************************************
changed: [10.10.10.69]

PLAY RECAP *************************************************************************************************************************************************************************************************************************************************************************************************************************************************************
10.10.10.69                : ok=3    changed=2    unreachable=0    failed=0
```

Notice that the play and each task is named so that you can see what is being done and to which node it is being done to. 
You also may notice a task in there that you didn’t write; <cough> setup <cough>. This is because the setup module 
runs by default. 
 
To turn if off, you can specify `gather_facts: false` in your play definition like this:
  
```
---
- hosts: web
  name: Install the Apache web service
  become: yes
  gather_facts: false

  ...
```

Finally, if you repeatedly run the `ansible-playbook` command the colors will change after the first run.  This is because
on the first execution `httpd` was installed and started, but for subsequent runs no changes were made. Ansible is
idempotent - meaning you can execute the same task repeatedly and it will only make changes if the target state does not
match the current state.


### 💪  Exercise  2.8- Removing Apache

Now we’re going to be less explicit about how to complete the exercise.  

Duplicate the content in your existing file and name it `apache_uninstall.yml`.

Modify your file so it successfully removes apache (don’t forget to stop the service first).
Reference the [yum module](http://docs.ansible.com/ansible/latest/yum_module.html) and 
[service module](http://docs.ansible.com/ansible/latest/service_module.html) documentation to help.

Then, execute `ansible-playbook` to affect change.


### ☢ Exercise 2.8 Results

The solution is available in the file `uninstall_apache_SOLUTION_2.8.yml`.


### 📗 Resources

 - [YAML Syntax](https://docs.ansible.com/ansible/latest/reference_appendices/YAMLSyntax.html)
 - [Ansible yum module](http://docs.ansible.com/ansible/latest/yum_module.html)
 - [Ansible service module](http://docs.ansible.com/ansible/latest/service_module.html)

