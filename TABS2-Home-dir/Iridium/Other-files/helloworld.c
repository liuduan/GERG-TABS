/* Hello World C Program */

#include<stdio.h>
#include <stdlib.h>
#include <string.h>			/*string operation */
#include <dirent.h> 		/*dir operation */

char *file_from_path (char *pathname){
	char *fname = NULL;
	if (pathname){
		fname = strrchr (pathname, '/') + 1;
	}
	return fname;
	}



int main()
{

	int x;            /* A normal integer*/
    int *p;           /* A pointer to an integer ("*p" is an integer, so p
                       must be a pointer to an integer) */

    p = &x;           /* Read it, "assign the address of x to p" */
    printf( "Please assign a integer to &x: ");
    x = 188;          /* Put a value in x, we could also use p here */
    printf( "Here is the value of *p: %d\n", *p ); /* Note the use of the * to get the value */

	
	
	
	int xx = sizeof("Yes Sir."); 
    printf( "Memory size of 1000 is: %d\n", xx ); /* Note the use of the * to get the value */
	
	char *path ="/home/liuduan/dog/cat/mouse/";
    char *ssc;
	int l = 0;
	ssc = strstr(path, "/");
	do{
    	l = strlen(ssc) + 1;
    	path = &path[strlen(path)-l+2];
    	ssc = strstr(path, "/");
		printf("%s\n", path);
	}while(ssc);
	
	/* char file_name[50];*/
	DIR           *d;
  	struct dirent *dir;
  	d = opendir("./Files_in_buoy");
  	if (d){
    	while ((dir = readdir(d)) != NULL){
      			printf("%s\n", dir->d_name);
				
/* ----------------------------------------------------------- */	
				char *file_name[100];
				*file_name = strdup(dir->d_name);
				printf("%s\n", *file_name);
    	}
    
  	}
	
	
	char pathname[] = "./Files_in_buoy/";
	char *fname = file_from_path (pathname);

	printf ("path \"%s\", filename \"%s\"\n", pathname,
	fname != NULL ? fname : "(null)");
	
		closedir(d);
	
// 88888888888888888**************88888888888888888888888

char *string_pointer_A = "This is in a pointer";

// string_pointer_A = string_pointer_A + 5;
// printf("%s\n",string_pointer_A);
	
string_pointer_A = "String pointer A";
printf("%s\n",string_pointer_A);
	
string_pointer_A = "This is in a pointer A";
printf("%s\n", string_pointer_A);


static char static_string[]="Static string";
printf("%s\n", static_string);

static_string[11]='B';
printf("%s\n",static_string);

char *string_pointer_B = static_string;
printf("%s\n", string_pointer_B);


char *string_pointer_AB;
// strcat(string_pointer_A, static_string);
printf("AB: %s\n", string_pointer_A);

// char new_char_string[] = string_pointer_A[1];
// printf("%s\n", new_char_string);


// strcpy(string_pointer_A, string_pointer_AB);


char *foo = "foo ";
char str[80];
strcpy (str, "TEXT ");
strcat (str, foo);
printf("str: %s\n", str);

char *bar = "bar";
strcpy(str, bar);
printf("bar copied into str: %s\n", str);

strcat (foo, bar);
printf("bar appended to foo: %s\n", foo);



	
    return 11;
}

