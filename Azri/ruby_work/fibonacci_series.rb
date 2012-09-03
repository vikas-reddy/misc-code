#! /usr/bin/ruby
#
# Vikas Reddy
#
# Fibonacci series
#

print "Enter number n: ";
n = gets;

# Check whether the input entered is an integer
if (n.to_i).to_s == n
	puts "An integer input is expected";
end;
n = n.to_i;



# if n is <=0; exit
if n <= 0
	exit;
end;


a = 1;
b = 1;

# Actual computation
for i in 1...n+1
	print a, " ";
	temp = a;
	a = b;
	b = temp + b;
end;

print "\n";
exit;
