#
"""
/Python/Quarter-skills/quarter_data.py
This program was designed to obtain the forecast data from the model, issue dated from 2011-Oct-1 0:00 to 2011-Dec-31 18:00.
They will be saved in several files, and one file for each buoy (current thinking).
The speed value will be u-East, v-North, not in along shore, cross shore.

Quarter_model_data.shape:  (9, 368, 73, 4)
The first dimention 9: 9 buoys, 
Buoy_names = ["tabs_B_ven", "tabs_D_ven", "tabs_F_ven", "tabs_J_ven", "tabs_K_ven", "tabs_N_ven", "tabs_R_ven", "tabs_V_ven", "tabs_W_ven"]

The second dimention 368 are the number of forecast files from 2011 Oct 1, 00:00 to 2012 Jan 1, 0:00
The third dimention 73 is the 73 hours of each forecast.
The four variables: forecast_file_seconds, t_model, u_model, v_model

After extract the data, the data is saved as a array.

The array is used to make a NetCDF file. (Fist part of the program, stop running the second part of the program).


## There is aproblem with NetCDF float point specification, all the numbers were integers. All the digits after the decimal point were cut off. 

The NetCDF file generated cannot be used. The Python array is ok (Quarter_model_data.npy).

Written by LIU Duan
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
from netCDF4 import Dataset

import opened_model_value								# get the forecast value from a NetCDF file

t_start = time.time()

###################### Functions ############################

def name_to_seconds(part_name):
    # From file name to epoch seconds. format "11-11-04-18"
    target_hour0 = datetime.datetime.strptime(part_name, "%y-%m-%d-%H")
    target_hour0_ep = time.mktime(target_hour0.timetuple())
    return target_hour0_ep
	
def seconds_to_name(ep_second):
    seconds_back_to_datetime = datetime.datetime.utcfromtimestamp(ep_second)               ## utcfromtimestamp()
    # seconds_back_to_datetime = datetime.datetime.fromtimestamp(ep_second)
    part_name = seconds_back_to_datetime.strftime("%y-%m-%d-%H")
    return part_name
	
# From datetime to epoch seconds
def datetime_to_seconds(date_time):
    # From datetime to epoch seconds. format "2011-11-04-18 15:00:00"
    target_hour0 = datetime.datetime.strptime(date_time, "%Y-%m-%d %H:%M:%S")
    target_hour0_ep = time.mktime(target_hour0.utctimetuple())     ## notice: utctimetuple()
    return target_hour0_ep
	
def seconds_to_datetime(ep_second):
    ep_second_back_to_datetime = datetime.datetime.utcfromtimestamp(ep_second)              # notice: utcfromtimestamp(ep_second)
    return ep_second_back_to_datetime

t_start = time.time()

##################################   Test the newly made NetCDF file   #############

"""
source_CDF = netCDF4.Dataset("Quarter_model_data.nc", mode='r')    

t_model = zeros(368*6)*1.0
u_model = np.zeros(368*6)
v_model = np.zeros(368*6)+0.01
for n in range(368):
    t_model[n*6:(n+1)*6] = source_CDF.variables['valid_time'][3,n,0:6]
    u_model[n*6:(n+1)*6] = source_CDF.variables['water_u'][3,n,0:6]
    v_model[n*6:(n+1)*6] = source_CDF.variables['water_v'][3,n,0:6]
print t_model
print v_model
print source_CDF.variables['water_v'][3,3,0:6]

source_CDF.close()

print t_model.shape
pl.plot(t_model[1400:], v_model[1400:])
pl.grid(True)


pl.show() 

exit()
"""







################################ Making NetCDF file from the save array.  ################################

## There is aproblem with NetCDF float point specification, all the numbers were integers. All the digits after the decimal point were cut off.

Quarter_model_data = np.load('Quarter_model_data.npy')

print "Quarter_model_data.shape: ", Quarter_model_data.shape

NetCDF_file_name = "Quarter_model_data.nc"

rootgrp = netCDF4.Dataset(NetCDF_file_name, 'w', foremat = 'NETCDF4')
print "rootgrp.file_format: ", rootgrp.file_format
rootgrp.close()

rootgrp = netCDF4.Dataset(NetCDF_file_name, 'a')

rootgrp.title = "Three Month Forecast Files For the Buoy Locations 2011 Oct 1, 0:00 to 2012 Jan 1, 0:00"
rootgrp.institution = "Texas A&M University, GERG"
rootgrp.source = "ROMS 2.1"
rootgrp.history = "LIU Duan extracted ROMS forecast data just for the nine buoy locations, and packed in this NetCDF file.";
rootgrp.references = "none" ;
rootgrp.comment = 'buoys.names: tabs_B, tabs_D, tabs_F, tabs_J, tabs_K, tabs_N, tabs_R, tabs_V, tabs_W' ;
rootgrp.Conventions = "CF-1.0" ;
rootgrp.grid_type = "REGULAR" ;

buoys = rootgrp.createDimension('buoys', 9)
forecast_files = rootgrp.createDimension('forecast_files', 368)
valid_hours = rootgrp.createDimension('valid_hours', 73)

# The four variables: forecast_file_seconds, t_model, u_model, v_model
issuing_seconds = rootgrp.createVariable('issuing_seconds','f8',('buoys', 'forecast_files', 'valid_hours',))
issuing_seconds.units = 'seconds since 2003-10-28 0:00:00 0:00'
issuing_seconds.long_name = 'Issueing_seconds_as_in_the_forecast_file_name'
issuing_seconds.standard_name = 'issuing_seconds'
issuing_seconds.point_spacing = 'even'

valid_time = rootgrp.createVariable('valid_time','f8',('buoys', 'forecast_files', 'valid_hours',))
valid_time.units = 'seconds since 2003-10-28 0:00:00 0:00'
valid_time.long_name = 'forecast_valid_time'
valid_time.standard_name = 'valid_time'
valid_time.point_spacing = 'even'

water_u = rootgrp.createVariable('water_u','f8',('buoys', 'forecast_files', 'valid_hours',))
water_u.long_name = 'Eastward Water Velocity'
water_u.standard_name = 'surface_eastward_sea_water_velocity'
water_u.units = 'm/s'
water_u.axis = 'X'
# water_u.add_offset = 0
water_u.fill_value = 0.0


water_v = rootgrp.createVariable('water_v','f8',('buoys', 'forecast_files', 'valid_hours',))
water_v.long_name = 'Northward Water Velocity'
water_v.standard_name = 'surface_northward_sea_water_velocity'
water_v.units = 'm/s'
water_v.axis = 'Y'
water_v.fill_value = 0
# water_v.add_offset = 0

# test_v = rootgrp.createVariable('test_v','f8'('buoys', 'forecast_files', 'valid_hours',))

# Quarter_model_data = np.load('Quarter_model_data.npy')
# Quarter_model_data.shape:  (9, 368, 73, 4)

issuing_seconds[:,:,:] = Quarter_model_data[:,:,:,0]
valid_time[:,:,:] = Quarter_model_data[:,:,:,1]						
water_u[:,:,:] = Quarter_model_data[:,:,:,2]
water_v[:,:,:] = Quarter_model_data[:,:,:,3]	
# issuing_seconds[3,3,3] = 6.25
# valid_time[3,3,3] = 6.25
# water_u[3,3,3] = 6.25						# testing data
# water_v[3,3,3] = 6.25						# testing data
# test_v[2,2,2] = 5.65                  # test

# print water_v
rootgrp.close()		   

## small test for the file:
source_CDF = netCDF4.Dataset("Quarter_model_data.nc", mode='r')    
# print source_CDF.variables['water_v'][3,3,:]
# print Quarter_model_data[3,3,:,3]
print "source_CDF.variables['issuing_seconds'][3,3,3]: ", source_CDF.variables['issuing_seconds'][3,3,3]
print "source_CDF.variables['valid_time'][3,3,3]: ", source_CDF.variables['valid_time'][3,3,3]
print "source_CDF.variables['water_u'][3,3,3]: ", source_CDF.variables['water_u'][3,3,3]
print "source_CDF.variables['water_v'][3,3,3]: ", source_CDF.variables['water_v'][3,3,3]
# print source_CDF.variables['test_v'][2,2,2]






exit()

################# End of the section of making NetCDF file from the save array. ########################
	
	
	


############################
### testing after the data extracted.



# testing 
print 'datetime_to_seconds("2011-10-01 00:00:00")', datetime_to_seconds("2011-10-01 00:00:00")
print seconds_to_datetime(datetime_to_seconds("2011-10-01 00:00:00"))


# Quarter_model_data[m, n,:,1], Quarter_model_data[m, n,:,2], Quarter_model_data[m, n,:,3] = opened_model_value.model_value(ff_CDF, Buoy_names[m], 0, 73)



Quarter_model_data = np.load('Quarter_model_data.npy')
print Quarter_model_data[2, 0, 1, 0]
print Quarter_model_data[2, 3, 72, 3]

print "Quarter_model_data.shape: ", Quarter_model_data.shape
exit()




################ Buoy Selection ######################

Buoy_names = ["tabs_B_ven", "tabs_D_ven", "tabs_F_ven", "tabs_J_ven", "tabs_K_ven", "tabs_N_ven", "tabs_R_ven", "tabs_V_ven", "tabs_W_ven"]

# print "This is for:", Buoy_name



############################

################################################### The Following Gets the Model Data ######################################

## Starts from 2011-10-01, 00:00 file, the issue time
## The first file to use the shift should be 2011-10-01, 00:00.


First_NetCDF_file_name = "/home/liuduan/testpages/Grom/GROM-fore-reg-11-10-01-00-72.nc"	

First_NetCDF_file_seconds = name_to_seconds(First_NetCDF_file_name[-17:-6]) + 3600       ### + 3600, if in day light saving time

                                      ########################### Number of files ################
file_numbers = 30*4*3 + 4*2                ## 31 days, 4 files per day.
# file_numbers = 12             ## testing 14

# Quarter_data[Buoy, issue_time(dimentsion), valid_time(dimension), [issue_time(varable), valid_time(variable), u, v]]
# Buoys 0-8
Quarter_model_data = ones([9, file_numbers, 73, 4])*99.9       ## The order of the last 4 values are issue_time, valid_time, u, v

"""
test = ones([9, 4])
print test
test[1,:] = [1,2,3]
print test
exit()
"""

for n in range(0, file_numbers):
    forecast_file_seconds = First_NetCDF_file_seconds + 3600*6*n
    NetCDF_file_name = "/home/liuduan/testpages/Grom/GROM-fore-reg-" + seconds_to_name(forecast_file_seconds) + "-72.nc"
	
    if os.path.exists(NetCDF_file_name) == False:
        NetCDF_file_name = "/home/liuduan/testpages/Grom/GROM-fore-reg-" + seconds_to_name(forecast_file_seconds) + "-48.nc"
        print "48 hour file is used.", 
        #continue
        # break	
    print NetCDF_file_name
    ff_CDF = netCDF4.Dataset(NetCDF_file_name, mode='r')              	# NetCDF file for reading.
	
    # continue

    Quarter_model_data[:, n, :, 0] = forecast_file_seconds
    
    for m in range(len(Buoy_names)):		
        Quarter_model_data[m, n,:,1], Quarter_model_data[m, n,:,2], Quarter_model_data[m, n,:,3] = opened_model_value.model_value(ff_CDF, Buoy_names[m], 0, 73)
		
    ff_CDF.close()	
		
		
		
		
		
		
    # Quarter_data[n,:,1], Quarter_model_data[n,:,2], J_Model_data[n,:,3] = t_valid_model, u_model, v_model 
		
	
	
	
	
    # t_valid_model, u_model, v_model = model_value.model_value(NetCDF_file_name, Buoy_name, 0, 73)
    # Quarter_data[n,:,1], Quarter_model_data[n,:,2], J_Model_data[n,:,3] = t_valid_model, u_model, v_model 
	


print Quarter_model_data[2, 0, 1, 0]
print Quarter_model_data[2, 3, 72, 3]
test = Quarter_model_data[2, 3, :, 3]

np.save('Quarter_model_data', Quarter_model_data)
print 'The calculated in %7.3f seconds' % (time.time()-t_start)
exit()

