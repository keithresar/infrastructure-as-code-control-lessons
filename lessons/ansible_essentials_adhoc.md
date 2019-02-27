# Ad-hoc Commands

Ansible can be run in two modes.  It can be used as a system administration tool to run ad hoc commands against a grouping of assets.
Since the authentication and connectivity is already setup, this is an easy was to quickly interrogate a group of servers.  
They are very useful when you simply need to do one or two things quickly and often, to many remote nodes.
The second method of using ansible is more structured and repeatable - we will show that later.

Ad hoc ansible commands are run using the `ansible` executable, which you will run from your control host.
This executable takes a number of options, in its most basic form you specify:

```
> ansible <group> -m <module_name> -a <additional_optional_arguments>
```

 - **group** - This filters the hosts that will be addresses, and is typically the name of a
   group from your inventory file
 - **module_name** - Every ansible action requires a module to do the actual work, such as copying a file
   or starting a service.  
 - **additional_optional_arguments** - Some modules require additional arguments to run successfully.
   They can be specified, if required, following the `-a` flag

Like many Linux commands, ansible allows for long-form options as well as short-form. For example:
 
<hr>

### 💪  Exercise 2.1 - Ansible Ping

For our first exercise, we are going to run some ad-hoc commands to help you get a feel for how Ansible works. 
During our previous exercise we configured your inventory to add your personal lab server to the `lab_server` group.
Also embedded inside that inventory file were the credentials needed to access your server.

In this exercise we verify the correct setup using an ad-hoc command.

From the control node (which is where all future activity will take place, so we might stop mentioning it), execute the
`ping` command.

```
> ansible lab_servers -m ping
```

This executes something called an "ansible ping", which is different from an ICMP network ping.  The purpose of this module
is to verify the entire ansible stack is operational on both the control and the targets hosts.  It tests:

 - Verify the group `lab_server` exists and contains hosts
 - Verify connectivity to the target hosts
 - Verify successful authentication on target hosts
 - Verify the target hosts can run python

If all of the above are successful you will see a message `pong` written in green.  If there is an issue you will see
text in red and an error message.  Note that this output format and coloring will be used throughout all ansible operations,
so this is your opportunity to get used to seeing error, success, and other states.

### ☢ Exercise 2.1 Results

Below is an example error response (although the color coding is messed up, imagine is it all red):

```
192.168.30.1 | UNREACHABLE! => {
    "changed": false,
    "msg": "Failed to connect to the host via ssh: ssh: connect to host 172.16.40.227 port 22: Connection timed out\r\n",
    "unreachable": true
}
```

If successful, the command line output should be entirely green and look like this (again, ignore the coloring below):

```
192.168.30.1 | SUCCESS => {
    "changed": false,
    "failed": false,
    "ping": "pong"
}
```

### 💪  Exercise 2.2 - Raw Commands

Still in the context of general sys-admin work, we can run any valid unix commands across our fleet of hosts.

Using the [command module](http://docs.ansible.com/ansible/latest/command_module.html) find the uptime for your current 
host.  We will make use of the `-o` flag to squeeze the output into a single line:

```
> ansible lab_server -m command -a "uptime" -o
```

Try executing other common commands, like:

 - `ls /`
 - `cat /etc/passwd`
 - `tar cfv /etc.tar /etc`


### ☢ Exercise 2.2 Results

Each of the commands should return the command output entirely in green.


### 💪  Exercise 2.3 - Getting Facts

Switching gears a bit, we can also use the ad-hoc command to get access to a list of facts from our target server.
Facts consist of the list of all information known about a target host, for exmaple: IP addresses, alternate hostnames,
or OS release versions.

You can get these facts by running the `setup` module:

```
> ansible lab_server -m setup
```

You can filter that huge list to display only the information you may be interested in.
For example, to extract just the information for the eth0 interface you could use the filter:

```
> ansible all -m setup -a 'filter=ansible_eth0'
```

Try filtering to extract just the following data points:
 - What version of the ansible_kernel is running?
 - What is the ansible_selinux status?


### ☢ Exercise 2.3 Results

After each successful call to the setup module you should see a successful response with data from the target hosts.
Using the filter argument the output should be reduced to only the relevent subsections.

This module is an important one to keep in your back pocket.  That is because the `setup` module is called by playbooks to gather
these useful facts and store them in variables for subsequent use by your automation.  

Also take note that the output here is clearly formatted in a certain manner.  Output from ansible is in the `json` format.
json (JavaScript Object Notation) is a lightweight data-interchange format.  It reasonable for humans to read and write. It is easy for 
machines to parse and generate. It is based on a subset of the JavaScript Programming Language. 

JSON is built on two structures:

 - A collection of name/value pairs
 - An ordered list of values. In most languages, this is realized as an array or list


### 📗 Resources

 - [Ansible command module](http://docs.ansible.com/ansible/latest/command_module.html)
 - [Ansible setup module](http://docs.ansible.com/ansible/latest/setup_module.html)

