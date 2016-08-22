#include <cstdio>
#include <string.h>  
#include<iostream>  
using namespace std;  


//“0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ+/”
// a is 10, A is 36, + is 62, / is 63

char base64_string[8];  // claim a global variable.

char covert(long m){
 	cout<<"1234567890 in 64 base should be: 19Bwbi.";
	cout<<"\n";
	// char base64_string[] = "00000000";  
	// char output_string[8];
    // long m;
	// m = 1234567890;  
	cout<<"Please key in an integer to be coverted to base64 number: ";
    // cin>>m;  					// put in a number m
    long s = m;  
    int i = 0;  
    while(s/64 != 0) {  
        if(s%64 < 10){base64_string[i++] = '0'+s%64;}  
        if(s%64 >=10 && s%64 <36) {base64_string[i++] = 'a'+ s%64 -10;}
        if(s%64 >=36 && s%64 <62) {base64_string[i++] = 'A'+ s%64 - 36;}
        if(s%64 ==62) {base64_string[i++] = '+';}		// +
        if(s%64 ==63) {base64_string[i++] = '/';}		  
        s = s/64;  
    	}  

	if(s%64 < 10) {base64_string[i] = '0'+s%64;}  
    if(s%64 >=10 && s%64 <36) {base64_string[i] = 'a'+s%64 - 10;}
    if(s%64 >=36 && s%64 <62) {base64_string[i] = 'A'+s%64 - 36;}
    if(s%64 ==62) {base64_string[i] = '+';}		// +
    if(s%64 ==63) {base64_string[i] = '/';}	
	
	while(i>=0){  
        cout<<base64_string[i--];  
    	}  

	cout<<"\n";
	cout<<" Here is base64_string before reverse: ";
	cout<<base64_string;
	cout<<"\n";


string str = base64_string;  	// str is just for getting the length of base64_string

 //find out the length
 int len = str.length();

 //int len = 8;
 for (int ii = 0; ii<len/2; ii++)
 {
  //reverse
  char temp = base64_string[ii];
  base64_string[ii] = base64_string[len-ii-1];
  base64_string[len-ii-1] = temp;
 }

 // output ofter reverse
			
	cout<<"\n";
	cout<<"Here is the output_string base64_string: ";
	cout<<base64_string;
	cout<<"\n \n";

	
    return 0;  
}  

int main()  {
	char gg = covert(1234567890);
	cout<<"\n \n base64_string is here: ";
	cout<<base64_string;
	cout<<"\n \n";
}


