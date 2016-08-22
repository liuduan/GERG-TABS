#include<iostream>  
using namespace std;  
int main()  
{  
    char a[8];  
    char b[] = "0123456789ABCDEF";  //If change to 64 base, this line is having problem.
    long m;  
    cin>>m;  
    long s = m;  
    int i = 0;  
    while(s/16 != 0)  
    {  
        a[i++] = b[s%16];     
        s = s/16;  
    }  
    a[i] = b[s%16];           
    while(i>=0)  
    {  
        cout<<a[i--];  
    }  
	cout<<"\n";
    return 0;  
}  