#! /usr/bin/ruby
#


require 'socket'               # Get sockets from stdlib
server = TCPServer.open(5669)  # Socket to listen on port 2000
loop {                         # Infinite loop: servers run forever
	client = server.accept       # Wait for a client to connect
	client.puts(Time.now.ctime)  # Send the time to the client
	client.puts "Hahaha I'm the server" 
	client.close                 # Disconnect from the client
}
