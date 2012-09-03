#! /usr/bin/ruby
#
# MySQL Example
#
require "mysql"

db = Mysql.new("localhost", "root", "vikky123")
db.select_db("GoogleNewsRSS")

result = db.query("SELECT pubdate, title FROM news_items WHERE item_id=200;")

puts result.num_rows;

#result.each do |line|
#	puts "#{"==="*15}"
#	puts line
#	puts "#{"==="*15}"
#end

result.free

db.close
