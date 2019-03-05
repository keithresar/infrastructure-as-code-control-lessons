# Firewall ACLs

Now that we are set with a  default deny policy on our AWS Security Groups, we need to add back in
the exact access we need.

<hr>

### Exercise 4.5 Calling an External Inventory Script

Ordinarily you would obtain all your information from a dynamic inventory script like `ec2.py`.
These scripts return a `json` object containing a wealth of information.  They do more than
return a list of hosts and their groups, you'll also see a lot of metadata and data about the
underlying cloud/hypervisor hosting the server.  This is information that you cannot get from the
local host itself but that is incredibly valueable to assist with automation.

Modify the `ec2.ini` script and add in the AWS access key and secret key you've found from the
vault.  

Then execute `ec2.py` and briefly examine the data AWS provides for us.

--> TODO - make a role or something to set this data


### Exercise 4.6 Extracting Data for the Current Host


### Exercise 4.7 Applying the Web Security Group


### Exercise 4.8 Applying the API Security Group




### 📗 Resources

 - 

