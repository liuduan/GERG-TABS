

// This is a C function. 
// The purpose of this C function is to read current measurement values from a file,
// The file name will be similar to 20120723293000-dcs_AVG.txt,
// It should take the file name from the parental program, and the length of the binary
// This function should return a char string with binary code.
// by LIU Duan


// decimal number to binary string.
const char * Current_bina(char current_filename){
	static char Current_bin_string[25] = "it is right.";
	memset(Current_bin_string, 0, sizeof Current_bin_string);

  	FILE * fp;
   	char * line = NULL;
   	size_t len = 0;
   	size_t read;

   	fp = fopen("./Files_in_buoy/20120723193000-dcs_AVG.txt", "r");
   	// fp = fopen(current_filename, "r");							// should look like this later
    if (fp == NULL)
      	puts("File opening failure.");

    while ((read = getline(&line, &len, fp)) != -1) {
       	printf("Retrieved line of length %zu :\n", read);
       	printf("Line: \n %s \n", line);
			
					
		// time handling
		char time_fragment[255]; 
		strncpy(time_fragment, line+1, 16);
		puts(time_fragment);
		
		struct tm struct_obs_time;

        char time_buffer[255] = "";

		// memset(&struct_obs_time, 0, sizeof(struct struct_obs_time));
		strptime(time_fragment, "%Y-%m-%d %H:%M", &struct_obs_time);
		strftime(time_buffer, sizeof(time_buffer), "Day %j in the year (1-366), %Y-%b-%d %H:%M", &struct_obs_time);
		puts(time_buffer);

		char Julian_day_ch[4];
		int Julian_day_n;
		strftime(Julian_day_ch, sizeof(Julian_day_ch), "%j", &struct_obs_time);
		printf("\n Julian_day in character: %s (1-366)\n", Julian_day_ch);
		sscanf(Julian_day_ch, "%d", &Julian_day_n);
		printf("Julian_day in number: %d\n", Julian_day_n);
		
		char Hour_ch[3];
		int Hour_n;
		strftime(Hour_ch, sizeof(Hour_ch), "%H", &struct_obs_time);
		printf("\n Hour in character: %s \n", Hour_ch);
		
		sscanf(Hour_ch, "%d", &Hour_n);
		printf("Hour in number: %d\n", Hour_n);
		
		char Minutes_ch[3];
		int Minutes_n;
		strftime(Minutes_ch, sizeof(Minutes_ch), "%M", &struct_obs_time);
		printf("\n Minutes in character: %s \n", Minutes_ch);
		
		sscanf(Minutes_ch, "%d", &Minutes_n);
		printf("Minutes in number: %d\n", Minutes_n);
		
		int Half_hrs = (Julian_day_n - 1) * 48 + Hour_n * 2 + (Minutes_n/30+0.5);
		printf("\n Half hours since the beginning of year: %d\n", Half_hrs);
		
		
		//printf("\nIn binary the number is: %s\n", deci_to_bina(Half_hrs));
		
		printf("\n2 in binary the number is: %s\n", deci_to_bina(2));
		
       	}	// end of while ((read = getline(&line, &len, fp)) != -1) 
       	if (line)
           	free(line);		
			
		//Current_bin_string = "It is right.";
		return Current_bin_string;
	}




//***************************************************
	
	






