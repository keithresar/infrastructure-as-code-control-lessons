# Lorem ipsum


<hr>

### Exercise 7.1 Rebooting your servers

From Ansible Tower you can execute the job **Exercise 7.1 Reboot** to reboot your web and API servers.

Once the servers come online check if your services are accessible and online as expected.  
Can you fix any gaps permanently by changing your automation?


### Exercise 7.2 Mystery

From Ansible Tower you can execute the job **Exercise 7.2 Mystery**.

Test your application and identify if anything is misbehaving.  Execute your playbook to verify whether
this fixes the problem.  

Look at the Ansible log and investigate what was changed to fix this.
This is how infrastructure as code can be used to mitigate configuration drift.


### Exercise 7.3 Mystery

From Ansible Tower you can execute the job **Exercise 7.3 Mystery**.

Test your application and identify if anything is misbehaving.  Execute your playbook to verify whether
this fixes the problem.  

What could you add to your playbook to not only fix the issue but more importantly test to verify expected
functionality?


** Hints **

*Hints are hidden behind **spoiler** tags.  You can view the text associated with these hints by highlighting the space to the right of the *spoiler* placeholder text.*

Hint 1
! Is your API server able to initiate outbound connections?

Hint 2
! AWS Security Groups have a default permit all if the egress policy is empty.  Adding a single rule to this policy blocks all other traffic



