#!/usr/bin/python

import math, sys

src_width  = int(sys.argv[1]);
src_height = int(sys.argv[2]);
#src_width  = input('Source Width: ');
#src_height = input('Source Height: ');
dest_width = 352;
dest_height = dest_width * src_height/float(src_width);

if math.ceil(dest_height) % 2 == 0:
	dest_height = int(math.ceil(dest_height));
else:
	dest_height = int(math.floor(dest_height));

# if toppad and bottompad are odd, make it even
if (dest_height/2)%2 == 1:
	padtop    = (288 - dest_height)/2 - 1;
	padbottom = (288 - dest_height)/2 + 1;
else:
	padtop    = (288 - dest_height)/2;
	padbottom = (288 - dest_height)/2;

#print int(dest_height), int(padtop), int(padbottom);

print "ffmpeg -i -target pal-vcd -s 352x" + str(dest_height) +\
	" -aspect 4:3 -padtop "	+ str(padtop) +\
	" -padbottom " + str(padbottom);
