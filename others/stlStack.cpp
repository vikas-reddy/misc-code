#include<iostream>
#include<stack>
using namespace std;

int main(){
	stack<int> s;
	for( int i=0; i<19; s.push(i), i++);
	for( ; !s.empty(); cout << s.top() << endl, s.pop() );
	return 0;
}
