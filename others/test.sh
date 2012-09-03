#!/bin/bash

read num
count=2
state=0

#while [[ `expr $count \< $num` ]]
while [[ $count != $num ]]
do
	if [[ `expr $num \% $count` == 0 ]]
	then
		echo "$num is not a prime number"
		state=1
		break;
	fi
	count=`expr $count + 1`
done;

if [[ $state == 0 ]];
then
	echo "$num is a prime number"
fi

