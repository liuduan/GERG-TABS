#include <iostream>
#include <string>
using namespace std;

void Dec_To_Hex(unsigned int);

int main()
{
unsigned int dec;
string loop;
do{
cout<<"Please enter the number you would like to convert to hexadecimal."<<endl;
cout<<"(MIN = 1, MAX = 4,294,967,295)"<<endl;
cin>>dec;
Dec_To_Hex(dec);
cout<<endl;
cout<<"Would you like to convert another number\? (Yes/No)"<<endl;
cin>>loop;
cout<<endl;
}while (loop=="Yes"||loop=="yes"||loop=="Y"||loop=="y");
cin.get();
return 0;
}

void Dec_To_Hex(unsigned int dec)
{
int c=10,c2=0,c3=0;  //counter variables
const char letter[6]={65,66,67,68,69,70};
const char number[10]={48,49,50,51,52,53,54,55,56,57};
char hex[8];
cout<<"Your number in hexadecimal form is: "<<endl;
while (dec>=1)
{
c=10;c2=0;
	if ((dec%16)<10)
   {
   while (c2!=dec%16)
   {
   c2++;
   }
   hex[c3]=number[c2];
   }

c2=0;
	if ((dec%16)>=10)
	{
 		while (dec%16!=c)
 		{
      c2++; // to get actual letter
   	c++;  // to help get place of letter[c] in letter[6] array
   	}
   hex[c3]=letter[c2];
	}
dec/=16;
c3++;  // going on to next position in the array for the output of hex conversion
}
while (c3>=0)
{
// Array needs to be displayed backwards
if (c3<=0)
	goto end;
c3--;
cout<<hex[c3];
}
end:;
}