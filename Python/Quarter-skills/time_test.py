#
"""

Purpose: 
to test the time conversion.
"""

from time import time
import time
import datetime

import netCDF4


###################### Functions ##########################

def datetime_to_seconds(date_time):
    # From datetime to epoch seconds. format "2011-11-04-18 15:00:00"
    time_object = datetime.datetime.strptime(date_time, "%Y-%m-%d %H:%M:%S")
    ep_seconds = netCDF4.date2num(time_object, "seconds since 1970-01-01 00:00:00")
    return ep_seconds
	
def seconds_to_datetime(ep_second):
    ep_second_back_to_datetime = datetime.datetime.utcfromtimestamp(ep_second)              # notice: utcfromtimestamp(ep_second)
    return ep_second_back_to_datetime
	
	
################################################


print datetime_to_seconds("2003-10-28 00:00:00")

print seconds_to_datetime(1067299200.0)

