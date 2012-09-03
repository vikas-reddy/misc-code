#! /usr/bin/ruby 
#
# Threads example
#

first = Thread.new() do
	for i in 1..5
		if i == 3
			Thread.pass
		end
		puts "first: #{i}"
	end
end


second = Thread.new() do
	puts "second: "
end

third = Thread.new() do
	Thread.pass
	puts "third: "
end
