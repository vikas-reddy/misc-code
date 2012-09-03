#!/usr/bin/python

num = input()
for i in range(2,num):
	if num%i==0:
		print num,"=",i,"*",num/i
		break
else:
	print num, "is a prime number"
