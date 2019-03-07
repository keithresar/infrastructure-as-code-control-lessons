# Performance Testing

Perform another quick performance test to gauge whether our horizontal scale-out improved performance.

<hr>

### Exercise 5.15 Execute Apache Benchmarking Tool

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

Document Path:          /api.php?url=http://www.redhat.com
Document Length:        1137 bytes

Concurrency Level:      1
Time taken for tests:   27.205 seconds
Complete requests:      10
Failed requests:        0
Write errors:           0
Total transferred:      13600 bytes
HTML transferred:       11370 bytes
Requests per second:    0.37 [#/sec] (mean)
Time per request:       2720.516 [ms] (mean)
Time per request:       2720.516 [ms] (mean, across all concurrent requests)
Transfer rate:          0.49 [Kbytes/sec] received

Connection Times (ms)
              min  mean[+/-sd] median   max
Connect:        0    1   0.3      1       2
Processing:  2393 2720 370.1   2593    3500
Waiting:     2393 2720 370.1   2593    3500
Total:       2393 2720 370.1   2594    3501

Percentage of the requests served within a certain time (ms)
  50%   2594
  66%   2688
  75%   2807
  80%   3245
  90%   3501
  95%   3501
  98%   3501
  99%   3501
 100%   3501 (longest request)
```



### 📗 Resources


