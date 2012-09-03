#! /usr/bin/ruby
#
#
require 'socket'
TCPSocket.open("localhost", 5669) do |s|
	while line = s.gets
		puts line.chop
	end
end
