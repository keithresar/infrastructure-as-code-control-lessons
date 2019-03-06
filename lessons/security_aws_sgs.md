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

After that, create a task that


### Exercise 4.6 Extracting Data for the Current Host


### Exercise 4.7 Applying the Web Security Group


### Exercise 4.8 Applying the API Security Group




### 📗 Resources

 - 

