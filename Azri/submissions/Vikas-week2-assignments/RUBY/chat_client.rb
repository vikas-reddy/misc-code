#! /usr/bin/ruby
#
# Chat client
#	Vikas Reddy
#
################################################################
#
# 1. If any client wants to disconnect, he should type only
#    "$disconnect$" as a message and he'll be disconnected
# 2. In the chat-room/@-client-side a unique ClientID of 
#    the owner of the message is displayed beside his message
#
################################################################
#
#

require "socket"

socket = TCPSocket.open("localhost", 5669)


scanning_thread = Thread.new do
	while true
		line = socket.gets
		puts line
	end
end

printing_thread = Thread.new do
	while true
		line = gets
		socket.puts line
	end
end

scanning_thread.join
printing_thread.join


socket.close
