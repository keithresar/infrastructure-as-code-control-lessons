# Web Server Configuration

The web server must respond to web requests on the standard http port 80.
It will serve dynamic content generated locally via PHP and sourced from another microservice
that you'll create in a later execrise.

<hr>


### Exercise 3.5  Getting Setup

** Working Directory **

All work moving for the rest of the class will build on the previous exercise.

Your work will all reside within the `translation_wizard/` directory.

If you need a little help along the way you may reference the solutions that exist for every
exercise inside the `translation_wizard_SOLUTIONS/` directory.

** Working files **

Wherever possible we request you create an Ansible **Role** to package your automation rather than
writing everything directly inside of a single playbook.

Your final playbooks version should all reside in the existing `main.yml` file.

To ease testing (especially as you get to later exercises) you may want to create alternate files for
an easier *inner-loop* development instead of executing all of `main.yml`.  Alternately, effective use
of **[tags](https://docs.ansible.com/ansible/latest/user_guide/playbooks_tags.html)** will allow you to develop more maintainable code overall.

** Your First Practical Steps **

Change to the `translation_wizard/` directory.

Create a new role called `web`.

Include this role in your `main.yml` playbook.


### Exercise 3.6 Install packages

Install the following packages onto the server.  

* httpd
* php

Also, make sure the web server is accessible via port 80 and that the service continues to run post-boot.

** Post State **

A `curl` or web  browser request to the web server returns the test page you created in a previous exercise.



### Exercise 3.7 Deploy web site content

The web content is available from the following git repo:

```
https://github.com/keithresar/infrastructure-as-code-web
```

Clone this content to `/var/www/html`.  Consider how to handle the private `.git/` subdirectory.  Also
cosider how to manage local changes and updates to the content from the git source.

** Post State **

A web browser request to the web server returns the following:

<img src="/images/bootstrapping/web1.png" style="margin-left:2em;max-width:70%;">


### Exercise 3.8 Test Functionality

The web content is available from the following git repo:

```
https://github.com/keithresar/infrastructure-as-code-web
```

Clone this content to `/var/www/html`

** Post State **

A `curl` or web  browser request to the web server returns the following:

```
> curl web
```


** Hints **

*Hints are hidden behind **spoiler** tags.  You can view the text associated with these hints by highlighting the space to the right of the *spoiler* placeholder text.*



### 📗 Resources


