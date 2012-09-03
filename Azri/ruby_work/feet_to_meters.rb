#! /usr/bin/ruby
#
#
require "tk"
require "tkextlib/tile"

root = TkRoot.new do
	title "Feet to Meters"
	minsize(800, 600)
	background "orange"
end

label = TkLabel.new(root) do
	text "Hi! I'm a \"Feet to Meters\" program"
	foreground "brown"
	#pack { padx 15; pady 15; side "left" }
	pack( "side" => "top", "padx" => 15, "pady" => 15 )
end

TkButton.new(root) do
	text "SubmiT"
	command do
		text "Changed"
		label.configure("text" => "ViKaS: New text")
	end
	pack( "side" => "left", "padx" => 10, "pady" => 10 )
end

Tk.mainloop()
