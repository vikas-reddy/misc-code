#! /usr/bin/ruby
#


date = ARGV[0].strip

if (date =~ /^(0?[1-9]|1[0-2])$/)
	puts "YES! It's a valid date"
end
