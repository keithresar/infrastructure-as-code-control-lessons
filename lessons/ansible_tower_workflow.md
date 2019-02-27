# Implementing a Workflow

Workflows allow you to configure a sequence of disparate job templates that may or may 
not share inventory, playbooks, or permissions. However, workflows have ‘admin’ and ‘execute’ 
permissions, similar to job templates. A workflow accomplishes the task of tracking the full 
set of jobs that were part of the release process as a single unit.

Job templates are linked together using a graph-like structure called nodes. Job template nodes 
are associated with job templates. A job template can be a part of different workflows or used 
multiple times in the same workflow. A copy of the graph structure is saved to a workflow job 
when you launch the workflow.

As the workflow runs, jobs are spawned from the node’s linked template. Nodes linking to a job 
template which has prompt-driven fields (job_type, job_tags, skip_tags, limit) can contain those 
fields, and will not be prompted on launch. Job templates with promptable credential and/or 
inventory, WITHOUT defaults, will not be available for inclusion in a workflow.

A node can have only one parent and can only have children that is linked to a state of success, 
failure, or always. If always, then the state is neither success or failure. States apply at the 
node level, not at the workflow job template level. A workflow job will be marked as successful 
unless it is canceled or encounters an error.

Over the next series of exercises you will create a number of new job templates and incorporate
them into a workflow.  The workflow today will encompass a new server provisiom and applicatio
deployment.

<hr>


### 💪  Exercise 4.8 - Create Job Templates

Create a number of new job templates, as specified below:
(You can do this by starting each from scratch, or by duplicating an existing template and
changing only the fields that differ)

 - Server Provision
   - *This one is already done*
 - Application Runtime Install
   - **Name** - `WF - 2 - App Runtime`
   - **Inventory** - Select your inventory
   - **Project** - Select your project
   - **Playbook** - Select `wf_App.yml`
   - **Credential** - Select your `control server` credential
   - *The remaining fields can be left as is*
 - Application Test and Deploy
   - **Name** - `WF - 3 - App Runtime`
   - **Inventory** - Select your inventory
   - **Project** - Select your project
   - **Playbook** - Select `wf_App.yml`
   - **Credential** - Select your `control server` credential
   - *The remaining fields can be left as is*
 - Server Deprovision
   - **Name** - `WF - 4 - Destroy`
   - **Inventory** - Select your inventory
   - **Project** - Select your project
   - **Playbook** - Select `wf_Destroy.yml`
   - **Credential** - Select your `control server` credential
   - *The remaining fields can be left as is*
 - Maintenance Start
   - **Name** - `WF - 0 - Maintenance Start`
   - **Inventory** - Select your inventory
   - **Project** - Select your project
   - **Playbook** - Select `wf_MaintenanceStart.yml`
   - **Credential** - Select your `control server` credential
   - *The remaining fields can be left as is*
 - Maintenance End
   - **Name** - `WF - 5 - Maintenance End`
   - **Inventory** - Select your inventory
   - **Project** - Select your project
   - **Playbook** - Select `wf_MaintenanceEnd.yml`
   - **Credential** - Select your `control server` credential
   - *The remaining fields can be left as is*

Once complete, your list of job templates should resemble the image below:

<img src="/images/tower_template_list_workflow_templates.png" style="margin-left:2em; max-width: 80%; margin-bottom:1em;">


### 💪  Exercise 4.9 - Create the Workflow

After creating the job templates that cover a handful of different playbooks we will now
string them together in a workflow.

Click to add a new **Workflow Template** (rather than the *Job Template* that you have been
using thus far).

When the Job Workflow details screen comes up, then complete the following:

 - **Name** - Enter `App Provision Workflow`
 - Hit the **Save** button

Click the **Add Survey** button, then complete the following within the survey dialog:

 - Add first survey
   - **Prompt** - Enter `Give student ID`
   - **Answer Variable Name** - Enter `owner`
   - **Answer Type** - Select `Text`
 - Add second survey
   - **Prompt** - Enter `Give Change Control Ticket #`
   - **Answer Variable Name** - Enter `tickets_id`
   - **Answer Type** - Select `Text`
 - Click the **Add** button
 - Click the **Save** button

Click the **Workflow Editor** button, then complete the following as shown below:

 - Click **Start**
 - Select **WF - 0 - Maintenance Start**
 - Click **Select**

<img src="/images/tower_workflow_start.png" style="margin-left:2em; max-width: 80%; margin-bottom:1em;">

Repeat by adding the followig additional jobs into the workflow:

 - Mouseover **WF - 0 - Maintenance Start** and click the green **+** button to add another template
   - Select **WF - 1 - Server**
   - Type set **Always**
   - Click **Select**
 - Mouseover **WF - 1 - Server** and click the green **+** button to add another template
   - Select **WF - 2 - App Runtime**
   - Type set **On Success**
   - Click **Select**
 - Mouseover **WF - 2 - App Runtime** and click the green **+** button to add another template
   - Select **WF - 3 - App Deploy**
   - Type set **On Success**
   - Click **Select**
 - Mouseover **WF - 2 - App Runtime** and click the green **+** button to add another template
   - Select **WF - 4 - Destroy**
   - Type set **On Failure**
   - Click **Select**
 - Mouseover **WF - 3 - App Deploy** and click the green **+** button to add another template
   - Select **WF - 5 - Maintenance End**
   - Type set **On Always**
   - Click **Select**
 - Mouseover **WF - 4 - Destroy** and click the green **+** button to add another template
   - Select **WF - 5 - Maintenance End**
   - Type set **On Always**
   - Click **Select**

Once complete, your workflow should resemble the image below:

<img src="/images/tower_workflow_editor.png" style="margin-left:2em; max-width: 80%; margin-bottom:1em;">


### 💪  Exercise 4.10 - Create Your Change Request Ticket

Return to the **Ansible Workshop** site where this lesson is hosted, and click on the
**[TicketsNow](/i/tickets)** link on the top navbar.

Scroll to the bottom of the left sidebar and click the **Create New Ticket** button.

Create a new ticket with:

 - **Subject** - Enter `studentX Application Release`
 - **Body** - Enter any text that makes you feel good
 - Click the **Create Ticket** button
 - Take note of the **Ticket ID**, which will be in gray towards the top left of the newly
   created ticket


### 💪  Exercise 4.12 - Execute Your Workflow

Return to the Ansible Tower page, and launch the worjkflow by clicking on the **Rocket Ship**
link towards the right of the Workflow entry in the list.

<img src="/images/tower_workflow_launch.png" style="margin-left:2em; max-width: 80%; margin-bottom:1em;">

Take note of the following:

 - When you click **Launch**, a survey dialog pops up.  Enter your student username (studentX) and
   the number of the change ticket you just created then press **Launch** again to start the job
 - When the job starts, note the **Extra Variables** section in the bottom-left of the screen -
   this is now populated with the survey variable you added
 - As the worlflow progresses, you can get details on the individual job templates

<img src="/images/tower_workflow_launch_progress.png" style="margin-left:2em; max-width: 80%; margin-bottom:1em;">


### 📗 Resources

 - [Ansible Tower Workflow User Guide](https://docs.ansible.com/ansible-tower/latest/html/userguide/workflows.html)

