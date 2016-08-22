#include <iostream>
 
using namespace std;
 
int main()
{
  cout<<"HEY, you, I'm alive! Oh, and Hello World!\n";
  for ( int x = 0; x < 10; x++ ) {
    // Keep in mind that the loop condition checks 
    //  the conditional statement before it loops again.
    //  consequently, when x equals 10 the loop breaks.
    // x is updated before the condition is checked.    
  	cout<< x <<endl;
	}
  cin.get();
 
  return 1;
}