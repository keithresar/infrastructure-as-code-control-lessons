# Verifying Connectivity

Now that Ansible is (hopefully) configured in for your lab we need to verify everything is working as expected.

None of the rest of our work will succeed if this test fails.

<hr>

### Exercise 2.3 - Ansible Ping

Ansible includes a `ping` module - but this is far more than a simple network ICMP ping.

The Ansible `ping` module reports on a minimum level of functionality required for successful
automation.  This module will perform the following tests for you:

* Verify functional `ansible.cfg`
* Verify valid `inventory` file
* Confirm network (ssh) connectivity
* Verify successful authentication
* Verify target host pre-reqs (primarily `python`)

If all of the above succeed then this job will return success.

While we can write a playbook for this simple test, this is most often done via the command
line instead (fun fact - you can do a LOT with Ansible via the command line, but this clearly
breaks a typical infrastructure and code mission statement).

From your terminal enter the following command:

```
> cd /projects/infrastructure-as-code/
> ansible all -m ping
```

Ansible also includes a similar module for Windows servers called `win_ping`.  The difference with this
module is that is execute PowerShell instead of python.


### ☢ Exercise 2.3 Results

A successful response will be colored in green and look like the following:

```
10.10.11.220 | SUCCESS => {
    "changed": false,
    "ping": "pong"
}
10.10.10.226 | SUCCESS => {
    "changed": false,
    "ping": "pong"
}
```


### Exercise 2.4 - Ansible Ping via Playbook

We all agree that ad-hoc actions via the command line don't align to our mission.  
No problem.  We can accomplish the same thing via an Ansible playbook.

Change to the `2.4_ping/` directory.  Inside the directory you will find a the file `ping.yaml`.
You can open this file if you'd like - but don't try to make too much sense of it yet.  We'll
learn about all the part.

Execute the file with the following command line to run the same test:

```
> cd /projects/infrastructure-as-code-lab/2.4_ping/
> ansible-playbook ping.yml
```


### ☢ Exercise 2.4 Results

A successful response will look like the following:

```
TASK [Gathering Facts] ***********************************************************************************************************************************************************************************************************************************************************************************************************
ok: [10.10.11.220]
ok: [10.10.10.226]

TASK [Verify host connectivity] **************************************************************************************************************************************************************************************************************************************************************************************************
ok: [10.10.11.220]
ok: [10.10.10.226]

PLAY RECAP ***********************************************************************************************************************************************************************************************************************************************************************************************************************
10.10.10.226               : ok=2    changed=0    unreachable=0    failed=0
10.10.11.220               : ok=2    changed=0    unreachable=0    failed=0
```


### 📗 Resources

 - [Ansible ping module](http://docs.ansible.com/ansible/latest/ping_module.html)

