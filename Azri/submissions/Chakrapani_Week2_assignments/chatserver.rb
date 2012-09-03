require 'socket'
### Changeable variables ###

port = 6789
count_history = 30	# Number of messages to store in history & print
### --------------------###

#### Arrays to maintain connection/user/thread Details and Last 30 messages ####

client_connections = []
client_threads = {}
past_history = []

### Starting a Server on port 'port' ###

server = TCPServer.new(port)
while(session = server.accept)
	client_connections << session

	client_threads["#{session.to_s}"] = Thread.new(session) do |client_session|
		if (past_history.length > 0)
			client_session.puts "-------Past #{past_history.length} Messages from Chat Board-------"
			past_history.each do |prev_mesg|
				client_session.puts prev_mesg
			end
		end

		client_session.puts "-------Welcome To Chat Board-------"
		client_session.puts "SERVER: No Of Users Online :: #{client_connections.length}"
		while(1)
			### Getting Chat Conversation ###		

			in_mesg = client_session.gets

			if(in_mesg.chomp == "logout")
				### handling logout & removing and closing connection/thread info ###

				login_name = client_session.gets.chomp
				end_mesg = "SERVER: User '#{login_name}' left Chat Board"

				c_t = client_threads["#{client_session}"]
				client_connections.delete(client_session)
				client_threads.delete("#{client_session.to_s}")

				### Sending logout notification to all other users(online) in the chat board ###

				client_connections.each do |clnt|
					if client_session != clnt
						clnt.puts end_mesg
						clnt.puts "SERVER: No Of Users Online :: #{client_connections.length}"
					end
				end
				client_session.puts "logout"
				client_session.close
				c_t.exit
			else
				### Sending Actual chat Conversations ###	

				client_connections.each do |clnt|
					if client_session != clnt
						clnt.print in_mesg
					end
				end
			end
			### Storing past history : 'count_history' conversations!!! ###

			if (past_history.length < count_history)
				past_history << in_mesg
			elsif(past_history.length >= count_history)
				past_history.delete(past_history[0])
				past_history << in_mesg
			end
		end
	end
end

