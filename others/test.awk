#!/usr/bin/awk -f

BEGIN{
	FS="."
}
{ 
	i = 1;
	while (i<NF)
	{
		printf("%s",$i);
		i++;
		if(i!=NF && $i!="")
			printf(" ");
	}
	#printf("\n");
}
