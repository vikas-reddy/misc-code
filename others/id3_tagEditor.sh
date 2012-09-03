#!/bin/bash
# Please do read the README file before using this script. --VikasReddy

if [ -x "/usr/bin/id3v2" ];
then
	function func()
	{
		ls | while read i;
		do
			if [ -d "$i" ];
			then
				cd "$i";
				func "$i";
				cd "..";
			elif [ -f "$i" ];
			then
				if [[ -n `echo "$i" | grep "\.[mM][pP]3$"` ]];
				then
					#id3v2 -D "$i";
					#id3v2 -1 -2 "$i";
					title=`echo "$i" |\
				       		awk -F. '{i=1; while(i<NF){printf("%s",tolower($i)); 
								i++; if(i!=NF && $i!="") printf(" ");}}'`;
					#id3v2 -A "$1" -t "$title" "$i";
					echo "$i---------|$title|  from  |$1|";
					
				else
					echo "$i is not an mp3 file...";
				fi;
			fi
		done;
	}

	if [ -n "$1" ]; then 	destDir="$1";
	else 	destDir="."; 	fi;
	
	if [ "$destDir" == "." ];
	then
		dirName=`echo $PWD | awk -F/ '{i=NF-1; if($NF) i=NF; print $i;}'`;
		if [ -z "$1" ];
		then
			echo "NO DIRECTORY SPECIFIED as the command line argument";
			echo "Falling to the current directory $PWD instead.";
		fi;
		func "$dirName";
	else
		if [ "$destDir" == "~" ];
		then
			destDir="$HOME";
		fi;
		if [ -d "$destDir" ];
		then
			#dirName=`echo $destDir | awk -F/ '{i=NF-1; if($NF) i=NF; print $i;}'`;
			dirName=`basename "$destDir"`;
			cd "$destDir";
			func "$dirName";
			cd "$curDir";
		else
			echo "$destDir   NO SUCH DIRECTORY EXISTS. EXITING...";
		fi;
	fi;

else
	echo "EXITING.....";
	echo "You do not have the id3v2 package installed.
       		Please install it using any package manager or by compiling the source code.";
fi;
exit;
