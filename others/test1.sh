#!/bin/bash

if [ -n "$1" ];
then
	file=$1;
	cat $file| while read i
	do
		echo "$i"
	done;
fi;
