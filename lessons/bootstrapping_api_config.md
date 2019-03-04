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


** Hints **

*Hints are hidden behind **spoiler** tags.  You can view the text associated with these hints by highlighting the space to the right of the *spoiler* placeholder text.*

Accessing the API key
! While you could do a one-time copy/paste to embed the API key into your playbook, that won't fly with infosec.  Therefore use a file type of loopup to pull this in dynamically


### 📗 Resources


