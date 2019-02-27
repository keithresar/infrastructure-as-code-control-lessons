# Connecting to the Control Server

All of your activity during this and subsequent labs occurs on a control node.  The control
node is a Red Hat Linux server that:

 - Has the Ansible toolset installed
 - Is where all automation activities are initiated
 - Is your virtual home for the rest of the day
Today’s workshop infrastructure is being run in a cloud environment.
Each student will be assigned a number, e.g. student, student2, student3.
 
Your instructor will supply you with a web site url or paper where you will find detailed info 
for your own personal lab environment.

 - Control node - used to develop and run Ansible playbooks
 - Lab node(s) - target for all Ansible playbooks
 - Username, password - used to authenticate to all servers.  Each participant has a unique login.
   Please only use your login to prevent unintended errors for other students

<hr>

### 💪  Exercise 1.1 - Connect to control server
Before we can begin doing super-cool automations and such, we’ve got to get a few basics out of 
the way. Namely… ssh access to your control server.  Connect to your Red Hat Linux control server 
using ssh.  

If your laptop if Linux or Mac-based, the ssh command below will get you connected.  Replace `username`
with your unique username.  Authenticate with the supplied password.

```
> ssh username@control-server
```

For example, if the control server was at 192.168.30.1 and your username was student:

```
> ssh student@192.168.30.1
```

If your laptop is Windows-based we recommend you download the [putty.exe](http://www.putty.org/).

<img src="/images/putty_screenshot.png" style="margin-left:2em;max-width:50%;">

Be sure you can log in to your control server!
If you can’t log in start shouting, loudly, and waving your hands!

### ☢ Exercise 1.1 Results

At this point, everyone should have logged into each of your control node. 

If you haven’t, let us know so we can get you fixed up.

### 📗 Resources

 - Windows ssh client [putty.exe](http://www.putty.org/)

