#!/usr/bin/python

import sys

# Destination file size in Kilo Bytes. Usually 700 MB
dest_size = 720 * 1024;

time = sys.argv[1]
audio_bitrate = int(sys.argv[2]);


temp = time.split(":")
time = 3600*int(temp[0]) + 60*int(temp[1]) + int(temp[2]);

size = dest_size - (audio_bitrate/8.0)*time

print size;
