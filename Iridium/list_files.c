#include <stdio.h>			// Standard input output.
#include <stdlib.h> 		// Standard library.
#include <string.h>			// String handling
#include <time.h>			// Time handling
#include <dirent.h>			// Directory and file handling
#include <malloc.h>
#include <math.h> 			// math functions

#define _GNU_SOURCE
#include "Common_functions.h"
#include "Current_bina.h"

// This is a C program. 
// The purpose of this C program is to read measurement values from each file,
// and convert them into minimal number of binary numbers, while still remaining clearity.
// So we can send the number via Iridium setllite, and reduce the communication cost.
// An online converter is here: http://convertxy.com/index.php/numberbases/
// by LIU Duan


int main(int argc, char **argv) {

char file_path[100] = "./Files_in_buoy/";			// at this step file path is a dir name.
char **files;
size_t count;
int i;

count = file_list(file_path, &files);
for (i = 0; i < count; i++) {
    printf("%s\n", files[i]);
	if (strstr(files[i], "dcs_AVG.txt")){
		printf("A current meter measurement was found: \n         %s\n", files[i]);

		strcat(file_path, files[i]);			// At this step file name is added to the file_path.
		printf("888 fild_path is: %s \n\n", file_path);

		
		printf("What is coming back: %s \n", Current_bina(file_path));
       	}






	}
	

char *abc;
abc = "lamp";
// printf("\n *abc: %s\n", *abc);
printf("\n abc: %s\n", abc);
//printf("\n &abc: %s\n", &abc);

//char a[] = "book";
char a[] = "book";	
strcpy(a, abc);
printf("\n a: %s\n", a);

}





