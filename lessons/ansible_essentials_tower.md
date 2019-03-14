# Ansible Tower Introduction

Red Hat Ansible Tower helps you scale IT automation, manage complex deployments and speed productivity. 
Centralize and control your IT infrastructure with a visual dashboard, role-based access control, job 
scheduling, integrated notifications and graphical inventory management. And Ansible Tower's REST API 
and CLI make it easy to embed Ansible Tower into existing tools and processes.

Up to this point you've been running your Ansible automation from the command line calling `ansible-playbook`
directly.  Ansible Tower lets you get more control over your automation.  Every object in Tower
(credentials, inventories, templates, etc.) has robe-based access controls (RBAC) tied to it which allows 
most organizations to safely delegate their automation.  A typical division of work might include:

* Functional owner (e.g. the load balancing management team) has write access to the
  credential, playbook, and the inventory.  They will create a job template referencing these.
* Junior admins, triage operators, or downstream consuming teams are delegating execute
  access to the automation that's been created and vetted by the functional owner.

<hr>

###  Exercise 2.22 - Accessing Ansible Tower

Navigate to the Ansible Tower Web UI and login with your student credentials.

<img src="/images/ansible_essentials/tower_login.png" style="margin-left:2em;max-width:90%;">

After logging in you'll see the Tower dashbaord.  Since your student account has full admin
permissions you'll also be able to see activity from others in the class.

<img src="/images/ansible_essentials/tower_dashboard.png" style="margin-left:2em;max-width:90%;">


###  Exercise 2.23 - Creating Credentials

We are going to create a credential so you can securely access your Gitlab project.

Navigate to the credentials screen by clicking on **Credentials** in the sidebar.
Then select the green **+** button to create a new credential.

<img src="/images/ansible_essentials/tower_credentials_before.png" style="margin-left:2em;max-width:90%;">

Fill in the data collector as follows:

* **Name** - Your student ID followed by gitlab, e.g. `student0-gitlab`
* **Credential Type** - Search for `Source Control`
* **Username** - Your student ID, e.g. `student0`
* **Password** - Your student password

<img src="/images/ansible_essentials/tower_new_credential.png" style="margin-left:2em;max-width:90%;">


###  Exercise 2.24 - Creating Projects

** Gitlab **
A project in Ansible Tower is equivalent to a project in Gitlab or a git repo - they all refer to the
same assets.  That being said, quickly navigate to the Gitlab instance so we can get the URL to access
your `infrastructure-as-code-lab` repo.

From your Gitlab project page click on the blue **Clone** button and copy the **Clone with HTTP** URL.

<img src="/images/ansible_essentials/gitlab_clone_with_http.png" style="margin-left:2em;max-width:90%;">


** Ansible Tower **

Back to Ansible Tower, navigate to the projects screen by clicking on the **Projects** link in the sidebar.
Then select the green **+** button to create a new project.

<img src="/images/ansible_essentials/tower_projects_before.png" style="margin-left:2em;max-width:90%;">

Fill out the data collector as follows then click the save button:

* **Name** - Your student ID followed by infrastructure-as-code-lab, e.g. `student0-infrastructure-as-code-lab`
* **SCM Type** - Select `Git`
* **SCM URL** - Paste the URL you copied from Gitlab.  You will need to modify the URL and append
  port `:8080` as shown in the picture below
* **SCM Credential** - Select the Gitlab credential tagged with your student ID that you created
* Check **Update revision on launch**

<img src="/images/ansible_essentials/tower_new_project.png" style="margin-left:2em;max-width:90%;">


###  Exercise 2.25 - Creating Inventories

Ansible Tower needs to know what hosts to act upon, just as when running `ansible-playbook` from the
command line.  

Navigate to the inventories screen by clicking on the **Inventories** link in the sidebar.

Explore the existing **AWS Inventory**.  This is a dynamic inventory that automatically updates to
get the current real-time view of EC2 assets before every job run.  This inventory contains
all the hosts for todays lab.  Please don't break it!

Now return back to the inventory screen and click the green **+** button to create a new inventory
just for you.

<img src="/images/ansible_essentials/tower_inventories_before.png" style="margin-left:2em;max-width:90%;">

Fill out the data collector as follows then click the save button:

* **Name** - Your student ID followed by inventory, e.g. `student0-inventory`

<img src="/images/ansible_essentials/tower_new_inventory1.png" style="margin-left:2em;max-width:90%;">

Now click on the **Groups** link and the green **+** button to add a new group.

<img src="/images/ansible_essentials/tower_new_inventory2.png" style="margin-left:2em;max-width:90%;">

Fill out the data collector as follows then click the save button:

* **Name** - `web`

<img src="/images/ansible_essentials/tower_new_inventory3.png" style="margin-left:2em;max-width:90%;">

Click on the **Hosts** link followed by the green **+** button to add a new host the the `web` group
that you just created.

<img src="/images/ansible_essentials/tower_new_inventory4.png" style="margin-left:2em;max-width:90%;">

Fill out the data collector as follows then click the save button:

* **Host Name** - Enter the private IP address of your assigned web server

<img src="/images/ansible_essentials/tower_new_inventory5.png" style="margin-left:2em;max-width:90%;">


###  Exercise 2.26 - Creating Job Templates

Navigate to the templates screen by clicking on the **Templates** link in the sidebar.
Click the green **+** to create a new template of type **Job Template**.

Fill out the data collector as follows then click the save button:

* **Name** - Your student ID followed by install apache, e.g. `student0-install-apache`
* **Inventory** - Select the inventory you created that's tagged with your student ID
* **Project** - Select the project you created that's tagged with your student ID
* **Playbook** - Select the `install apache` playbook you created during the roles exercise
* **Credential** - Select the `student-ssh-user` credential

<img src="/images/ansible_essentials/tower_new_template1.png" style="margin-left:2em;max-width:90%;">

After saving your name template navigate back to the list of templates and click the **Rocketship**
icon to the right of the template you just created.  This will start the template running.
It may take a few moments for the job to complete - among other work Tower is reaching out to
Gitlab to make sure it is using the most recent version of your playbooks.

<img src="/images/ansible_essentials/tower_new_template2.png" style="margin-left:2em;max-width:90%;">

When the job is complete it should show green and success.

<img src="/images/ansible_essentials/tower_template_job1.png" style="margin-left:2em;max-width:90%;">


### Exercise 2.27 - Modifying the Parameters in your Playbook

Remember those variables we created when setting up Apache on your web server?  We hard coded those
within the playbook.  Obviously that isn't best practice outside of a learning environment.  Ansible
Tower let's us overwrite those variables either when defining the job template or at run time.

Edit your job template again and check the **Prompt at Launch** box to the right of the **Extra Vars**
text area at the bottom of the screen then save your template again.

<img src="/images/ansible_essentials/tower_new_template3.png" style="margin-left:2em;max-width:90%;">

Now try to execute your template a second time.  You should see a prompt for **Extra Vars**.
Enter the following text then click the **Next** and **Launch** buttons.

```
---
httpd_test_message: This message was updated from Ansible Tower
```

<img src="/images/ansible_essentials/tower_job2.png" style="margin-left:2em;max-width:90%;">

As the job runs notice that the **Extra Vars** you supplied are visible and that the job itself makes
changes to the target server (visible by the orange coloring).

<img src="/images/ansible_essentials/tower_job3.png" style="margin-left:2em;max-width:90%;">

Navigate to your web server again (or use `curl`) and verify that the message has changed.
Remember that your server may be running on port `81` or `82`.  I bet you can change the port
from within Tower as well.



