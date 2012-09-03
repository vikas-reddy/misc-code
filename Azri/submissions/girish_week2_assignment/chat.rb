require 'socket' 
require 'thread'
mutex1=Mutex.new
mutex2=Mutex.new
$clientarray= Array.new
$messagearray= Array.new
server = TCPServer.open(2000)   
loop {                          
	Thread.start(server.accept) do |client|
		client.puts(Time.now.ctime)
		for msg in $messagearray
#	puts "msg array"
			client.puts(msg)
		end
		mutex1.synchronize do
			$clientarray<<client
		end
		while 1 do
			response=client.recv(100) 
			puts response
			mutex2.synchronize do
				$messagearray<<response
			end
			for cl in $clientarray
				if cl != client
			 		cl.puts(response)
				end
			end
#			puts $messagearray.size
#			puts $clientarray.size
			if response.to_s == "quit\n"
				client.close
			end
		end
	end
}

