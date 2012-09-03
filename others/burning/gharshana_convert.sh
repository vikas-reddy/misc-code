#!/bin/bash

mencoder -oac mp3lame -ovc lavc -ss 15\
 	-lameopts vbr=2:q=3 -ffourcc DX50\
	-lavcopts vpass=1:turbo -vf scale=624:272 -aspect 624:272\
	-o /extra/downloads/movies2/gharshana/gharshana-1.avi "Gharshana.DVDRip.CD1[wulfor].avi"
mencoder -oac mp3lame -ovc lavc -ss 15\
 	-lameopts vbr=2:q=3 -ffourcc DX50\
	-lavcopts vbitrate=1000:vpass=2 -vf scale=624:272 -aspect 624:272\
	-o /extra/downloads/movies2/gharshana/gharshana-1.avi "Gharshana.DVDRip.CD1[wulfor].avi"

mencoder -oac mp3lame -ovc lavc\
 	-lameopts vbr=2:q=3 -ffourcc DX50\
	-lavcopts vpass=1:turbo -vf scale=624:272 -aspect 624:272\
	-o /extra/downloads/movies2/gharshana/gharshana-2.avi "Gharshana.DVDRip.CD2[wulfor].avi"

mencoder -oac mp3lame -ovc lavc\
 	-lameopts vbr=2:q=3 -ffourcc DX50\
	-lavcopts vbitrate=1000:vpass=2 -vf scale=624:272 -aspect 624:272\
	-o /extra/downloads/movies2/gharshana/gharshana-2.avi "Gharshana.DVDRip.CD2[wulfor].avi"
