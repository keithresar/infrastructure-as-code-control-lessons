# Verifying Connectivity

Now that Ansible is (hopefully) configured in for your lab we need to verify everything is working as expected.

None of the rest of our work will succeed if this test fails.

<hr>

### 💪  Exercise 2.3 - Ansible Ping

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
line instead (fun facts - you can do a LOT with Ansible via the command line, but this clearly
breaks a typical infrastructure and code mission statement).

From your terminal enter the following command:

```
> ansible all -p ping
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


### 📗 Resources

 - [Ansible ping module](http://docs.ansible.com/ansible/latest/ping_module.html)

