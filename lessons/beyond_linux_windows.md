# Windows Automation

As you have already experienced, ansible manages Linux/Unix machines using SSH by default.

Starting in version 1.7, ansible added support for managing Windows machines. This uses native 
PowerShell remoting, rather than SSH.

Ansible will still be run from a Linux control machine, and uses the “winrm” Python module to talk 
to remote hosts. While not supported by Microsoft or Ansible, this Linux control machine could be 
a Windows Subsystem for Linux (WSL) bash shell.

No additional software needs to be installed on the remote machines for ansible to manage them, it 
still maintains the agentless properties that make it popular on Linux/Unix.

One difference you will notice with the Windows-specific ansible modules is there naming.  All
Windows module are prefixed by a `win_` delimiter.


<hr>

### 💪  Exercise 3.1 - Add Your Windows Server to Your Inventory

Open the `inventory` in your home directory.  Add the IP address associated with the
Windows server you’ve been assigned under the `windows_web` group.

While the file is open, take special note of:

 - Where the `windows_servers` group is defined.  What is it’s relationship to `windows_web`?
 - Review the group `windows_servers:vars`.  What is being defined here?

There is some one-time setup to gain access to Windows servers, both for ansible (which you have
already completed) and on the Windows server itself.  We have already completed the Windows server
configuration on your behalf.

To validate proper connectivity, authentication, and software pre-reqs on the Windows host we will
again use an ad-hoc command and ping the host.  Enter the following command and update your
settings until it is successful.

```
> ansible windows_web -m win_ping
```

If your setup is functioning as expected, you will see a green response similar to the following
(again, ignore the color coding in this lesson - everything will be green on success):

```
192.168.30.2 | SUCCESS => {
    "changed": false,
    "failed": false,
    "ping": "pong"
}
```


### 💪  Exercise 3.2 - Adding a Local User to Your Windows Server

Create a new file `windows_essentials.yml` and add the following content to it:
(make sure to modify the `name` value to your unique student username).

```
- hosts: windows_web

  tasks:
    - name: add user operator
      win_user:
        name: studentX
        password: 0p$4@ll
```

This task addresses a different group of servers that we have worked with to date, note the
`hosts: windows_web` reference.

Even though we are talking to a different platform, doesn’t the playbook look identical to what
you expect so far?

Execute the playbook:

```
> ansible-playbook windows_essentials.yml
```

Verify success by opening an RDP connection to your Windows server and logging in.
(Please logout quickly to free consoles for other participants as this is a shared server).


### 💪  Exercise 3.3 - Modifying the Windows Registry

Let’s try another common task for Windows servers, working with the Registry.  Ansible includes a full suite
of registry tools in the [win_regedit module](http://docs.ansible.com/ansible/latest/win_regedit_module.html).

Edit your `windows_essentials.yml` file again and add a second to it:
(make sure to modify the `name` value to your unique student username).


```
    - name: Add or update the registry to leave your mark
      win_regedit:
        key: HKCU:\Software\Ansible
        name: student
        data: foo
```

Execute the playbook:

```
> ansible-playbook windows_essentials.yml
```

### 💪  Exercise 3.4 - Creating a Windows IIS Web Site

We’ve done it with Linux/Apache, now let’s do the same with Windows/IIS.

Create a new playbook named `windows_web.yml` and add the following content:
(make sure to modify the `studentX` values to your unique student username).

```
- hosts: windows_web
  vars:
    student_username: studentX

  tasks:
    - name: Install Web Server
      win_feature:
        name: Web-Server
        state: present

    - name: Create web directory
      win_file:
        path: "c:\\www\\{{ student_username }}"
        state: directory

    - name: Create web index
      win_lineinfile:
        path: "C:\\www\\{{ student_username }}\\index.html"
        create: yes
        line: "Hello World from {{ ansible_hostname }} at {{ ansible_ssh_host }} by {{ student_username }}"

    - name: Build web site
      win_iis_website:
        name: "{{ student_username }} Web site"
        hostname: "{{ student_username }}.{{ ansible_ssh_host }}.xip.io"
        physical_path: "c:\\www\\{{ student_username }}"
```

Execute the playbook:

```
> ansible-playbook windows_web.yml
```

Verify your web server was successfully setup by pointing your browser at the URL:
(substitute `studentX` for your student username, and `WindowsIPAddress` with the IP
address for your 

```
http://studentX.WindowsIPAddress.xip.io
```


### 📗 Resources

 - [Ansible intro to Windows](http://docs.ansible.com/ansible/latest/intro_windows.html)
 - [Ansible win_ping module](http://docs.ansible.com/ansible/latest/win_ping_module.html)
 - [Ansible win_user module](http://docs.ansible.com/ansible/latest/win_user_module.html)
 - [Ansible win_regedit module](http://docs.ansible.com/ansible/latest/win_regedit_module.html)
 - [Ansible win_feature module](http://docs.ansible.com/ansible/latest/win_feature_module.html)
 - [Ansible win_file module](http://docs.ansible.com/ansible/latest/win_file_module.html)
 - [Ansible win_lineinfile module](http://docs.ansible.com/ansible/latest/win_lineinfile_module.html)
 - [Ansible win_iis_website module](http://docs.ansible.com/ansible/latest/win_iis_website_module.html)
 

