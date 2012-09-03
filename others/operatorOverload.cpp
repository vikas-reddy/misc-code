#include<iostream>

namespace vik
{
	int x = 0;
	int y = 0;
};

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
	using namespace std;
	int x,y;
	tuple T1, T2, T3;
	cin >> x >> y;
	T1.put(x,y);
	cin >> x >> y;
	T2.put(x,y);

	T3 = T1*T2;
	cout << T3.getx() << " " << T3.gety() << "\n";
	using namespace vik;
	cout << x << " " << y << "\n";
	return 0;
}
