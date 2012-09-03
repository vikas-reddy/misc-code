#! /usr/bin/ruby
#
#
require 'tk'

root = TkRoot.new() { title "Gridding Example" }

br = ["one", "and", "one"].collect { |c|
	  TkButton.new(root, "text"=>c)
}
TkGrid.grid(br[0], br[1], br[2], "columnspan"=>2 )

TkButton.new(root, "text"=>"is").grid("columnspan"=>3, "sticky"=>"ew")
TkButton.new(root, "text"=>"two").grid("row"=>1, "column"=>3, "columnspan"=>3)

Tk.mainloop
