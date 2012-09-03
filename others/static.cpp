#include<iostream>
using namespace std;

void func()
{
	// Declaring a static variable using "static"
	static int count=0;
	count++;
	if(count == 10)
		return;
	cout << count << endl;
	func();
}
int main()
{
	int maxValue=10;
	const int x=(const int)maxValue;
	cout << x << endl;
	func();
	return 0;
}
