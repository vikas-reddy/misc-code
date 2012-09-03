#!/usr/bin/perl
#
# First perl program

use strict;
my %details=(
	name   => "Vikas S. Reddy",
	roll   => "200501095",
	room   => "56",
	hostel => "GHEB",
	course => "CSE",
	age    => 20
);

#my @Keys = sort keys %details;
#
#print "The length of the array \$Keys is ".(@Keys)."\n";

foreach (reverse keys %details)
{
	print "$_----------$details{$_}"."\n";
	$details{$_} = "viks";
}
