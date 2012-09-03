#! /usr/bin/ruby
#

arr = ["one", "two", "three", "four", "five"]

arr.shift() if arr.size >= 5
arr << "seven"

puts arr
