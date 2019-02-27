# Connecting Via ssh

Access to the control server is required to run the ansible tools.  There are several methods available
for gaining access.

### Mac or Linux via ssh

Mac and Linux workstations have an ssh client built in.  

Open a terminal window, then enter the following command.  You will need to specify your user and password:

```
> ssh username@hostname
```

For example, if your username was "student" and your control node was "ansibleallthethings.com", the proper command is:

```
> ssh student@ansibleallthethings.com
```


### Windows via putty

If your laptop is Windows-based we recommend you download the [putty.exe](http://www.putty.org/) program.

<img src="/images/putty_screenshot.png" style="margin-left:2em;max-width:50%;">

### Web-ui via Terminal Session

Click on the "Terminal Session" link.  You will be prompted for a username and password only once - if you enter
these incorrectly you will need to restart your browser to clear the cache.


