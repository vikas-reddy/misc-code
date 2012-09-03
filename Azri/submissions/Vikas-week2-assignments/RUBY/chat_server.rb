#! /usr/bin/ruby
#
# Multi-threaded chat server on port 5669
# Vikas Reddy
#
##############################################################
#
# 1. Any number of clients can connect to this chat server
# 2. If any client wants to disconnect, he should type only
#    "$disconnect$" as a message and he'll be disconnected
# 3. In the chat-room/@-client-side a unique ClientID of 
#    the owner of the message is displayed beside his message
#
##############################################################
#

require "socket"


serv_sock = TCPServer.new("localhost", 5669)
socket_address = serv_sock.addr

puts "Server running on #{socket_address.join(":")}"
puts

# Array in which all the client sockets are stored
clients_list = Array.new

# Last 30 lines of chat
last_30_lines = Array.new


while true
	client = serv_sock.accept

	Thread.start(client) do |c|
		clients_list.push(c)

		# Printing the last 30 lines
		last_30_lines.each do |l|
			c.puts l
		end


		# Actual chat
		c.puts "************* CHAT STARTS *******************"
		while true
			line = c.gets

			# disconnecting client
			if line.chop == "$disconnect$"
				clients_list.delete(c)
				Thread.exit
			end

			#outputting to clients
			clients_list.each do |t| 
				output_line = Thread.current.object_id.abs.to_s + ": " + line
				last_30_lines.shift() if last_30_lines.size >= 30
				last_30_lines << output_line
				t.puts output_line
			end
		end
	end

end

serv_sock.close
