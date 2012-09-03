#include<iostream>
#include<cmath>
using namespace std;

int main(int argc, char** argv)
{
	if(argc != 2)
	{
		cout << "Number of arguments should exactly be 2." << endl;
		exit(1);
	}

	double Num = 0;
	bool is_negative = false, is_decimal = false;
	int position = -1;

	for(int i=0; argv[1][i]!='\0'; i++)
	{
		if( argv[1][i] >= '0'  &&
		    argv[1][i] <= '9' )
			Num = Num*10 + (double)(argv[1][i] - '0');

		else if (argv[1][i] == '-' && i == 0)
			is_negative = true;

		else if (argv[1][i] == '.')
		{
			if (argv[1][i+1] != '\0')
			{
				position = i+1;
				is_decimal = true;
			}
			break;
		}

		else
			break;
	}

	double decimal_part = 0;
	if(is_decimal)
		for(int i=position,j=10; argv[1][i] != '\0'; i++,j=j*10)
		{
			/*if( argv[1][i] >= '0'  &&
			    argv[1][i] <= '9' )
				Num = Num + ((double)(argv[1][i] - '0')/(double)pow(10.0,j));
			else
				break;
			*/
			decimal_part = decimal_part + (double)(argv[1][i] - '0')/j ;
		}
	cout << Num << endl;
	cout << decimal_part << endl;
	Num += decimal_part;

	if(is_negative)
		Num = Num * (-1);
	cout << "The number is " << Num << endl;
	printf("The number is %f\n", Num);
	return 0;
}
