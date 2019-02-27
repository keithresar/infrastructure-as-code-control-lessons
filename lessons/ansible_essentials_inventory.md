# Inventories

Ansible works against multiple systems in your infrastructure at the same time. It does this by 
selecting portions of systems listed in Ansible’s inventory, which defaults to being saved in 
the location `/etc/ansible/hosts`. You can specify a different inventory file using the 
`-i <path>` option on the command line.

Not only is this inventory configurable, but you can also use multiple inventory files at the same 
time and pull inventory from dynamic or cloud sources or different formats (YAML, ini, etc).
Ansible has inventory plugins to make this flexible and customizable.

**Hosts and Groups**

The inventory file can be in one of many formats, depending on the inventory plugins you have. 
For this example, the format for /etc/ansible/hosts is an INI-like (one of Ansible’s defaults) 
and looks like this:

```
[web]
foo.example.com
bar.example.com
 
[dbservers]
one.example.com
two.example.com
three.example.com
```

The headings in brackets are group names, which are used in classifying systems and deciding what 
systems you are controlling at what times and for what purpose.

A YAML version would look like:

```
---
all:
  hosts:
    mail.example.com
  children:
    web:
      hosts:
        foo.example.com:
        bar.example.com:
    dbservers:
      hosts:
        one.example.com:
        two.example.com:
        three.example.com:
```
 
It is ok to put systems in more than one group, for instance a server could be both a webserver and a 
dbserver. If you do, note that variables will come from all of the groups they are a member of. Variable 
precedence is detailed in a later chapter.

If you have hosts that run on non-standard SSH ports you can put the port number after the hostname with 
a colon. Ports listed in your SSH config file won’t be used with the paramiko connection but will be used with 
the openssh connection.

To make things explicit, it is suggested that you set them if things are not running on the default port:

```
badwolf.example.com:5309
```
 
Suppose you have just static IPs and want to set up some aliases that live in your host file, or you are 
connecting through tunnels. You can also describe hosts via variables:

In INI:

```
jumper ansible_port=5555 ansible_host=192.0.2.50
``` 

In YAML:

```
---
hosts:
  jumper:
    ansible_port: 5555
    ansible_host: 192.0.2.50
```

In the above example, trying to run ansible against the host alias `jumper` (which may not even be a real hostname) 
will contact `192.0.2.50` on port `5555`. Note that this is using a feature of the inventory file to define some 
special variables.


<hr>

### 💪  Exercise 2.2 - Review and configure your static inventory

Your account has a static inventory in the .ini format in your home diretory.

Open this file in CHE.

Your inventory file has a number of groups defined and is well commented.  Notice how groups can have a 
parent/child relationship and where variables within a group scope are defined.

Add the private IP address for your lab server(s) inside the `[web]` and `[api]` groups.  For 
example, if the IP address for your lab web note is `10.10.10.24` then the relevant section of your inventory 
file would look like:

```
[web]
10.10.10.24
```

Save changes made to your file.


### ☢ Exercise 2.2 Results

The IP address for your lab node should now be defined in your `inventory` file.
We will test this in the next exercise.  If the test fails, come back to this section and verify everything
was defined as expected.


### 📗 Resources

 - [Ansible Inventory](http://docs.ansible.com/ansible/latest/intro_inventory.html) - detailed documentation
   covering all capabilities and tunables for static inventories
 - [Dynamic Inventories](http://docs.ansible.com/ansible/latest/intro_dynamic_inventory.html) - for anything
   beyond a hobby implementation, most Ansiblers use dynamic inventories which give a real-time view into the
   hosts and also provide a wealth of metadata for use in playbooks.

