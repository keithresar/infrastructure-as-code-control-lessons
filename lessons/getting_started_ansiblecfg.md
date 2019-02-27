# Introducing ansible.cfg

Certain settings in Ansible are adjustable via a configuration file written in the .ini format.
The stock configuration should be sufficient for most users, but there may be reasons you would want to change them.

Changes can be made and used in a configuration file which will be processed in the following order:

 - `ANSIBLE_CONFIG` (an environment variable)
 - `ansible.cfg` (in the current directory)
 - `.ansible.cfg` (in the home directory)
 - `/etc/ansible/ansible.cfg`

Ansible will process the above list and use the first file found. Settings in files are not merged.

<hr>

### 💪  Exercise 1.2 - Review ansible.cfg

To ease setup, and because our lab environment is so simple, we have created a basic `ansible.cfg` file for
you which is located in your home directory.  We will use mostly the default except for a couple of values.

From the control server, view the `ansible.cfg` file in your home directory.  It should contain the following lines:

```
[defaults]

host_key_checking = False
deprecation_warnings=False
inventory=inventory
```

Notice this file is written in the .ini format which allows for a number of key/value pairs inside 
groups (denoted by square brackets).

The three values above accomplish the following:

 - **host_key_checking** - This is a lab, so do not verify trust
 - **deprecation_warnings** - This is a lab and I did not rewrite is for the latest
   version of Ansible.  Hide the warnings so I look good
 - **inventory** - This points to the static inventory file that we explore in exercise 1.3

### ☢ Exercise 1.2 Results

Review `ansible.cfg` file.  Explore the full list of configuration directives from the
[Ansible configuration](http://docs.ansible.com/ansible/latest/intro_configuration.html)
site.  This is a huge list, and while not used within a lab environment, there are hundreds of
tunables that make sure Ansible plays well with your existng environment.


### 📗 Resources

 - [Ansible configuration](http://docs.ansible.com/ansible/latest/intro_configuration.html)
 - `ansible-config` command utility gives you visiblity into the actual configuration you
   execute with

