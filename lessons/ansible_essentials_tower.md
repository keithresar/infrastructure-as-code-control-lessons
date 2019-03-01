# Ansible Tower Introduction

Red Hat Ansible Tower helps you scale IT automation, manage complex deployments and speed productivity. 
Centralize and control your IT infrastructure with a visual dashboard, role-based access control, job 
scheduling, integrated notifications and graphical inventory management. And Ansible Tower's REST API 
and CLI make it easy to embed Ansible Tower into existing tools and processes.

Up to this point you've been running your Ansible automation from the command line calling `ansible-playbook`
directly.  Ansible Tower let's you get more control over your automation.  Every object in Tower
(credentials, inventories, templates, etc.) has RBAC tied to it which allows most organizations to
safely delegate their automation.  A typical division of work might include:

* Functional owner (e.g. the load balancing management team) has write access to the
  credential, playbook, and the inventory.  They will create a job template referencing these.
* Junior admins, triage operators, or downstream consuming teams are delegating execute
  access to the automation that's been created and vetted by the functional owner.

<hr>

###  Exercise 2.22 - Accessing Ansible Tower

Navigate to the Ansible Tower Web UI and login with your student credentials.

<img src="/images/ansible_essentials/tower_login.png" style="margin-left:2em;max-width:70%;">

After logging in you'll see the Tower dashbaord.  Since your student account has full admin
permissions you'll also be able to see activity from others in the class.

<img src="/images/ansible_essentials/tower_dashboard.png" style="margin-left:2em;max-width:70%;">


###  Exercise 2.23 - Creating Credentials

We are going to create a credential so you can securely access your Gitlab project.

Navigate to the credentials screen by clicking on **Credentials** in the sidebar.
Then select the green **+** button to create a new credential.

<img src="/images/ansible_essentials/tower_credentials_before.png" style="margin-left:2em;max-width:70%;">

Fill in the data collector as follows:

* **Name** - Your student ID followed by gitlab, e.g. `student0-gitlab`
* **Credential Type** - Select `Source Control`
* **Username** - Your student ID
* **Password** - Your student password

<img src="/images/ansible_essentials/tower_new_credential.png" style="margin-left:2em;max-width:70%;">


###  Exercise 2.24 - Creating Projects

** Gitlab **
A project in Ansible Tower is equivalent to a project in Gitlab or a git repo - they all refer to the
same assets.  That being said, quickly navigate to the Gitlab instance so we can get the URL to access
your `infrastructure-as-code-lab` repo.

From your Gitlab project page click on the blue **Clone** button and copy the **Clone with HTTP** URL.

<img src="/images/ansible_essentials/gitlab_clone_with_http.png" style="margin-left:2em;max-width:70%;">


** Ansible Tower **

Back to Ansible Tower, navigate to the projects screen by clicking on the **Projects** link in the sidebar.
Then select the green **+** button to create a new project.

<img src="/images/ansible_essentials/tower_projects_before.png" style="margin-left:2em;max-width:70%;">

Fill out the data collector as follows then click the save button:

* **Name** - Your student ID followed by infrastructure-as-code, e.g. `student0-infrastructure-as-code`
* **SCM Type** - Select `Git`
* **SCM URL** - Paste the URL you copied from Gitlab.  You will need to modify the URL and append
  port `:8080` as shown in the picture below
* **SCM Credential** - Select the Gitlab credential tagged with your student ID that you created
* Check **Update revision on launch**

<img src="/images/ansible_essentials/tower_new_project.png" style="margin-left:2em;max-width:70%;">


###  Exercise 2.25 - Creating Inventories

Ansible Tower needs to know what hosts to act upon, just as when running `ansible-playbook` from the
command line.  

Navigate to the inventories screen by clicking on the **Inventories** link in the sidebar.

Explore the existing **AWS Inventory**.  This is a dynamic inventory that automatically updates to
get the current real-time view of EC2 assets before every job run.  This inventory contains
all the hosts for todays lab.  Please don't break it!

Now return back to the inventory screen and click the green **+** button to create a new inventory
just for you.


###  Exercise 2.26 - Creating Job Templates


###  Exercise 2.27 - Modifying the Parameters in your Playbook






### 📗 Resources

 - [git cheat sheet](https://services.github.com/on-demand/downloads/github-git-cheat-sheet.pdf)
 - [git branches in a nutshell](https://git-scm.com/book/en/v2/Git-Branching-Branches-in-a-Nutshell)

