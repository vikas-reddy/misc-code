#!/bin/bash

mencoder Venki\ \(1\).DAT\
	-vf crop=336:160:6:64\
	-ovc xvid -xvidencopts pass=1:turbo\
	-oac mp3lame -lameopts vbr=2:q=3\
	-o /dev/null;

mencoder Venki\ \(1\).DAT\
	-vf crop=336:160:6:64\
	-ovc xvid -xvidencopts pass=2:bitrate=-340000\
	-oac mp3lame -lameopts vbr=2:q=3\
	-o venki-1.avi;
