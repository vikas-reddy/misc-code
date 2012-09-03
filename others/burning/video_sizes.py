#!/usr/bin/python

for i in range(160,736,16):
	for j in range(160,i+16,16):
		resolution = float(i)/float(j);
		if resolution >= 2 and resolution <= 2.37:
			print i,"x",j,"     ",resolution;


