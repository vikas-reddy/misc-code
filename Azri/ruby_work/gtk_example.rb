#! /usr/bin/ruby
#
#

require 'gtk2'

window = Gtk::Window.new(Gtk::Window::TOPLEVEL)
button = Gtk::Button.new("Hello World")

window.set_title("Hello Ruby")
window.border_width(10)

# Connect the button to a callback.
button.signal_connect('clicked') { puts "Hello Ruby" }

# Connect the signals 'delete_event' and 'destroy'
window.signal_connect('delete_event') {
	puts "delete_event received"
	false
}
window.signal_connect('destroy') {
	puts "destroy event received"
	Gtk.main_quit
}

window.add button
window.show_all
Gtk.main
