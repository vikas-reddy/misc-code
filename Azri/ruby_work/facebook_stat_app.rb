#! /usr/bin/ruby

=begin

		Facebook type application

=end

require "tk"
require "mysql"


class Facebook
	def initialize
		self.DisplayLoginPage
	end

	def process_login
		puts "Logging in " + @username.value + " with password:" + @password.value;

		@active_db = Mysql.new("localhost", "vikas")
		@active_db.select_db("Facebook_StatMsg")

		# Authentication...
		query = "SELECT user_name FROM UserInformation "
		query += "WHERE user_name =\"" + @username.value + "\""
		query += " AND password=\"" + @active_db.escape_string(@password.value) + "\";"
		puts query

		result = @active_db.query(query);
		valid_user = result.num_rows

		result.free

		# If user information is valid, login. Else, do nothing
		if valid_user == 1
			@PresentUserName = @username.value
			puts "Present_User_Name: " + @PresentUserName;
			self.DisplayInbox
		else
			@active_db.close
			self.DisplayLoginPage
		end
	end

	def process_logout
		@active_db.close
		self.DisplayLoginPage
	end

	def process_forgotpassword
		puts @username.value + " forgot his password!! :D :D"

		# Connecting to database...
		db = Mysql.new("localhost", "vikas")
		db.select_db("Facebook_StatMsg")

		query = "SELECT email_id FROM UserInformation "
		query += "WHERE user_name =\"" + db.escape_string(@username.value) + "\";"
		puts query

		result = db.query(query);
		valid_user = result.num_rows
		puts "valid_user=#{valid_user}"

		# If existing user, mail him (alternate_email) his password. Else, direct him to "Register New User" page
		if valid_user == 1
			# Send an email to email_id
			#
			result.free
			db.close
			self.DisplayLoginPage
		else
			result.free
			db.close
			self.DisplayNewUser
		end
	end

	def process_newuser
		
		# Connecting...
		db = Mysql.new("localhost", "vikas")
		db.select_db("Facebook_StatMsg")

		# Validating the details: If found invalid, do nothing
		#unless ((@username.value =~ /^[a-z_.@]{5,40}$/) and
		#		(@password.value =~ /^.{6,50}$/)
		#		(@name.value =~ /^[a-zA-Z ]{5,40}$/) and
		#		(@email_id.value =~ /^[a-z_]{5,40}$/)
		#	   )
		#   puts "Invalid data: Refer to documentation"
		#   db.close
		#   self.DisplayNewUser
		#   return;
		#end

		query = "INSERT INTO UserInformation VALUES (\""
		query += db.escape_string(@username.value) + "\",\"" + db.escape_string(@name.value) + "\",\""
		query += db.escape_string(@password.value) + "\",\"" + db.escape_string(@email_id.value) + "\", \"\");"
		puts query

		db.query(query);

		# Creating tables for this user
		query1  = "CREATE TABLE #{@username.value}_flist (frnd_uname CHAR(50) NOT NULL, PRIMARY KEY(frnd_uname), FOREIGN KEY(frnd_uname) REFERENCES UserInformation(user_name));"
		query2  = "CREATE TABLE #{@username.value}_stat  (frnd_uname CHAR(50) NOT NULL, rating INT, comment BLOB, PRIMARY KEY(frnd_uname), FOREIGN KEY(frnd_uname) REFERENCES UserInformation(user_name));"
		query3  = "CREATE TABLE #{@username.value}_invitations (frnd_uname CHAR(50) NOT NULL, PRIMARY KEY(frnd_uname), FOREIGN KEY(frnd_uname) REFERENCES UserInformation(user_name));"

		puts query1
		puts query2
		puts query3
		db.query(query1);
		db.query(query2);
		db.query(query3);

		db.close
		self.DisplayLoginPage
	end

	def process_sendmail
		puts "Mail from "+@PresentUserName+ " to "+@toaddress.value

		# Sending email...
		query = "INSERT INTO " + @toaddress.value + "_inbox VALUES (\""
		query += @PresentUserName + "\",\""
		query += @active_db.escape_string(@subject.value) + "\",\""
		query += @active_db.escape_string(@subject.value) + "\");"

		puts query
		@active_db.query(query)
		self.DisplayInbox
	end

	def DisplayLoginPage
		root = TkRoot.new {
			title "Facebook: Login Page"
			background "black"
			minsize(800, 600)
		}
		top = TkFrame.new(root) {background "brown"}
		@username = TkVariable.new
		@password = TkVariable.new

		to_login = proc {top.unpack; self.process_login}
		to_new_user = proc {top.unpack; self.DisplayNewUser}
		to_forgotpassword = proc {top.unpack; self.DisplayForgotPassword}

		parameters = {"padx"=>20, "pady"=>20}
		heading = TkLabel.new(top) {
			text "Enter login information: "; 
			pack("side"=>"top", "padx"=>20, "pady" => 20, "ipadx"=>15, "ipady"=>15, "fill"=>"x")
		}
		heading.configure("font"=>{"size"=>16, "family"=>"Roman", "weight"=>"bold"})


		# Entries and Labels
		TkLabel.new(top) {text "Username: "}.pack()
		TkEntry.new(top, "textvariable" => @username) {pack("pady"=>10)}
		TkLabel.new(top) {text "Password: "}.pack()
		TkEntry.new(top, "textvariable" => @password, "show"=>false) {pack("pady"=>10)}

		# Buttons
		TkButton.new(top) {text "Login"; command to_login; pack()}
		TkButton.new(top) {text "Exit"; command {exit}; pack("side"=>"bottom", "padx"=>5, "pady"=>5, "fill"=>"x")}
		TkButton.new(top) {text "New User?"; command to_new_user; pack("side"=>"right")}
		TkButton.new(top) {text "Forgot Password?"; command to_forgotpassword; pack("side"=>"left")}

		top.pack("fill"=>"none", "side"=>"right", "expand"=>1)
	end


	def DisplayNewUser
		root = TkRoot.new {
			title "Facebook: New User Registration"
			background "black"
			minsize(800, 600)
		}
		top = TkFrame.new(root) {background "brown"}

		to_new_user_register = proc {self.process_newuser; top.unpack}
		to_login_page = proc {self.DisplayLoginPage; top.unpack}

		@username = TkVariable.new
		@name = TkVariable.new
		@password = TkVariable.new
		@email_id = TkVariable.new

		parameters = {"padx"=>10, "pady"=>10, "fill"=>"none"}

		# Heading
		heading = TkLabel.new(top) {
			text "New User Registration"; 
			pack("side"=>"top", "padx"=>20, "pady" => 20, "ipadx"=>15, "ipady"=>15, "fill"=>"x")
		}
		heading.configure("font"=>{"size"=>16, "family"=>"Roman", "weight"=>"bold"})

		# Entries
		TkLabel.new(top) {text "Username: "}.pack()
		TkEntry.new(top, "textvariable" => @username) {pack(parameters)}
		TkLabel.new(top) {text "Name: "}.pack()
		TkEntry.new(top, "textvariable" => @name) {pack(parameters)}
		TkLabel.new(top) {text "Password: "}.pack()
		TkEntry.new(top, "textvariable" => @password, "show"=>"false") {pack(parameters)}
		TkLabel.new(top) {text "Alternate email address: "}.pack()
		TkEntry.new(top, "textvariable" => @email_id) {pack(parameters)}

		# Buttons
		TkButton.new(top) {text "Register"; command to_new_user_register; pack(parameters)}
		TkButton.new(top) {text "Back"; command to_login_page; pack(parameters)}
		TkButton.new(top) {text "Exit"; command {exit}; pack("side"=>"bottom", "padx"=>5, "pady"=>5, "fill"=>"x")}

		top.pack("fill"=>"none", "expand"=>1, "side"=>"right")
	end


	def DisplayForgotPassword
		root = TkRoot.new {
			title "Facebook: Forgot password?"
			background "black"
			minsize(800, 600)
		}
		top = TkFrame.new(root) {background "brown"}

		to_forgotpassword = proc {self.process_forgotpassword; top.unpack}
		to_login_page = proc {self.DisplayLoginPage; top.unpack}

		@username = TkVariable.new

		parameters = {"padx"=>10, "pady"=>10}

		# Heading
		heading = TkLabel.new(top) {
			text "Forgot Password?"; 
			pack("side"=>"top", "padx"=>20, "pady" => 20, "ipadx"=>15, "ipady"=>15, "fill"=>"x")
		}
		heading.configure("font"=>{"size"=>16, "family"=>"Roman", "weight"=>"bold"})


		# Entries
		TkEntry.new(top, "textvariable" => @username) {pack(parameters)}

		# Buttons
		TkButton.new(top) {text "Submit"; command to_forgotpassword; pack(parameters)}
		TkButton.new(top) {text "Back"; command to_login_page; pack(parameters)}
		TkButton.new(top) {text "Exit"; command {exit}; pack("side"=>"bottom", "padx"=>5, "pady"=>5, "fill"=>"x")}

		top.pack("fill"=>"none", "expand"=>1, "side"=>"top")
	end


	def DisplayComposeMail
		root = TkRoot.new {
			title "Facebook: Compose Mail"
			background "brown"
			minsize(800, 600)
		}
		top = TkFrame.new(root) {background "brown"}

		to_send = proc {self.process_sendmail; top.unpack}
		to_discard = proc {self.DisplayInbox; top.unpack}
		to_logout = proc {self.process_logout; top.unpack}

		@toaddress = TkVariable.new
		@subject = TkVariable.new

		# Heading
		heading = TkLabel.new(top) {
			text "Compose Email"; 
			pack("side"=>"top", "padx"=>20, "pady" => 20, "ipadx"=>15, "ipady"=>15, "fill"=>"x")
		}
		heading.configure("font"=>{"size"=>16, "family"=>"Roman", "weight"=>"bold"})


		parameters = {"padx"=>10, "pady"=>10, "side"=>"top", "fill"=>"none"}
		# Entries
		TkLabel.new(top) {text "To"}.pack()
		TkEntry.new(top, "textvariable" => @toaddress) {pack(parameters)}
		TkLabel.new(top) {text "Subject"}.pack()
		TkEntry.new(top, "textvariable" => @subject) {pack(parameters)}

		# Text
		TkLabel.new(top) {text "Body"}.pack()
		text = TkText.new(top).pack(parameters)

		@body = text.get("1.0", "end")

		# Buttons
		TkButton.new(top) {text "Send"; command to_send; pack("side"=>"top","anchor"=>"e")}
		TkButton.new(top) {text "Discard/Cancel"; command to_discard; pack("side"=>"top","anchor"=>"w")}
		TkButton.new(top) {text "Logout"; command to_logout; pack("side"=>"right","anchor"=>"e")}

		top.pack("fill"=>"both", "side"=>"top")
	end



	def DisplayInbox
		disp_msg = "Facebook: Home of " + @PresentUserName
		root = TkRoot.new {
			title disp_msg
			background "black"
			minsize(800, 600)
		}
		top = TkFrame.new(root) {background "brown"}

		to_compose = proc {self.DisplayComposeMail; top.unpack}
		to_login = proc {self.DisplayLoginPage; top.unpack}
		to_logout = proc{self.process_logout; top.unpack}


		parameters = {"padx"=>10, "pady"=>10}
		# Heading
		heading = TkLabel.new(top) {
			text disp_msg
			pack("side"=>"top", "padx"=>20, "pady" => 20, "ipadx"=>15, "ipady"=>15, "fill"=>"x")
		}
		heading.configure("font"=>{"size"=>16, "family"=>"Roman", "weight"=>"bold"})

		# Buttons
		TkButton.new(top) {text "Logout"; command to_login; pack("side"=>"top", "anchor"=>"e")}
		TkButton.new(top) {text "Compose"; command to_compose; pack("side"=>"top", "anchor"=>"w")}

		# Display Invitations
		query  = "SELECT frnd_uname FROM #{PresentUserName}_invitations;"
		result = @active_db.query(query)
		num    = result.num_rows

		Invitations = Array.new
		num.times {Invitations << TkVariable.new}

		i = 0;
		result.each do |row|
			TkEntry.new(top, "textvariable" => Invitations[i]) {text row[0]}
			i += 1
		end

		# Displaying Inbox Messages
		text = TkText.new(top).pack(parameters)

		query = "SELECT * FROM " + @PresentUserName + "_inbox;"

		result = @active_db.query(query);
		result.each do |l|
			text.insert("end", "#{"===="*10}\n")

			msg = "From: " + l[0] + "\n"
			msg += "Subject: " + l[1] + "\n"
			msg += "Body: " + l[2] + "\n"
			text.insert("end", msg)

			text.insert("end", "#{"===="*10}\n\n")
		end
		result.free

		top.pack("fill"=>"both", "side"=>"top", "expand"=>1)
	end



end

Facebook.new

Tk.mainloop()
