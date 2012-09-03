#!/usr/bin/python

time_hours = 2;
time_minutes = 40;
time_seconds = 0;
total_time = (time_hours*3600 + time_minutes*60 + float(time_seconds)) # time in seconds

vbr = 500; # kbit/s
abr = 128; # kbit/s

size = ((vbr + abr)/8.0) * total_time; # size in kB
size_mb = size/1024; # size in MB

print size_mb;
