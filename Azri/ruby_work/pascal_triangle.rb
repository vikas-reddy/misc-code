#! /usr/bin/ruby
#
#	Vikas | Pascal Triangle
#

n = gets;
n = n.to_i;

if n <= 0
	exit;
end;


# Function
def nCm(n, m)
	if n == 0 or m == 0
		return 1;
	end;

	product = 1;
	for i in 1...m+1
		product = product * ((n-(i-1))/i.to_f);
	end;
	return product;
end;



# Actual loop // Printing
for i in 0...n
	for j in 0...(n-i+1)
		print " ";
	end;
	for j in 0...i+1
		print nCm(i,j).to_i, " ";
	end;
	print "\n";
end;
