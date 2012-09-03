#! /usr/bin/ruby
#
#  Vikas
#
#  Common elements from a given set of arrays


def intersection(array1, array2)
	result = [];
	for i in 0...array1.length
		for j in 0...array2.length
			if array1[i] == array2[j]
				result[result.length] = array1[i];
			end;
		end;
	end;
	return result;
end;


# ans = array
# REPEAT
# 	gets array_next
# 	ans = intersection(ans, array_next)
# END
#
# Print ans @ end;


# Get an array in the form of a string as input
array = gets;
array = array.split();
ans = array;


while true
	array_next = gets;
	#print "array_next = ", array_next, "\n";
	if array_next == "END\n"
		break;
	end;
	array_next = array_next.split();
	ans = intersection(ans, array_next);
end;

print ans, "\n";
