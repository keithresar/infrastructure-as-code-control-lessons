# F5 Load Balancing

To get more resiliency and capacity with our API container the firest step is to
leverage a load balancer onto which we can eventually enable horizontal scaling.

Note that the F5 is shared resource amongst all students and all students have
administrator level access.  

* Please do not break other students configurations.
* Tag all your objects with your student name

<hr>

### Exercise 5.6 Adding a load balancer to your inventory

Modify the inventory file inside the `infrastructure-as-code/` directory.

Add the private IP address associated with your F5 to the `[loadbalancer]` group.


### Exercise 5.7 Creating an API pool

Inside your role create another task that creates a pool for our API container using the
[bigip_node module](https://docs.ansible.com/ansible/latest/modules/bigip_pool_module.html).

Use the following parameters for the provider:

* `server: "{{ ansible_ssh_host }}"`
* `server_port: 8443`
* `validate_certs: no`
* `user: "{{ student_user }}"`
* `password: "{{ student_password }}"`

Use the following parameters to the module:

* `name: "{{ student_user }}-pool"`
* `lb_method: round-robin`
* `monitors: /Common/http`
* `monitor_type: and_list`

Make sure to set `connection: local` and `gather_facts: False`.


### Exercise 5.8 Adding pool members

Inside your role create another task that adds members to the pool for our API container using the
[bigip_pool_member module](https://docs.ansible.com/ansible/latest/modules/bigip_pool_member_module.html).


### Exercise 5.9 Creating VIP for pool

Inside your role create another task that creates a vip for our API container pool using the
[bigip_virtual_server module](https://docs.ansible.com/ansible/latest/modules/bigip_virtual_server_module.html).

Use the following parameters to the module:

* `name: "{{ student_user}}-vip"`
* `port: "80{{ '%02d'|format(student_number|int) }}"`
* `enabled_vlans: "all"`
* `all_profiles: ['http','oneconnect']`
* `pool: "{{ student_user }}-pool"`
* `snat: "Automap"`

** Target State **

Issue a curl to the VIP and your student port to verify traffic is flowing as expected.


### Exercise 5.10 Connecting to API role

While not explicitly noted before, this `f5` role should be called in conjunction with managing
your API container's instantiation.

This means the `ansible_ssh_host` variable will point to the API server not your load balancer.
However, you could do one of the following to access your load balancer IP address:

* In your inventory make the IP for your load balancer be a variable rather than a host
* Navigate the `groups['loadbalancer']` object



### Exercise 5.11 Connecting web to F5

On your web server in the file `/var/www/html/configure.php` there are two variables. 

Replace these with the IP address and port where your API server is listening.


### 📗 Resources

 - [bigip_node module](https://docs.ansible.com/ansible/latest/modules/bigip_node_module.html)

