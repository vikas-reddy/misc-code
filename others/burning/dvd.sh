#!/bin/bash

mencoder -oac lavc -ovc lavc -of mpeg -mpegopts format=dvd:tsaf \
  -vf scale=352:160,expand=352:288:0:64,harddup -srate 48000 -af lavcresample=48000 \
  -lavcopts vcodec=mpeg2video:vrc_buf_size=1835:vrc_maxrate=9800:vbitrate=2000:\
keyint=15:vstrict=0:acodec=ac3:abitrate=192:aspect=4/3 -ofps 25 \
  -o /home/svreddy/downloads/happy_days/HappyDays-2.mpg HappyDays-2.avi;

mencoder -oac lavc -ovc lavc -of mpeg -mpegopts format=dvd:tsaf \
  -vf scale=352:160,expand=352:288:0:64,harddup -srate 48000 -af lavcresample=48000 \
  -lavcopts vcodec=mpeg2video:vrc_buf_size=1835:vrc_maxrate=9800:vbitrate=2000:\
keyint=15:vstrict=0:acodec=ac3:abitrate=192:aspect=4/3 -ofps 25 \
  -o /home/svreddy/downloads/happy_days/HappyDays-1.mpg HappyDays-1.avi;

#mencoder -oac lavc -ovc lavc -of mpeg -mpegopts format=dvd:tsaf \
#  -vf scale=720:576,harddup -srate 48000 -af lavcresample=48000 \
#  -lavcopts vcodec=mpeg2video:vrc_buf_size=1835:vrc_maxrate=9800:vbitrate=5000:\
#keyint=15:vstrict=0:acodec=ac3:abitrate=192:aspect=16/9 -ofps 25 \
#  -o /home/svreddy/downloads/happy_days/HappyDays-2.mpg HappyDays-2.avi;
