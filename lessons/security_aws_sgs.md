# Firewall ACLs

Now that we are set with a  default deny policy on our AWS Security Groups, we need to add back in
the exact access we need.

<hr>


### Exercise 4.5 Experimenting with the Dynamic Inventory

Let's take a quick detour and examine a dynamic inventory.  Now that you've seen the `AWS_ACCESS_KEY_ID`
and `AWS_SECRET_ACCESS_KEY` you can connect up to our AWS environment.  Please be responsible with these keys -
you now have access to see (and potentially destroy) everyone's lab environment.

Export the access key and secret key to your environment:

```
> export AWS_ACCESS_KEY_ID='KEY'
> export AWS_SECRET_ACCESS_KEY='KEY'
```

Now run the `ec2.py` script from the `infrastructure-as-code-lab` directory.

```
> ../ec2.py
```

The output should be a json object.  Explore how many groups are defined based on metadata associated with the
cloud environment.

Scroll back up to the top of the output and see all the cloud-level detail available for each host.


### Exercise 4.6 Calling an External Inventory Script

Ordinarily you would obtain all your information from a dynamic inventory script like `ec2.py`.
These scripts return a `json` object containing a wealth of information.  They do more than
return a list of hosts and their groups, you'll also see a lot of metadata and data about the
underlying cloud/hypervisor hosting the server.  This is information that you cannot get from the
local host itself but that is incredibly valueable to assist with automation.

We're going to do something a bit backwards since this is a lab environment.  You will continue to
use the static inventory file `inventory` but you will write a play that calls the `ec2.py` script
and allows you to import and access its data.

Create a new role called `import_aws_facts` that executes the `ec2.py` script using a lookup plugin.

Move the `aws_keys` task from 4.4 into this new role.

After that, create a task that uses the `aws_keys` data to call the `ec2.py` script and store the
output.  The script output is json and should be accessible from the variable.

Test and execute this role in its own play since you won't be able to access your web and API servers.

Output the `ec2_security_group_ids` associated one of your hosts (you can hardcode an IP address).


** Hints **

*Hints are hidden behind **spoiler** tags.  You can view the text associated with these hints by highlighting the space to the right of the *spoiler* placeholder text.*

The `ec2.py` output isn't recognized as a json / variable in my play
! Use the from_json filter like this: "{{ ec2_raw.stdout | from_json }}"


### Exercise 4.7 Extracting Data for the Current Host

One challenge we have is that the `ec2.py` script is indexed by public IP, whereas your inventory uses private IPs.
You could update your inventory to use the public IP instead, or you could perform a lookup using a loop like this:

```
---
- set_fact:
    my_ec2_facts: "{{ item.value.ec2_private_ip_address }}"
  when: item.value.ec2_private_ip_address == ansible_ssh_host
  loop: "{{ ec2._meta.hostvars | dict2items }}"
```

You can test this when run against one of your web or api hosts.  This will fail when running against localhost
because AWS doesn't maintain that in its inventory.


### Exercise 4.8 Applying the Web Security Group

Start cleaning up all the messing tasks from your `import_aws_facts` role.

The purpose of this role is:

* Find the AWS security group associated with the `ansible_ssh_host`
* Change the security group ACL policy based on the `acl_policy_ports` variable created when the
  role is called

Create a new play at the beginning of your `main.yml` that executes against the **web** group,
does not gather facts, and calls this role to enable the ports you need to communicate with your web server

* ssh - 22/tcp
* http - 80/tcp


### Exercise 4.9 Applying the API Security Group

Create another play in `main.yml` that executes against the **api** group,
does not gather facts, and calls this role to enable the ports you need to communicate with your api server

Re-use the same role but change your `acl_policy_ports` variable as needed.


