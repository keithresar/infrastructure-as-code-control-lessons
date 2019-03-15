# Deploying Multiple API Containers

By paramaterizing more of the automation you've already written, and with the use
of some looping, you should be able to quickly scale-out the fleet of API containers.

<hr>

### Exercise 5.12 Deploy multiple API containers

Introduce a variable to define how many API containers to deploy.

In your `api` role loop over this variable to deploy the specified number of containers.

You will need to start each container to listen on a unique host port (perhaps incrementing
from 8080 to 8081, 8082, etc.)


### Exercise 5.13 Permit traffic through the API security group

Make sure traffic is permited to flow inbound to the API server using the API security group
by adding any new ports the containers are listening on.

Verify success by issuing a `curl api:8081` command from your web server.


### Exercise 5.14 Add containers to load balancer

Add the additional container ports to the load balancer pool.

If you login to the F5 web UI you should see the containers are aliven and are receiving traffic.


