#include<iostream>
using namespace std;

template <class T, class U>
class something
{
	private:
		T var_1;
		U var_2;
	public:
		something(T arg_1, U arg_2)
		{
		//	this.var_1 = arg_1;
		//	this.var_2 = arg_2;
			var_1 = arg_1;
			var_2 = arg_2;
		}
		~something()
		{
			return;
		}
		void print_values();
};

template <class T, class U>
void something<T,U>::print_values()
{
	cout << "var_1 = " << var_1 << endl;
	cout << "var_2 = " << var_2 << endl;
	return;
}



int main()
{
	int a = 3;
	double b = 4.0;
	something<int,double> obj(a,b);
	obj.print_values();
	return 0;
}
