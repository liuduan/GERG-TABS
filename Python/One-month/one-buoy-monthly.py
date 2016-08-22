#
"""
#### Program Notes ####
/Python/One-month/one-buoy-monthly.py
This program should get the forecast model data from Dec 1, 2011 to Jan 1 2012.
#
"""
import os.path
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

import model_value								# get the forecast value from a NetCDF file


t_start = time.time()

###################### Functions ##########################
	
# From datetime to epoch seconds
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
	
################ Buoy Selection ######################

# Buoy_name = "tabs_B_ven"
# Buoy_name = "tabs_D_ven"		# Buoy D is down at 2011/11/07
# Buoy_name = "tabs_F_ven"
Buoy_name = "tabs_J_ven"
# Buoy_name = "tabs_K_ven"
# Buoy_name = "tabs_N_ven"
# Buoy_name = "tabs_R_ven"
# Buoy_name = "tabs_V_ven"
# Buoy_name = "tabs_W_ven"


## Starts from 2011-12-01, 00:00 file
## The first file to use the shift should be 2011-11-01, 00:00.
## Just for Buoy J and Buoy K, the angles are 0 degree, so u is cross shore, and v is along shore.


First_NetCDF_file_name = "/home/liuduan/testpages/Grom/GROM-fore-reg-11-12-01-00-72.nc"	

forecast_file_seconds = name_to_seconds(First_NetCDF_file_name[-17:-6])

                                      ########################### Number of files ################
file_numbers = 31*4                ## 31 days, 4 files per day.
# file_numbers = 4  

t_6Hr = range(6)*0
u_6Hr = range(6)*0
v_6Hr = range(6)*0
t_model  = []
u_model  = []
v_model  = []


for n in range(0, file_numbers):
    print n
    NetCDF_file_name = "/home/liuduan/testpages/Grom/GROM-fore-reg-" + seconds_to_name(forecast_file_seconds + 3600*6*n) + "-72.nc"

    if os.path.exists(NetCDF_file_name) == False:
        NetCDF_file_name = "/home/liuduan/testpages/Grom/GROM-fore-reg-" + seconds_to_name(forecast_file_seconds + 3600*6*n) + "-48.nc"
        print "48 hour file is used."
        #continue
        # break	
	
    t_6Hr, u_6Hr, v_6Hr = model_value.model_value(NetCDF_file_name, Buoy_name, 0, 6)
    t_model.append(t_6Hr)
    u_model.append(u_6Hr)
    v_model.append(v_6Hr)

# print t_model
# exit()

t_model = array(t_model)
u_model = array(u_model)
v_model = array(v_model)

print t_model.shape
# exit()

t_model = t_model.reshape(744)			# shoudl be 744
u_model = u_model.reshape(744)
v_model = v_model.reshape(744)
# print v_model.shape
# print v_model


t_model_2x = zeros([len(t_model)*2])
u_model_2x = zeros([len(t_model)*2])
v_model_2x = zeros([len(t_model)*2])
t_model_2x[::2] = t_model[:]
u_model_2x[::2] = u_model[:]
v_model_2x[::2] = v_model[:]

for n in range(1,len(t_model_2x)-1,2):
    t_model_2x[n] = (t_model_2x[n-1] + t_model_2x[n+1])/2
    u_model_2x[n] = (u_model_2x[n-1] + u_model_2x[n+1])/2
    v_model_2x[n] = (v_model_2x[n-1] + v_model_2x[n+1])/2
    # print n

t_model_2x[-1] = 2 * t_model_2x[-2] - t_model_2x[-3]
u_model_2x[-1] = 2 * u_model_2x[-2] - u_model_2x[-3]
v_model_2x[-1] = 2 * v_model_2x[-2] - v_model_2x[-3]

# print t_model_2x
pl.plot(v_model)
pl.plot(v_model_2x)
pl.grid(True)

print "seconds_to_datetime(t_model_2x[0]): ", seconds_to_datetime(t_model_2x[0])
print "seconds_to_datetime(t_model_2x[-1]): ", seconds_to_datetime(t_model_2x[-1])
print 'Calculated in %7.3f seconds' % (time.time()-t_start)

pl.show()	
exit()



