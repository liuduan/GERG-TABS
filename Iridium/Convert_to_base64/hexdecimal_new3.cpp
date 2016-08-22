#include <cstdio>
#include <string>  
#include<iostream>  
using namespace std;  


//“0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ+/”
// a is 11, A is 37, + is 62, / is 63
int main()  
{  
    char* a;  
	char output_string[8];
    long m;
	// m = 1234567890;  
	// cout<<"The base64 number for 1234567890 is: '";
    cin>>m;  					// put in a number m
    long s = m;  
    int i = 0;  
    while(s/64 != 0) {  
        if(s%64 < 10){a+ i++ = '0'+s%64;}  
        if(s%64 >=10 && s%64 <36) {a+ i++ = 'a'+ s%64 -10;}
        if(s%64 >=36 && s%64 <62) {a + i++ = 'A'+ s%64 - 36;}
        if(s%64 ==62) {a+ i++ = '+';}		// +
        if(s%64 ==63) {a+ i++ = '/';}		  
        s = s/64;  
    	}  

	if(s%64 < 10) {a + i = '0'+s%64;}  
    if(s%64 >=10 && s%64 <36) {a + i = 'a'+s%64 - 10;}
    if(s%64 >=36 && s%64 <62) {a + i = 'A'+s%64 - 36;}
    if(s%64 ==62) {a+i = '+';}		// +
    if(s%64 ==63) {a+i = '/';}	
	
	std::printf("\nThis is i: %i \n", i);
	
	//strcpy(output_string, a);
	
	while(i>=0){  
		// output_string[i] = a[8-i];
        cout<<a[i--];  
    	}  

	cout<<"\n";
	cout<<" Here is a: ";
	cout<<a;


 //求出字符串的长度
 // int len = a.length();
 int len = 8;
 for (int ii = 0; ii<len/2; ii++)
 {
  //前后交换
  char temp = a[ii];
  a[ii] = a[len-ii-1];
  a[len-ii-1] = temp;
 }

 //输出交换后的字符串
 cout<<a<<endl;
			


	cout<<"\n";
	cout<<"Here is the output_string: ";
	cout<<a;
	cout<<"\n";
	
	cout<<"Here is the output_string+1: ";	
	cout<<a+1;
	cout<<"\n";
	
	cout<<"1234567890 in 64 base should be: 19Bwbi.";
	cout<<"\n";
	
	
	
    return 0;  
}  





