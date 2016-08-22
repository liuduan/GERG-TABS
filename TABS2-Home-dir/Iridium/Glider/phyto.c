#include <stdio.h>
#include <stdlib.h>
nclude <iostream.h>
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
     cout << "Error " << errno << " opening " << "/dev/ttys2" << ": "
          << strerror (errno) << endl;
     }

/* *** Configure Port *** */
struct termios tty;
memset (&tty, 0, sizeof tty);

/* Error Handling */
if ( tcgetattr ( USB, &tty ) != 0 ){
     cout << "Error " << errno << " from tcgetattr: " << strerror(errno) << endl
;
     }





return 0;
}
