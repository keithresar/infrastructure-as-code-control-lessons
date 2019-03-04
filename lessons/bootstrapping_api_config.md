# API Configuration

Our solution is running one internal microservice access via http/json which acts as an API
for the web front-end delivered in the previous exercise.

The API service is delivered via a container.  It has a dependency in that it calls out to an external
service.

During this series of exercises you will create the container image for the API service and launch it.

<hr>


### Exercise 3.9  Getting Setup

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

Create a new role called `api`.

Include this role in your `main.yml` playbook.


### Exercise 3.10 Checkout API source code

The API source code is available from the following git repo:

```
https://github.com/keithresar/infrastructure-as-code-language-api
```

Infosec requires there be no source code residing on our application servers, so check this code
out locally, build the image, then push it to the image registry.

Tag your image with your student username to avoid conflicts (e.g. `api-student0`).


** Original State **


** Target State **


** Hints **

*Hints are hidden behind **spoiler** tags.  You can view the text associated with these hints by highlighting the space to the right of the *spoiler* placeholder text.*

Missing Package Errors
! Then add the missing packages!  Make sure you do so on the correct server

SSL Connection Errors
! If you are getting errors related to SSL connections then change your parameters to force going via plaintext


### Exercise 3.11 Deploy Container onto API Server

The container you've just built needs to run on the API server.
Configure the container to run with the container name `api1` and listen
on port 8080.

You will need to pass an environment variable `LANGUAGELAYER_API_KEY` to the container 
that contains an API key to the external LangaugeLayer service that we'll be using.
This is defined in a file on your local server `/tmp/languagelayer_api_key`.


** Original State **


** Target State **

On API host:

```
> docker ps
CONTAINER ID        IMAGE                             COMMAND                  CREATED             STATUS              PORTS                    NAMES
af9f1a77fc4d        100.24.70.109:5000/api-student0   "container-entrypo..."   4 seconds ago       Up 3 seconds        0.0.0.0:8080->8080/tcp   api1
```

From bastion host curl returns response:
```
> curl http://10.10.11.217:8080
{"success": false, "error": "Required 'url' parameter missing"}
```

** Hints **

*Hints are hidden behind **spoiler** tags.  You can view the text associated with these hints by highlighting the space to the right of the *spoiler* placeholder text.*

Accessing the API key
! While you could do a one-time copy/paste to embed the API key into your playbook, that won't fly with infosec.  Therefore use a file type of loopup to pull this in dynamically

Error messages deploying docker container regarding SSL or connection errors
! Is docker even installed and running?  Login to your api server and work with the docker cli

Error message indicating error pulling image due to http response to https client
! We're doing everything via plaintext in this lab, so you need to add an insure-registry flag to the docker daemon and make sure it restarted.  Add the following (you will need to change the IP of course) to /etc/sysconfig/docker: INSECURE_REGISTRY="--insecure-registry 100.24.70.109"


### Exercise 3.12 Connecting web to API server

On your web server in the file `/var/www/html/configure.php` there are two variables.
Replace these with the IP address and port where your API server is listening.


** Target State **

Changes take affect immediately on reloaded the web page.
Verify that searching for a valid URL returns a result.  If not the error may be in the web -> api communication
or the api -> languagelayer communication.

<img src="/images/bootstrapping/web2.png" style="margin-left:2em;max-width:70%;">


** Hints **

*Hints are hidden behind **spoiler** tags.  You can view the text associated with these hints by highlighting the space to the right of the *spoiler* placeholder text.*


Verifying if API requests are going from web -> API
! login to API server and execute: 'docker logs -f api1' to show logs of incoming requests




### 📗 Resources


