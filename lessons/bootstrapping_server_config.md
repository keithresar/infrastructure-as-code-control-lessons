# Common Server Configuration

One core tenant of automation is to reduce the risk of quality errors.  This is most visibly delivered
by bringing transparency to what actions are performed within our environment.  A side benefit, of course,
comes from removing the human element so no steps are skipped or typos introduced.

One thing often left unsaid is the cost and risk of divergent configurations that are actually introduced
by the automation itself.  Consider two common scenarios:

* We want automation to deliver results more quickly, but since we write seperate automation for every asset
  the extra workload increases time and cost to deliver
* The seperate - but similar - automation applied to multiple assets brings divergence and introduces
  increased risk of quality errors.

Both of these are mitigated by encouraging re-use of all automation you define.  Ansible is built to
make this incredibly easy - just consider our introduction to roles and the 24 levels of variable
precedence.

In this section you will write and apply a common set of server configuration to both your web and API
servers.  Now that you have graduated beyond Ansible basics your instruction will be more focussed on
what the end result needs to be than how to get there.


<hr>

### Exercise 3.1  Getting Setup

** Working Directory **

All work moving for the rest of the class will build on the previous exercise.

Your work will all reside within the `/projects/infrastructure-as-code-lab/translation_wizard/` directory.

If you need a little help along the way you may reference the solutions that exist for every
exercise inside the `translation_wizard_SOLUTIONS/` directory.

** Working files **

Wherever possible we request you create an Ansible **Role** to package your automation rather than
writing everything directly inside of a single playbook.  If this becomes too confusing you can also
use the `include_tasks:` keyword and incorporate serperate files - ask an instructor if you prefer this route.

Your final playbooks version should all reside in the existing `main.yml` file that's rooted in the 
`/projects/infrastructure-as-code-lab/translation_wizard/` directory.  This can be confusing since every single
directory in your role contains a `main.yml` file!

To ease testing (especially as you get to later exercises) you may want to create alternate files for
an easier *inner-loop* development instead of executing all of `main.yml`.  Alternately, effective use
of **[tags](https://docs.ansible.com/ansible/latest/user_guide/playbooks_tags.html)** will allow you to develop more maintainable code overall.

** Your First Practical Steps **

Change to the `/projects/infrastructure-as-code-lab/translation_wizard/` directory.

Create a new role called `common_server` using the `ansible-galaxy init common_server` command.

Include this role in your `main.yml` playbook.


### Exercise 3.2  Set Unique Hostnames

The hosts you are working with are all hosted on AWS and have a name assigned to them that is tagged to
their private IP address.  Please change each hostname of all servers to their role (e.g. web, or student0-api).  
This must address all servers (both hosts **api* and **web**).


** Original State **

Login to your **web** and **api** server.  Notice the output from the `hostname` command.

```
> hostname
ip-10-10-10-92.ec2.internal
```

** Target State **

Login to your **web** and **api** server.  Notice the output from the `hostname` command.

```
> hostname
student0-web
```

** Hints **

*Hints are hidden behind **spoiler** tags.  You can view the text associated with these hints by highlighting the space to the right of the *spoiler* placeholder text.*

How do I create a new variable?
! Investigate the **set_facts** module

Getting your student username.
! Your student user name is defined in your inventory file.  You can access this in your playbook with the notation "{{ student_user}}".

Getting your hosts role.
! If you feel advanced you can explore the group_names variable.  Or the easier but less flexible solution is to define a variable in the inventory.  This is a special Ansible variable - lookup up special variables for more details.

I give up!
! Look at the solutions in the file /home/student3/infrastructure-as-code-lab/translation_wizard_SOLUTIONS_SECTION_3/common_server/3.2_hostname.yml.


### Exercise 3.3  Configure DNS

For decades simple configuration items like DNS, NTP, and log servers have been out of sync across large organizations
Configure each server to use the Google DNS server `8.8.8.8`.


** Original State **

Login to your **web** and **api** server to see the original state. We recommend you open a new terminal tab in CHE and
issue an ssh command to access the server.  You will need to specify your student username and the server's private IP
address as shown in the example (but replace the student name with your student name and the IP address with one from your
access guide).  

```
> ssh student0@10.10.10.5

> cat /etc/resolv.conf
# Generated by NetworkManager
search ec2.internal
nameserver 10.10.0.2
```

** Target State **

Login to your **web** and **api** server.  

```
> cat /etc/resolv.conf
# Generated by NetworkManager
search ec2.internal
nameserver 8.8.8.8
```


** Hints **

*Hints are hidden behind **spoiler** tags.  You can view the text associated with these hints by highlighting the space to the right of the *spoiler* placeholder text.*

Best module to change this text
! Make use of the lineinfile module

I give up!
! Look at the solutions in the file /home/student3/infrastructure-as-code-lab/translation_wizard_SOLUTIONS_SECTION_3/common_server/3.3_dns.yml.


### Exercise 3.4  Apply a Login Banner

Most systems have a login warning banner that should be consistent across all hosts.
This banner in maintained on a seperate server and can be found at [this](/warning_banner.html) link.
(note that this is not meant to match the banner your organization may use)

** Original State **

Login to your **web** and **api** server.  

```
> cat /etc/motd
```

** Target State **

Login to your **web** and **api** server.  

```
> cat /etc/motd
LERT! You are entering into a secured area! Your IP, Login Time, Username has been noted and has been sent to the server administrator!
This service is restricted to authorized users only. All activities on this system are logged.
Unauthorized access will be fully investigated and reported to the appropriate law enforcement agencies.
```

** Hints **

*Hints are hidden behind **spoiler** tags.  You can view the text associated with these hints by highlighting the space to the right of the *spoiler* placeholder text.*

Best module to change this text
! Make use of the uri module

I give up!
! Look at the solutions in the file /home/student3/infrastructure-as-code-lab/translation_wizard_SOLUTIONS_SECTION_3/common_server/3.4_motd.yml.




### 📗 Resources

 - [Ansible Tags](https://docs.ansible.com/ansible/latest/user_guide/playbooks_tags.html)
 - [hostname module](https://docs.ansible.com/ansible/latest/modules/hostname_module.html)
 - [lineinfile module](https://docs.ansible.com/ansible/latest/modules/lineinfile_module.html)
 - [uri module](https://docs.ansible.com/ansible/latest/modules/uri_module.html)
 - [copy module](https://docs.ansible.com/ansible/latest/modules/copy_module.html)

