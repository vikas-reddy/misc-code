#! /usr/bin/ruby
#
#

require "tk"

root = TkRoot.new() {title "Packaging Example!"}

# Example button
button = TkButton.new(root) {text "Button Text"}
button.pack("side" => "right", "fill" => "y")

# Entry
entry = TkEntry.new(root).pack("side" => "top", "fill" => "x")
entry.insert(0, "Entry Text")

# Label
label = TkLabel.new(root) {text "Label Text"}
label.pack("side" => "right")

# Image
image = TkPhotoImage.new("file" => "background.gif", "height" => 50)
image_label = TkLabel.new(root) {image image}.pack("anchor" => "e")

# Text
text = TkText.new(root){width 20; height 5}
text.pack("side"=>"left")
text.insert("end", "Text Text")

# Message
message = TkMessage.new(root){text "Message Text"}
message.pack("side" => "bottom")


Tk.mainloop()
