#include <iostream>
#include <complex>
using namespace std;

int main()
{
	int x = 3;
	complex<double> a,b;
	a = 3.0 + 4.0i;
	b = complex<double>(0.0,x);
	//b = log(a) + b;
	cout << "Real = " << b.real() << " Imaginary = " << b.imag()  << endl;
	return 0;
}
