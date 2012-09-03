# Script to convert time in seconds to readable format
#

print "Enter time in seconds: ";
time = gets;

# Convert to integer
time = time.to_i;

# Calculation
years   =  time / (60*60*24*30*12);
months  = (time % (60*60*24*30*12)) / (60*60*24*30);
days    = (time % (60*60*24*30))    / (60*60*24);
hours   = (time % (60*60*24))       / (60*60);
minutes = (time % (60*60))          / (60);
seconds = (time % (60));


print years.to_i," years, ";
print months.to_i," months, ";
print days.to_i," days, ";
print hours.to_i," hours, ";
print minutes.to_i," minutes, ";
print seconds.to_i," seconds\n";
