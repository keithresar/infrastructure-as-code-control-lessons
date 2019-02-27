# Creating a Project

A Project is a logical collection of Ansible playbooks, represented in Tower.

You can manage playbooks and playbook directories by placing them into a source code management 
(SCM) system supported by Tower, including Git, Subversion, Mercurial, and Red Hat Insights. 

<hr>

### 💪  Exercise 4.3 - Creating a Project

Get started by navigating to the **Projects** page, whose link is towards the top-left of the screen.

Add a new project with the following properties:

 - **Name** - `workshop - studentX` (replace with your unique student username)
 - **SCM Type** - Git
 - **SCM URL** - `https://github.com/keithresar/ansible-tower-demo`
 - Select the box **Update on Launch**
 - *The remaining fields can be left as is*

Click **Save**.

<img src="/images/tower_project.png" style="margin-left:2em; max-width: 80%; margin-bottom:1em;">

Witin a few seconds, the bottom portion of the screen will update to indicate the playboks located in
the git repository referenced have been successfully checked out and are accessible:

<img src="/images/tower_project_list.png" style="margin-left:2em; max-width: 80%; margin-bottom:1em;">


### 💪  Exercise 4.4 - Viewing Permissions

Click on the **Permissions** link.

 - What permissions were added by default?
 - How would you add permissions for an individual user?  
 - How would you add permissions for an entire team?  What permissions role would you use?

<img src="/images/tower_project_permissions.png" style="margin-left:2em; width: 600px; margin-bottom:1em;">


### 📗 Resources

 - [Ansible Tower Projects User Guide](http://docs.ansible.com/ansible-tower/latest/html/userguide/projects.html)

