# Adding Surveys to Your Template

Job types of Run or Check will provide a way to set up surveys in the Job Template creation 
or editing screens. Surveys set extra variables for the playbook similar to ‘Prompt for Extra 
Variables’ does, but in a user-friendly question and answer way. Surveys also allow for validation 
of user input. Click the survey button to create a survey.

Use cases for surveys are numerous. An example might be if operations wanted to give developers 
a “push to stage” button they could run without advanced Ansible knowledge. When launched, this task 
could prompt for answers to questions such as, “What tag should we release?”

Many types of questions can be asked, including multiple-choice questions.

<hr>


### 💪  Exercise 4.7 - Adding a Survey to Your Job Template

Return to  the **Templates** page, whose link is towards the top-left of the screen.

Edit the template by clicking on the edit button:

<img src="/images/tower_template_edit.png" style="margin-left:2em; max-width: 80%; margin-bottom:1em;">

Click the blue **Add Survey** button inside your template.

In the **Add Survey Prompt** field, enter the following:

 - **Prompt** - Enter `Give Asset Type to Provision`
 - **Answer Variable Name** - Enter `type`
 - **Answer Type** - Enter `Text`

Complete by clicking the **Add** button then then **Save** button to close the dialog.
  
Launch this updated template by clicking on the **Rocket ship** link towards the right 
side of the list.

<img src="/images/tower_template_launch.png" style="margin-left:2em; max-width: 80%; margin-bottom:1em;">

Take note of the following:

 - When you click **Launch**, a survey dialog pops up.  Enter any text you would like then click
   **Launch** again to start the job
 - When the job starts, note the **Extra Variables** section in the bottom-left of the screen -
   this is now populated with the survey variable you added
 - As the job completes, look to **line 18** which has been re-written from `Harden Server` to
   make use of your variable

<img src="/images/tower_template_survey_results.png" style="margin-left:2em; max-width: 80%; margin-bottom:1em;">


### 📗 Resources

 - [Ansible Tower Job Templates Surveys User Guide](http://docs.ansible.com/ansible-tower/latest/html/userguide/job_templates.html#surveys)

