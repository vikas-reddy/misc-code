// pointers to base class
#include <iostream>
using namespace std;

class CPolygon {
	protected:
		int width, height;
	public:
		void set_values (int a, int b)
		{ width=a; height=b; }
		int area()
		{;}
};

class CRectangle: public CPolygon {
	public:
		int area ()
		{ return (width * height); }
};

class CTriangle: public CPolygon {
	public:
		int area ()
		{ return (width * height / 2); }
};

int main () {
	CRectangle rect;
	CTriangle trgl;
	CPolygon * ppoly1 = &rect;
	CPolygon * ppoly2 = &trgl;
	ppoly1->set_values (4,5);
	ppoly2->set_values (4,5);
	cout << ppoly1->area() << endl;
	cout << ppoly2->area() << endl;
	return 0;
}
