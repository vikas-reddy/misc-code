#!/usr/bin/awk -f
#this is my first AWK program
# This program is designed to list all networks of phone numbers

BEGIN{
	airtel = 0;
	hutch = 0;
	tata = 0;
	reliance = 0;
	idea = 0;
	bsnl = 0;
}
$2 ~ /^9866/ {airtel += 1}
$2 ~ /^9849/ {airtel += 1}
$2 ~ /^9885/ {hutch += 1}
$2 ~ /^9989/ {airtel += 1}
$2 ~ /^92/ {tata += 1}
$2 ~ /^93/ {reliance += 1}
$2 ~ /^9848/ {idea += 1}
$2 ~ /^9440/ {bsnl += 1}
$2 ~ /^00/ { $1 = "BSNL-LandLine-number" }

END{
	printf("number of airtel numbers = %d\n",airtel);
	printf("number of hutch numbers = %d\n",hutch);
	printf("number of idea numbers = %d\n",idea);
	printf("number of tata numbers = %d\n",tata);
	printf("number of reliance numbers = %d\n",reliance);
	printf("number of bsnl numbers = %d\n", bsnl);
}
