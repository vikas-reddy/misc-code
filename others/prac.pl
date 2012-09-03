#!/usr/bin/perl

use strict;

# SCANNING AND PRINTING THE ELEMENTS OF AN ARRAY.. 
#my @array,$size;

#print "Enter the size of the array...";
#$size = <STDIN>;

#for( my $i=0; $i<$size; $i++)
#{
#	print "Enter : ";
#	$array[$i] = <STDIN>;
#}

#foreach my $x (@array)
#{
#	print "$x";
#}

my $fileName = <STDIN>, $count = 0;

open(VIK,$fileName) or die("couldn't open the file");
foreach my $x (<VIK>)
{
	$count++;	
}
close(VIK);

print "number of lines in the file is $count\n";
