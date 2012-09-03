#include<iostream>
using namespace std;


template <class Type>
class node
{
	public:
		node* Next;
		Type value;

		node()
		{
			Next = NULL;
			value = 0;
		}
};

template <typename Type>
class list
{
	private:
		node<Type>* start;
	public:
		list()
		{
			start = NULL;
		}
		void insert(Type arg)
		{
			node<Type>* NewNode = new node<Type>;
			NewNode->value = arg;
			NewNode->Next = NULL;

			if(!start)
			{
				start = NewNode;
				return;
			}
			node<Type>* temp = start;
			for( ; temp->Next; temp=temp->Next);
			temp->Next = NewNode;

			return;
		}
		void print()
		{
			for(node<Type>* temp=start; temp->Next; temp = temp->Next )
				cout << temp->value << " ";
			cout << endl;
		}
		void sort()
		{
			return;
		}
};


int main()
{
	list<double> L;
	double element;

	int num_elements=0;
	cout << "Number of elements = ";
	cin >> num_elements;

	for(int i=0; i<num_elements; i++)
	{
		cin >> element;
		L.insert(element);
	}
	L.print();
}
