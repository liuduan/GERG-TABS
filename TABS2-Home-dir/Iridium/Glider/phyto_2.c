include <stdio.h>
#include <stdlib.h>
#include <unistd.h>     // UNIX standard function definitions
#include <fcntl.h>      // File control definitions
#include <errno.h>      // Error number definitions
#include <termios.h>    // POSIX terminal control definitions
#include <string.h>                     /*string operation */
#include <dirent.h>             /*dir operation */

int main()
{
printf("Hello, world! \n");

/* Open File Descriptor */
int USB = open( "/dev/ttys2", O_RDWR| O_NONBLOCK | O_NDELAY );

/* Error Handling */
if ( USB < 0 ){
     puts("Cannot open /dev/ttys2");}

/* *** Configure Port *** */
struct termios tty;
memset (&tty, 0, sizeof tty);

/* Error Handling */
if ( tcgetattr ( USB, &tty ) != 0 ){
     puts("Cannot set the port");}

/* Set Baud Rate */
cfsetospeed (&tty, B57600);
cfsetispeed (&tty, B57600);

/* Setting other Port Stuff */
tty.c_cflag     &=  ~PARENB;        // Make 8n1



/* Allocate memory for read buffer */
char buf [256];
memset (&buf, '\0', sizeof buf);

/* *** READ *** */
int n = read( USB, &buf , sizeof buf );

/* Error Handling */
if (n < 0){ puts("Cannot read from the port.");}

/* Print what I read... */
puts(buf);



return 0;
}
