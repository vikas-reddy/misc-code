#include<iostream>
#include<fstream>

namespace vik
{
	int x = 0;
	int y = 0;
};
using namespace vik;

class tuple
{
	private:
		int x;
		int y;
	public:
		tuple()
		{
			x = 0;
			y = 0;
		}
		void put(int,int);
		tuple operator* (tuple);
		int getx(void);
		int gety(void);
};

void tuple::put(int a, int b)
{
	x = a;
	y = b;
	return;
}
int tuple::getx()
{
	return x;
}
int tuple::gety()
{
	return y;
}
tuple tuple::operator* (tuple t)
{
	tuple tRes;
	tRes.put( x*+t.x, y*t.y );
	return tRes;
}


int main()
{
	int std::x,std::y;
	tuple std::T1, std::T2, std::T3;
	std::cin >> std::x >> std::y;
	T1.put(std::x,std::y);
	std::cin >> std::x >> std::y;
	T2.put(std::x,std::y);

	std::T3 = std::T1*std::T2;
	std::cout << T3.getx() << " " << T3.gety() << "\n";
	std::cout << x << " " << y << "\n";
	return 0;
}
