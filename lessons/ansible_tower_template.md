# Your First Job Template

A job template is a definition and set of parameters for running an Ansible job. Job templates are 
useful to execute the same job many times. Job templates also encourage the reuse of Ansible playbook 
content and collaboration between teams. 

To reiterate, the job template is where we see the marriage of:

 - Access (via the credential you created)
 - Targets (these are the servers you will communicate with, and we have already created one on your behalf)
 - Automation (these are the playbooks we write, which are pulled in by the project you created)

<hr>

### 💪  Exercise 4.5 - Create Your First New Job Template

Get started by navigating to the **Templates** page, whose link is towards the top-left of the screen.

Add a new template with the following properties:

 - **Name** - `WF - 1 - Server`
 - **Inventory** - Select your inventory
 - **Project** - Select your project
 - **Playbook** - Select `wf_Server.yml`
 - **Credential** - Select your `control server` credential
 - *The remaining fields can be left as is*

Click **Save**.

<img src="/images/tower_template.png" style="margin-left:2em; max-width: 80%; margin-bottom:1em;">


### 💪  Exercise 4.6 - Launch Your First Job Template

The playbook in this first template simulates provisioning a new server.  Launch this template
by clicking on the **Rocket ship** link towards the right side of the list.

<img src="/images/tower_template_launch.png" style="margin-left:2em; max-width: 80%; margin-bottom:1em;">

The screen will change and give you a real-time view of the playbook run.  The playbook will run
against the servers in your inventory using the credentials you specified in the job template
definition.

<img src="/images/tower_template_execute.png" style="margin-left:2em; max-width: 80%; margin-bottom:1em;">

As the job completes, explore around the screen.  Take notice of:

 - The **Details** section, which provides links to all the elements that composed the job template
 - Click on line 10 to view the **log details**
 - The **search bar** on top of the run log.  Search for `tz_offset` and notice the log filter


### 📗 Resources

 - [Ansible Tower Job Templates User Guide](http://docs.ansible.com/ansible-tower/latest/html/userguide/job_templates.html)

