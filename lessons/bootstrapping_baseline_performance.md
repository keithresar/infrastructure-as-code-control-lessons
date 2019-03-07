# Baseline Performance

We now have all the parts configured for the Translation Wizard MVP.
In subsequent exercises we will modify our environment architecture to achieve better performance

In this last exercise we will get a baseline performance on which to build.

<hr>


### Exercise 3.13 Execute Apache Benchmarking Tool

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

Benchmarking 3.85.5.85 (be patient).....done


Server Software:        Apache/2.4.6
Server Hostname:        3.85.5.85
Server Port:            80

Document Path:          /api.php?url=http://www.redhat.com
Document Length:        1137 bytes

Concurrency Level:      1
Time taken for tests:   27.973 seconds
Complete requests:      10
Failed requests:        0
Write errors:           0
Total transferred:      13600 bytes
HTML transferred:       11370 bytes
Requests per second:    0.36 [#/sec] (mean)
Time per request:       2797.253 [ms] (mean)
Time per request:       2797.253 [ms] (mean, across all concurrent requests)
Transfer rate:          0.47 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        1    1   0.1      1       1
Processing:  2328 2797 1300.7   2403    6496
Waiting:     2328 2797 1300.7   2403    6496
Total:       2329 2797 1300.7   2404    6497

Percentage of the requests served within a certain time (ms)
  50%   2404
  66%   2418
  75%   2421
  80%   2475
  90%   6497
  95%   6497
  98%   6497
  99%   6497
 100%   6497 (longest request)
```



### 📗 Resources


