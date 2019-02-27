# Connecting to the Control Server

All of your activity during this and subsequent labs occurs on a bastion node.  The bastion
node is a Red Hat Linux server that:

 - Has the Ansible toolset installed
 - Is where all automation activities are initiated
 - Is your virtual home for the rest of the training

Today’s workshop infrastructure is being run in a cloud environment.
Each student will be assigned a number, e.g. student, student2, student3.
 
Your instructor will supply you with a web site url or paper where you will find detailed info 
for your own personal lab environment.

 - Bastion node - used to develop and run Ansible playbooks
 - Lab node(s) - target for all Ansible playbooks
 - Username, password - used to authenticate to all servers.  Each participant has a unique login.
   Please only use your login to prevent unintended errors for other students

<hr>

### 💪  Exercise 1.1 - CGrant Access to bastion Server

In general this class is not about security, nor have we architected the environment in a way that
aligns to good corporate information security best practices.  In an effort to reduce any friction
that may stand in the way of your learning we have limited SSL use and employed easy to remember
passwords.

To mitigate the risk of someone breaking the public-facing lab environments, we have limited external
access to your bastion server.  

You will need to execute an Ansible playbook from the control AWX server to enable access.

First, navigate to this URL and take note of your IP address:
https://www.google.com/search?q=what+is+my+ip

Second, take note of your personal student number from your environment access sheet.

Now, navigate to the control AWS server IP and login using your supplied credentials.

<img src="/images/introduction/awx_login_screenshot.png" style="margin-left:2em;max-width:50%;">

Once you successfulyl login you will see the dashboard screen:

<img src="/images/introduction/awx_dashboard.png" style="margin-left:2em;max-width:50%;">

Click on the **Templates** link in the sidebar nav, then click the rocket icon to the right of the
**Bootrap Access** template.

<img src="/images/introduction/awx_templates.png" style="margin-left:2em;max-width:50%;">

A survey data collector window will pop up.  Provide the IP address and student number the click **Next**.
Verify the data you submitted then click **Launch**.

<img src="/images/introduction/awx_survey.png" style="margin-left:2em;max-width:50%;">

Wait for the AWX Ansible job to complete.  Seek assistance if the job has errors.

<img src="/images/introduction/awx_bootstrap_complete.png" style="margin-left:2em;max-width:50%;">

Scroll through the log output and take note of the CHE Workspace URL provided.  It should look
like ```http://ipaddress:8080/```.


### ☢ Exercise 1.1 Results

Take note of the CHE Workspace URL from the log output of the Ansible job you just executed.



### 💪  Exercise 1.2 - Access CHE Workspace

While you can complete all activities directly from the Linux command line on your bastion host, such
as running Ansible playbooks and modifying files with the `vi` editor, this isn't the only way.  

Our course makes use of the Eclipse CHE Web-based IDE which provides file editing, syntax highlighting,
git source code management, and a browser-based terminal from which to execute your Ansible playbooks.

In this exercise we will verify you can access your workspace and that it works as expected.

Navigate to your CHE Workspace using the URL from exercise 1.1.  You should see a screen like the one below.

<img src="/images/introduction/che_dashboard.png" style="margin-left:2em;max-width:50%;">

Click on the **ansible** link at the bottom of the sidebar.




### ☢ Exercise 1.2 Results

At this point, everyone should have logged into each of your control node. 

If you haven’t, let us know so we can get you fixed up.


### 📗 Resources

 - Windows ssh client [putty.exe](http://www.putty.org/)

