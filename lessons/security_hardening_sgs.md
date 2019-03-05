# Hardening Your Defaults

Up to now your experience should have been pleasantly easy.  That's because there are no firewall
ACLs in place that affect traffic flows between the Internet, your web server, and your app servers.

Ansible is an excellent tool for managing ACLs - whether they be on a traditional device like a Checkpoint
firewall or on something newer like an AWS Security Group.

In this section we will harden your current configuration, break everything that's currently working,
then over subsequent exercises will regain just enough access for functionality.

<hr>

### Exercise 4.1 Applying a Default Deny All Policy

Navigate to the Ansible Tower instance and execute the Job **lorem, ipsum**.

You will need to provide your student number.


### Exercise 4.2

After the Ansible Job completes successfully from 4.1 above, verify that the following functionality
all fails in your environment.

1. Web browser to the Language Wizard Web site
2. From the **web** server, unable to curl port 8080 to your API server


### 📗 Resources

 - 

