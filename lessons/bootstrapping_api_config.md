# API Configuration

Our solution is running one internal microservice accessable via http/json which acts as an API
for the web front-end delivered in the previous exercise.

The API service is run inside a docker container.  It has a dependency in that it calls out to an external
service.

During this series of exercises you will create the container image for the API service and launch it
on the api server.


<hr>


### Exercise 3.10 Checkout API source code and build container image

The API source code is available from the following git repo:

```
https://github.com/keithresar/infrastructure-as-code-language-api
```

Infosec requires there be no source code residing on our application servers, so check this code
to localhost and build the image locally before pushing it to the image registry.

Tag your image with your student username to avoid conflicts (e.g. `api-student0`).


** Hints **

*Hints are hidden behind **spoiler** tags.  You can view the text associated with these hints by highlighting the space to the right of the *spoiler* placeholder text.*

How do I build a container with Ansible?
! Use the docker_image module

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

Accessing the LanguageLayer API key
! While you could do a one-time copy/paste to embed the API key into your playbook, that won't fly with infosec.  Therefore use a file type of loopup to pull this in dynamically

Error messages deploying docker container regarding SSL or connection errors
! Is docker even installed and running?  Login to your api server and work with the docker cli

Error message indicating error pulling image due to http response to https client
! We're doing everything via plaintext in this lab, so you need to add an insure-registry flag to the docker daemon and make sure it restarted.  Add the following (you will need to change the IP of course) to /etc/sysconfig/docker: INSECURE_REGISTRY="--insecure-registry 10.10.12.117:5000".



### Exercise 3.12 Connecting web to API server

On your web server in the file `/var/www/html/configure.php` there are two variables.
Replace these with the IP address and port where your API server is listening.

You can view the actual files for the web site by logging into your web server via ssh from the CHE terminal, or
by reviewing the files from the Git repo where they are hosted:

https://github.com/keithresar/infrastructure-as-code-web


** Target State **

Changes take affect immediately on reloading the web page.
Verify that searching for a valid URL returns a result.  If not, the error may be in the web -> api communication
or the api -> languagelayer communication.

<img src="/images/bootstrapping/web2.png" style="margin-left:2em;max-width:90%;">


** Extra Credit **

* Can you add another task that uses the URI module to verify change success?  You will want to hit the endpoint `http://{{ inventory_hostname }/api?url=http://www.yahoo.com`.  Make sure the status is 200 for success



** Hints **

*Hints are hidden behind **spoiler** tags.  You can view the text associated with these hints by highlighting the space to the right of the *spoiler* placeholder text.*


Make sure you are working in the right server!
! This work occurs in the on the web server and not the api server from the earlier exercises

Verifying if API requests are going from web -> API
! login to API server and execute: 'docker logs -f api1' to show logs of incoming requests

I give up!
! Look at the solutions in the file /projects/infrastructure-as-code-lab/translation_wizard_SOLUTIONS_SECTION_3/web/3.12_api_variables.yml.


### 📗 Resources

