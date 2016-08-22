#
"""
#### Program Notes ####
/Python/NetCDF/making_NetCDF.py
Purpose: When a model NetCDF file is unavailable, generate the file using previously available file.

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


###################### functions #####################
# From datetime to epoch seconds
def datetime_to_seconds(date_time):
    target_hour0 = datetime.datetime.strptime(date_time, "%Y-%m-%d %H:%M:%S")
    target_hour0_ep = time.mktime(target_hour0.utctimetuple())     ## notice: utctimetuple()
    return target_hour0_ep
	
def seconds_to_datetime(ep_second):
    ep_second_back_to_datetime = datetime.datetime.utcfromtimestamp(ep_second)              # notice: utcfromtimestamp(ep_second)
    return ep_second_back_to_datetime
	
############# testing ###################
# print "Today is day", time.gmtime()
print seconds_to_datetime(datetime_to_seconds("2012-01-01 12:00:00"))	

print "Epoch 0 second is: ", datetime.datetime.utcfromtimestamp(0)
print "datetime_to_seconds('2003-10-28 00:00:00'):", datetime_to_seconds('2003-10-28 00:00:00')
# exit()

t_start = time.time()

################################

source_file = "/home/liuduan/testpages/Grom/GROM-fore-reg-12-03-24-18-72.nc"
target_file = "/home/liuduan/testpages/Grom/GROM-fore-reg-12-03-26-00-72.nc"

################# Small Test for target file ##############

"""
## small test for the file:
target_CDF = netCDF4.Dataset(target_file, mode='r')    
# target_CDF = netCDF4.Dataset(source_file, mode='r')  
print target_CDF.variables['water_v'][3,20,:]

target_CDF.close()
"""
# exit()
###############################




rootgrp = netCDF4.Dataset(target_file, 'w', foremat = 'NETCDF4')
# rootgrp = netCDF4.Dataset('NetCDF_test.nc', 'w', foremat = 'NETCDF4')
print "rootgrp.file_format: ", rootgrp.file_format
rootgrp.close()

rootgrp = netCDF4.Dataset(target_file, 'a')

lon = rootgrp.createDimension('lon', 171)
lat = rootgrp.createDimension('lat', 131)
time = rootgrp.createDimension('time', None)

longitudes = rootgrp.createVariable('lon','f8',('lon',))
longitudes.units = 'degree east'
longitudes.long_name = 'Longitude_degree_east'
longitudes.standard_name = 'Longitude_degree_east'
longitudes.point_spacing = 'even'

latitudes = rootgrp.createVariable('lat','f8',('lat',))
latitudes.units = 'degree north'
latitudes.long_name = 'Latitudes_degree_north'
latitudes.standard_name = 'Latitude_degree_north'
latitudes.point_spacing = 'even'

water_u = rootgrp.createVariable('water_u','f8',('time', 'lat','lon',))
water_u.long_name = 'Eastward Water Velocity'
water_u.standard_name = 'surface_eastward_sea_water_velocity'
water_u.units = 'm/s'
water_u.axis = 'X'
water_u.fill_value = 0.0
# water_u.scale_factor = 1				## These two lines will make f8 to i8
# water_u.add_offset = 0


water_v = rootgrp.createVariable('water_v','f8',('time', 'lat','lon',))
water_v.long_name = 'Northward Water Velocity'
water_v.standard_name = 'surface_northward_sea_water_velocity'
water_v.units = 'm/s'
water_v.axis = 'Y'
water_v.fill_value = 0.0
# water_v.scale_factor = 1
# water_v.add_offset = 0

time = rootgrp.createVariable('time','f8',('time',))
time.long_name = 'Valid Time'
time.standard_name = 'time'
time.units = 'seconds since 2003-10-28 0:00:00 0:00'
time.axis = "T"

rootgrp.title = "Makeup file for " + target_file
rootgrp.institution = "Texas A&M University, GERG"
rootgrp.source = "ROMS 2.1"
rootgrp.history = "This file was missing, so LIU Duan used " + source_file + " to generate" ;
rootgrp.references = "none" ;
rootgrp.comment = "none" ;
rootgrp.Conventions = "CF-1.0" ;
rootgrp.grid_type = "REGULAR" ;



# data from GROM-fore-reg-11-11-05-12-72.nc
# data goes into GROM-fore-reg-11-11-06-12-72.nc

source_CDF = netCDF4.Dataset(source_file, mode='r')      

time[:] = source_CDF.variables['time'][30:37]						###################  Change these 3 lines    ################
water_u[:,:,:] = source_CDF.variables['water_u'][30:37, :, :]
water_v[:,:,:] = source_CDF.variables['water_v'][30:37, :, :]

print "source time 0:", seconds_to_datetime(source_CDF.variables['time'][0] + 1067320800.0)
print "source time 0:", source_CDF.variables['time'][0]
print "target time 0", seconds_to_datetime(rootgrp.variables['time'][0] + 1067320800.0)
print "target time 6", seconds_to_datetime(rootgrp.variables['time'][6] + 1067320800.0)



source_CDF.close()
rootgrp.close()


## small test for the file:
target_CDF = netCDF4.Dataset(target_file, mode='r')    
# target_CDF = netCDF4.Dataset(source_file, mode='r')  
print target_CDF.variables['water_v'][3,20,:]

target_CDF.close()
exit()




exit()

