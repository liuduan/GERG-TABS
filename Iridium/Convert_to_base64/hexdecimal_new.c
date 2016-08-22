// 基础练习 十进制转十六进制  
  
#include <stdio.h>  
#include <string.h>  
  
int main()  
{  
    int i = 0, nDec = 0, temp = 0;  
    char strHex[12];  
  
    scanf("%d",&nDec);  
    if (nDec != 0)  
    {  
        while (nDec)  
        {  
            temp = nDec%16;  
            switch(temp)  
            {  
            case 10: strHex[i] = 'A'; break;  
            case 11: strHex[i] = 'B'; break;  
            case 12: strHex[i] = 'C'; break;  
            case 13: strHex[i] = 'D'; break;  
            case 14: strHex[i] = 'E'; break;  
            case 15: strHex[i] = 'F'; break;  
            default: strHex[i] = (temp+'0'); break;  
            }  
            ++i;  
            nDec /= 16;  
        }  
        strHex[i] = '\0';  
        temp = strlen(strHex)-1;  
          
        for (i = temp; i >= 0; --i)  
            printf("%c",strHex[i]);  
		printf("\n");
    }  
    else  
        printf("0");  
  
    return 0;  
}  