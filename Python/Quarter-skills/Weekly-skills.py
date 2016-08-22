#
"""
/Python/Annual-skills/Monthly-skills.py
This program was designed to calculate monthly skill of the ROMS model.
There are two ways to calculate the monthly skill,
1) Calculate the skill of each forecast, and the forecasts are issued four times a day. Each forecast predicts the current for next three days, then average for a month.
2) Use the first six hours of prediction from each forecast, and connect the forecast to a month or a year. The skill value of the whole month or whole year can then be calculated.

This program will try the first way.

Give one file NetCDF file get skill value for all the stations.



#
"""

from numpy import *
import numpy as np

import scipy, pylab
import scipy.optimize


from time import time
import time
import datetime

import MySQLdb
import pylab as pl
import netCDF4

import one_nc_skill
# import Interpolation_1D                            # def interpolation(xi, Obsv, Obs_err, Bkg_err, Max_Bkg_err_va): 
# import model_value								# get the forecast value from a NetCDF file


t_start = time.time()

###################### Functions ############################
# From file name to epoch seconds. format "11-11-04-18"
def name_to_seconds(part_name):
    target_hour0 = datetime.datetime.strptime(part_name, "%y-%m-%d-%H")
    target_hour0_ep = time.mktime(target_hour0.timetuple())
    return target_hour0_ep
	
def seconds_to_name(ep_second):
    seconds_back_to_datetime = datetime.datetime.fromtimestamp(ep_second)
    part_name = seconds_back_to_datetime.strftime("%y-%m-%d-%H")
    return part_name
	
###########################

First_NetCDF_file_name = "/home/liuduan/testpages/Grom/GROM-fore-reg-11-11-04-00-72.nc"	

# print "NetCDF_file_name[-17:-6]  = ", First_NetCDF_file_name[-17:-6]
# "/home/norman/grom/GROM-fore-reg-11-11-05-00-72.nc"	
forecast_file_seconds = name_to_seconds(First_NetCDF_file_name[-17:-6])

file_number = 5										##################### 10 files per week number
NetCDF_file = range(0, file_number)
all_skills = range(0, file_number*34)
all_skills[0] = 0.1

all_skills = array(all_skills).reshape(file_number, 34)
print all_skills

# exit()
for i in range(0, file_number):    
    #print "i: ", i
    NetCDF_file[i] = "/home/liuduan/testpages/Grom/GROM-fore-reg-" + seconds_to_name(forecast_file_seconds + 3600*6*i) + "-72.nc"
    print NetCDF_file[i] 

    try:
        f_CDF2 = netCDF4.Dataset(NetCDF_file[i], mode='r')              	# NetCDF file for reading.
        f_CDF2.close()
        print "Do this, if the file exist." + NetCDF_file[i] + "########################################"
		# one_nc_skill.one_nc_skill(NetCDF_file[i])
        all_skills[i,:] = one_nc_skill.one_nc_skill(NetCDF_file[i])
		
		

    except (RuntimeError):
        print "RuntimeError, and the file does not exist" + NetCDF_file[i] + "#########################"
        print "Go next file here."

print all_skills
	
np.savetxt('all_skills.dat', all_skills)

print 'Weekly-skills.py calculated in %7.3f seconds' % (time.time()-t_start)
exit()
###################### Functions ##########################

# From datetime to epoch seconds. format "11-11-04-18 04:25:48"
def datetime_to_seconds(date_time):
    target_hour0 = datetime.datetime.strptime(date_time, "%Y-%m-%d %H:%M:%S")
    target_hour0_ep = time.mktime(target_hour0.timetuple())
    return target_hour0_ep
	
def seconds_to_datetime(ep_second):
    ep_second_back_to_datetime = datetime.datetime.fromtimestamp(ep_second)
    return ep_second_back_to_datetime
	

# From file name to epoch seconds. format "11-11-04-18"
def name_to_seconds(part_name):
    target_hour0 = datetime.datetime.strptime(part_name, "%y-%m-%d-%H")
    target_hour0_ep = time.mktime(target_hour0.timetuple())
    return target_hour0_ep
	
def seconds_to_name(ep_second):
    seconds_back_to_datetime = datetime.datetime.fromtimestamp(ep_second)
    part_name = seconds_back_to_datetime.strftime("%y-%m-%d-%H")
    return part_name
	
######## Start time and End time for skill calculation ########

# First NetCDF file is 11-10-01-00 (2011 Oct 1), last NetCDF file is 2011-10-31-18

######## Give one NetCDF file name, get the skill value for all the stations. ######



###### Find out whether the file is exist? #######
	###### If the file exist, how many hours of forecast are in it? #########


###################### Prepare for getting forecast data from a NetCDF file #################


NetCDF_file_name = "/home/norman/grom/GROM-fore-reg-11-11-05-00-72.nc"							#### NetCDF file here.

#### Detect the existancy of the file
try:
    f_CDF = netCDF4.Dataset(NetCDF_file_name, mode='r')              	# NetCDF file for reading.
    print "Do this, if the file exist."
    f_CDF.close()
except (RuntimeError):
    print "RuntimeError, and the file does not exist"
    print "Go next file here."


#### Detect how many hours are in the forecast

f_CDF = netCDF4.Dataset(NetCDF_file_name, mode='r')              	# NetCDF file for reading.

print "Number of hours in the forecast: ", len(f_CDF.dimensions['time'])




f_CDF.close()


exit()


