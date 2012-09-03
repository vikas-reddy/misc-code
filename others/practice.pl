#!/usr/bin/perl
#
#
my $x=<STDIN>;
$x =~ s/(.*?)/\/$1\//g;
print $x;
