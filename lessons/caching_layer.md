# Connecting API Application into a Caching Layer

Horizontal scaling as implemented in the previous section had a minimal impact on overall performance.
It turns out that the hotspot is really with another microservice (LanguageLayer) that our team
doesn't manage.

By introducing a caching layer within the services we do control we should have more impact over
performance and the overall cost of consuming downstream services.

<hr>

### Exercise 6.1 Deploy Elasticache

For our caching layer we make use of the native AWS Elasticache service.

Navigate to the Ansible Tower instance and launch the **Exercise 6.1 Deploy Elasticache** job template.

When the job completes running it will print out the hostname for your new endpoint.

<img src="/images/caching/aws_job_template_output.png" style="margin-left:2em;max-width:70%;">


### Exercise 6.2 Connect API to Cache

Modify the environment variables being passed to the API container.  Add the following variable:

* `ELASTICACHE`

Re-execute your playbook and make sure your ephemeral containers have been restarted to recognize the
new environment variable.


### Exercise 6.3 Execute Apache Benchmarking Tool

The tool `ab` should already be installed on your development workstation.  This tool ships with the
Apache httpd web server and it  is  designed  to give  you  an  impression  of how your current Apache 
installation performs. This especially shows you how many requests per second your Apache installation 
is capable of serving.

The endpoint we want to hit is shown below (change to the IP address for your web server of course)

```
curl http://10.10.10.92/api.php?url=http://www.redhat.com
```

Execute a test with 10 requests and record your results.

*Note - please don't perform hundreds or thousands of requests as our API key only gives the whole class
5000 requests to share for the entire course!*


** Post State **

Your output should resemble the following:

```
> ab -n 10 http://10.10.10.77/api.php?url=http://www.redhat.com
This is ApacheBench, Version 2.3 <$Revision: 1430300 $>
Copyright 1996 Adam Twiss, Zeus Technology Ltd, http://www.zeustech.net/
Licensed to The Apache Software Foundation, http://www.apache.org/

Benchmarking 10.10.10.77 (be patient).....done


Server Software:        Apache/2.4.6
Server Hostname:        10.10.10.77
Server Port:            80

Document Path:          /api.php?url=http://www.redhat.com/
Document Length:        1137 bytes

Concurrency Level:      1
Time taken for tests:   3.046 seconds
Complete requests:      10
Failed requests:        0
Write errors:           0
Total transferred:      13600 bytes
HTML transferred:       11370 bytes
Requests per second:    3.28 [#/sec] (mean)
Time per request:       304.550 [ms] (mean)
Time per request:       304.550 [ms] (mean, across all concurrent requests)
Transfer rate:          4.36 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0    0   0.0      0       1
Processing:    20  304 823.9     37    2647
Waiting:       20  304 823.9     37    2647
Total:         21  304 823.9     37    2648

Percentage of the requests served within a certain time (ms)
  50%     37
  66%     45
  75%    101
  80%    103
  90%   2648
  95%   2648
  98%   2648
  99%   2648
 100%   2648 (longest request)
```


