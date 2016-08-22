
// This is a C function. 
// The purpose of this C function is to read current measurement values from a file,
// The file name will be similar to 20120723293000-dcs_AVG.txt,
// It should take the file name from the parental program, and the length of the binary
// This function should return a char string with binary code.
// by LIU Duan


// decimal number to binary string.
const char * Current_bina(char * file_path){
	static char Current_bin_string[256];	
	memset(Current_bin_string, 0, sizeof Current_bin_string);

  	FILE * fp;
   	char * line = NULL;
   	size_t len = 0;
   	size_t read;

   	// fp = fopen("./Files_in_buoy/20120723193000-dcs_AVG.txt", "r");
   	fp = fopen(file_path, "r");							// should look like this later
    if (fp == NULL)
      	puts("File opening failure.");

    while ((read = getline(&line, &len, fp)) != -1) {
       	printf("Retrieved line of length %zu :\n", read);
       	printf("Line: \n %s \n", line);
			
					
		// time handling ***********************************
		char time_fragment[100]; 
		memset(time_fragment, 0, sizeof(time_fragment));
		strncpy(time_fragment, line+1, 16);
		printf("time_fragment: %s \n", time_fragment);
		
		struct tm struct_obs_time;

        char time_buffer[255] = "";
		memset(time_buffer, 0, sizeof(time_buffer));

		// memset(&struct_obs_time, 0, sizeof(struct struct_obs_time));
		strptime(time_fragment, "%Y-%m-%d %H:%M", &struct_obs_time);
		strftime(time_buffer, sizeof(time_buffer), "Day %j in the year (1-366), %Y-%b-%d %H:%M", &struct_obs_time);
		printf("time_buffer: %s \n", time_buffer);

		char Julian_day_ch[4];
		int Julian_day_n;
		strftime(Julian_day_ch, sizeof(Julian_day_ch), "%j", &struct_obs_time);
		printf("\nJulian_day in character: %s (1-366)\n", Julian_day_ch);
		sscanf(Julian_day_ch, "%d", &Julian_day_n);
		printf("Julian_day in number: %d \n", Julian_day_n);
		
		char Hour_ch[3];
		int Hour_n;
		strftime(Hour_ch, sizeof(Hour_ch), "%H", &struct_obs_time);
		printf("\nHour in character: %s \n", Hour_ch);
		
		sscanf(Hour_ch, "%d", &Hour_n);
		printf("Hour in number: %d \n\n", Hour_n);
		
		char Minutes_ch[3];
		int Minutes_n;
		strftime(Minutes_ch, sizeof(Minutes_ch), "%M", &struct_obs_time);
		printf("Minutes in character: %s \n", Minutes_ch);
		
		sscanf(Minutes_ch, "%d", &Minutes_n);
		printf("Minutes in number: %d \n\n", Minutes_n);
		
		int Half_hrs = (Julian_day_n - 1) * 48 + Hour_n * 2 + (Minutes_n/30+0.5);
		printf("Half hours since the beginning of year: %d\n", Half_hrs);
		
		char Half_hrs_bi[16];
		strcpy(Half_hrs_bi, deci_to_bina(Half_hrs, 15));
		printf("In binary the number is: %s\n", Half_hrs_bi);
		printf("15 binary digits for half hours, half hours from January 1. \n\n");
		

		// Vn, Ve current **************************************************************
		// Vn ***************
		char Vn_ch[16]; 
		memset(Vn_ch, 0, sizeof(Vn_ch));
		strncpy(Vn_ch, line+51, 11);
		printf("Vn in characters: %s \n", Vn_ch);

		float Vn_n;
		sscanf(Vn_ch, "%f", &Vn_n);
		printf("Vn in number: %f \n", Vn_n);
		
		int Vn_i = Vn_n + 300.5;
		printf("Vn in 1-600 integer: %i ", Vn_i);
		
		char Vn_bi[11];
		strcpy(Vn_bi, deci_to_bina(Vn_i, 10));
		printf("In binary the number is: %s\n", Vn_bi);
		printf("10 binary digits for Vn, +/-300 cm/s, accurate to 1 cm/s, 0 at -300 cm/s. \n\n");
		
		
		// Ve ******************
		char Ve_ch[16]; 
		memset(Ve_ch, 0, sizeof(Ve_ch));
		strncpy(Ve_ch, line+63, 11);
		printf("Ve in characters: %s \n", Ve_ch);

		float Ve_n;
		sscanf(Ve_ch, "%f", &Ve_n);
		printf("Ve in number: %f \n", Ve_n);
		
		int Ve_i = Ve_n + 300.5;
		printf("Ve in 1-600 integer: %i ", Ve_i);
		char Ve_bi[11];
		strcpy(Ve_bi, deci_to_bina(Ve_i, 10));
		printf("In binary the number is: %s\n", Ve_bi);
		printf("10 binary digits for Ve, +/-300 cm/s, accurate to 1 cm/s, 0 at -300 cm/s. \n\n");
		

		// Temperature **************************************************************
		char Temp_ch[16]; 
		memset(Temp_ch, 0, sizeof(Temp_ch));
		strncpy(Temp_ch, line+74, 10);
		printf("Temp in characters: %s \n", Temp_ch);

		float Temp_n;
		sscanf(Temp_ch, "%f", &Temp_n);
		printf("Temp in float number: %f \n", Temp_n);
		
		int Temp_i = Temp_n * 100 + 0.5;
		printf("Temp in 0-3500 integer: %i ", Temp_i);
		
		char Temp_bi[13];
		strcpy(Temp_bi, deci_to_bina(Temp_i, 12));
		printf("In binary the number is: %s\n", Temp_bi);
		printf("12 binary digits for Temp, 0 - 35 C, accurate to 0.01C, 0 at 0C. \n\n");
		

		// Signal Strength, sigstr **************************************************************
		char Sigstr_ch[16]; 
		memset(Sigstr_ch, 0, sizeof(Sigstr_ch));
		strncpy(Sigstr_ch, line+84, 11);
		printf("Sigstr (Signal strength) in characters: %s \n", Sigstr_ch);

		float Sigstr_n;
		sscanf(Sigstr_ch, "%f", &Sigstr_n);
		printf("Sigstr (Signal strength) in float number: %f \n", Sigstr_n);
		
		int Sigstr_i = Sigstr_n + 30.5;
		printf("Sigstr (Signal strength) in 0-30 integer: %i ", Sigstr_i);
		
		char Sigstr_bi[6];
		strcpy(Sigstr_bi, deci_to_bina(Sigstr_i, 5));
		printf("In binary the number is: %s\n", Sigstr_bi);
		printf("5 binary digits for Sigstr (Signal strength), -30 - 0, accurate to 1, 0 at -30. \n\n");
		
		
		// Compass **************************************************************
		char Compass_ch[16]; 
		memset(Compass_ch, 0, sizeof(Compass_ch));
		strncpy(Compass_ch, line+94, 11);
		printf("Compass in characters: %s \n", Compass_ch);

		float Compass_n;
		sscanf(Compass_ch, "%f", &Compass_n);
		printf("Compass in float number: %f \n", Compass_n);
		
		int Compass_i = Compass_n + 0.5;
		printf("Compass in 0-359 integer: %i ", Compass_i);
		
		char Compass_bi[10];
		strcpy(Compass_bi, deci_to_bina(Compass_i, 9));
		printf("In binary the number is: %s\n", Compass_bi);
		printf("9 binary digits for Compass, 0 - 359 degrees, accurate to 1 degree, 0 at 0. \n\n");
		
		
		// Tilt_x **************************************************************
		char Tilt_x_ch[16]; 
		memset(Tilt_x_ch, 0, sizeof(Tilt_x_ch));
		strncpy(Tilt_x_ch, line+105, 11);
		printf("Tilt_x in characters: %s \n", Tilt_x_ch);

		float Tilt_x_n;
		sscanf(Tilt_x_ch, "%f", &Tilt_x_n);
		printf("Tilt_x in float number: %f \n", Tilt_x_n);
		
		int Tilt_x_i = Tilt_x_n + 90.5;
		printf("Tilt_x in 0-180 integer: %i ", Tilt_x_i);
		
		char Tilt_x_bi[9];
		strcpy(Tilt_x_bi, deci_to_bina(Tilt_x_i, 8));
		printf("In binary the number is: %s\n", Tilt_x_bi);
		printf("8 binary digits for Tilt_x, +/-90 degrees, accurate to 1 degree, 0 at -90 degree. \n\n");
	
	
		// Tilt_y **************************************************************
		char Tilt_y_ch[16]; 
		memset(Tilt_y_ch, 0, sizeof(Tilt_y_ch));
		strncpy(Tilt_y_ch, line+116, 11);
		printf("Tilt_y in characters: %s \n", Tilt_y_ch);

		float Tilt_y_n;
		sscanf(Tilt_y_ch, "%f", &Tilt_y_n);
		printf("Tilt_y in float number: %f \n", Tilt_y_n);
		
		int Tilt_y_i = Tilt_y_n + 90.5;
		printf("Tilt_y in 0-180 integer: %i ", Tilt_y_i);
		char Tilt_y_bi[9];
		strcpy(Tilt_y_bi, deci_to_bina(Tilt_y_i, 8));
		printf("In binary the number is: %s\n", Tilt_y_bi);
		printf("8 binary digits for Tilt_y, +/-90 degrees, accurate to 1 degree, 0 at -90 degree. \n\n");
			

		// Ping counts **************************************************************
		char Pings_ch[16]; 
		memset(Pings_ch, 0, sizeof(Pings_ch));
		strncpy(Pings_ch, line+127, 11);
		printf("Pings in characters: %s", Pings_ch);

		float Pings_n;
		sscanf(Pings_ch, "%f", &Pings_n);
		printf("Ping counts in float number: %f \n", Pings_n);
		
		int Pings_i = Pings_n + 0.5;
		printf("Pings in 0-180 integer: %i ", Pings_i);
		char Pings_bi[10];
		strcpy(Pings_bi, deci_to_bina(Pings_i, 9));
		printf("In binary the number is: %s\n", Pings_bi);
		printf("9 binary digits for Pings counts, 0 - 300, accurate to 1, 0 at 0. \n\n");
	

		strcat(Current_bin_string, Half_hrs_bi);
		strcat(Current_bin_string, Vn_bi);
		strcat(Current_bin_string, Ve_bi);
		strcat(Current_bin_string, Temp_bi);
		strcat(Current_bin_string, Sigstr_bi);
		strcat(Current_bin_string, Compass_bi);
		strcat(Current_bin_string, Tilt_x_bi);
		strcat(Current_bin_string, Tilt_y_bi);
		strcat(Current_bin_string, Pings_bi);

		
		
		
		
		
       	}	// end of while ((read = getline(&line, &len, fp)) != -1) 

				

		
		       	if (line)
           	free(line);		
		printf("The Current_bin_string has 86 characters: \n%s \n\n", Current_bin_string);
		return Current_bin_string;
	}




//***************************************************
	
	



