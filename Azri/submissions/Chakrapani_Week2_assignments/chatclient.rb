require 'socket'
### changeable variables ###

host = "localhost"
port = 6789
####---------########

#puts ARGV.length
#host = ARGV[0]
#port = ARGV[1]

### Getting Username... ###
print "Enter username ::\n"
$login = gets.chomp
if $login == ""
	### Random name is given if user din't enter username ###
	puts "Given Random User Name"
	$login = "NoName#{rand(50)}"
end
puts "loginname:#{$login}"

### Connecting to server host@port ###
client_socket = TCPSocket.open(host,port)

threads_io = []
### This thread reads input from user and sends to server ###
threads_io << Thread.new(client_socket) do |clt_skt|
	while(1)  
		mesg = gets
		if (mesg.chomp == "logout")
			client_socket.puts mesg
			client_socket.puts $login
			break
		end
		mesg = "#{$login} :#{mesg}"
		client_socket.puts mesg
	end
end

###This thread Displays messages sent by the Server.. ###
threads_io << Thread.new do
	while(1)
		out_mesg = client_socket.gets
		if(out_mesg.chomp == "logout")
			break
		end
		print out_mesg
	end
end

### Whenever user types 'logout' both the while loops in both threads break
#   thus threads join and exit below.. ###

threads_io[0].join
threads_io[1].join
puts "SEREVER: You Are Successfully Logged Out of Chat Room"

