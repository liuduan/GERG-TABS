

// This is a C program with the common functions for reading directory file names and converting decimal number to binary. 
// by LIU Duan


// fuction to list files in a directory
size_t file_list(const char *path, char ***ls) {
    size_t count = 0;
    size_t length = 0;
    DIR *dp = NULL;
    struct dirent *ep = NULL;

    dp = opendir(path);
    if(NULL == dp) {
        fprintf(stderr, "no such directory: '%s'", path);
        return 0;
    }

    *ls = NULL;
    ep = readdir(dp);
    while(NULL != ep){
        count++;
        ep = readdir(dp);
    }

    rewinddir(dp);
    *ls = calloc(count, sizeof(char *));

    count = 0;
    ep = readdir(dp);
    while(NULL != ep){
        (*ls)[count++] = strdup(ep->d_name);
        ep = readdir(dp);
    }

    closedir(dp);
    return count;
}	// end of the function size_t file_list(const char *path, char ***ls)



// ***************** To convert decimal number to binary string. ************************
const char * deci_to_bina(int deci, int length_needed){
	// To test whether the length_needed is enough.
	if (deci >= (double)pow(2, length_needed)) printf("\nThe provided length is insufficient.\n");
	
	static char binary_string[50];
	memset(binary_string, 0, sizeof binary_string);
	int j;
	for (j = 0; j < length_needed ; j++) binary_string[j] = '0';		// set first length_needed places to 0
	  
	long s = deci;
	int i = 0;  	
    while(s/2 != 0) {  
        if(s%2 == 0){binary_string[i++] = '0';} 						
        if(s%2 == 1){binary_string[i++] = '1';} 		  
        s = s/2;  
    	}  

    if(s%2 == 0){binary_string[i++] = '0';} 						
    if(s%2 == 1){binary_string[i++] = '1';} 	
	
	//find out the length
	int len = strlen(binary_string);

	//reverse
	int ii;
 	for (ii = 0; ii<len/2; ii++){
  		char temp = binary_string[ii];
  		binary_string[ii] = binary_string[len-ii-1];
  		binary_string[len-ii-1] = temp;
 		}

	printf("\nHere are the decimal number: %d, and the binary_string: %s. \n", deci, binary_string);

	return binary_string;
}  			// end of the function: const char * deci_to_bina(int deci)


	
	
	





