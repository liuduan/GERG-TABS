#include <cstdio>
#include <string.h>  
#include<iostream>  
using namespace std;  

// This is a C++ function. 
// The purpose of the function is to convert a decimal integer to a 64base string, in order to save space.
// Be aware there are two different base64 index tables, and here we use the one that 0 is A.
// 64 base table refers to Wikipedia: http://en.wikipedia.org/wiki/Base64
// Here are the characters used in base 64 string: “ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz+/0123456789”
// 0 is A, 26 is a, 52 is 0, + is 62, / is 63
// 1234567890 in 64 base should be: BJlgLS.
// An online converter is here: http://convertxy.com/index.php/numberbases/
// by LIU Duan

char base64_string[8];  // claim a global variable.

char covert_to_base64(long m){
 	cout<<"\n1234567890 in 64 base should be: BJlgLS.";
	cout<<"\n";

    long s = m;  
    int i = 0;  

    while(s/64 != 0) {  
        if(s%64 < 26){base64_string[i++] = 'A' + s%64;} 						
        if(s%64 >=26 && s%64 <52) {base64_string[i++] = 'a'+ s%64 - 26;}
        if(s%64 >=52 && s%64 <62) {base64_string[i++] = '0'+ s%64 - 52;}
        if(s%64 ==62) {base64_string[i++] = '+';}		// +
        if(s%64 ==63) {base64_string[i++] = '/';}		  
        s = s/64;  
    	}  

	if(s%64 < 26) {base64_string[i] = 'A'+s%64;}  
    if(s%64 >=26 && s%64 <52) {base64_string[i] = 'a'+s%64 - 26;}
    if(s%64 >=52 && s%64 <62) {base64_string[i] = '0'+s%64 - 52;}
    if(s%64 ==62) {base64_string[i] = '+';}		// +
    if(s%64 ==63) {base64_string[i] = '/';}	
	
//find out the length
 	string str = base64_string;  	// str is just for getting the length of base64_string
 	int len = str.length();

//reverse
 	for (int ii = 0; ii<len/2; ii++){
  		char temp = base64_string[ii];
  		base64_string[ii] = base64_string[len-ii-1];
  		base64_string[len-ii-1] = temp;
 		}

// output ofter reverse
			
	cout<<"\n";
	cout<<"Here is the decimal integer: ";
	cout << m;
			
	cout<<"\n";
	cout<<"Here is the base64_string: ";
	cout<<base64_string;
	cout<<"\n";
    return 0;  
}  			// end of the function

int main()  {
	char gg = covert_to_base64(9876543210);
	cout<<"\nbase64_string is here: ";
	cout<<base64_string;
	cout<<"\n \n";
}


