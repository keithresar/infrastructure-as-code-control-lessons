# Web Server Configuration

The web server must respond to web requests on the standard http port 80.
It will serve dynamic content generated locally via PHP and sourced from another microservice
that you'll create in a later execrise.

<hr>


### Exercise 3.6 Install packages

Install the following packages onto the web server.  

* httpd
* php

Also, make sure the web server is accessible via port 80 and that the service continues to run post-boot.

** Post State **

A `curl` or web  browser request to the web server returns the test page you created in a previous exercise.


** Extra Credit **

* Find two ways for yum to install multiple packages (investigate `loop:` and the [yum module](https://docs.ansible.com/ansible/latest/modules/yum_module.html) documentation for the `name` parameter)
* What would you do if you want the most recent version of your packages installed instead of just having any version present?
* Can you rewrite this play to use a list of packages defined in a variable instead of hardcoded?


** Hints **

*Hints are hidden behind **spoiler** tags.  You can view the text associated with these hints by highlighting the space to the right of the *spoiler* placeholder text.*

How do I install packages?
! Investigate the yum module

How do I install change the httpd port?
! Investigate the lineinfile module

How do I start the web server?
! Investigate the service module



### Exercise 3.7 Deploy web site content

The web content is available from the following git repo:

```
https://github.com/keithresar/infrastructure-as-code-web
```

Clone this content to `/var/www/html`.  Consider how to handle the private `.git/` subdirectory.  Also
cosider how to manage local changes and updates to the content from the git source.

** Post State **

A web browser request to the web server returns the following:

<img src="/images/bootstrapping/web1.png" style="margin-left:2em;max-width:90%;">


** Extra Credit **

* We don't want our `.git/` directory hosted on a web site, that would be crazy. How can we prevent `.git/` from being exposed (this could be another task, or maybe an option in the git module documentation)


** Hints **

*Hints are hidden behind **spoiler** tags.  You can view the text associated with these hints by highlighting the space to the right of the *spoiler* placeholder text.*

How do I checkout code from a git repo?
! Investigate the git module

I get an error about git not being in my path
! You should install the git package with yum!



### Exercise 3.8 Test Functionality

Verify that the localhost can successfully get a 200 response code from
the target web site.  You may want to verify this fails by disabling the
service.


### 📗 Resources


