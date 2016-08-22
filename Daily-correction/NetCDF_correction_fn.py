#
"""
#### Program Notes ####
/testpages/Daily-correction/NetCDF-correction_fn.py
This program is a function to correct NetCDF files. 
This function needs: 	
1, source file name
2, u_A_Ranges,        v_A_Ranges
3, u_offset_analysis, v_offset_analysis

This function will generate NetCDF files and save in /home/liuduan/testpages/Daily-correction/Corrected-NetCDF/
The file names will be in a format like: TABS-12-03-06-06.nc

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
	
############# ###################

def NetCDF_correction_fn(source_file, target_file, u_offset_analysis, v_offset_analysis, u_A_Ranges, v_A_Ranges):

    print "source_file:", source_file
    source_CDF = netCDF4.Dataset(source_file, mode='r')      
   
    target_CDF = netCDF4.Dataset(target_file, 'w', foremat = 'NETCDF4')  
    print "target_CDF.file_format: ", target_CDF.file_format
    target_CDF.close()

    target_CDF = netCDF4.Dataset(target_file, 'a')

    lon = target_CDF.createDimension('lon', 51)
    lat = target_CDF.createDimension('lat', 51)
    time = target_CDF.createDimension('time', None)

    longitudes = target_CDF.createVariable('lon','f8',('lon',))
    longitudes.units = 'degree east'
    longitudes.long_name = 'Longitude_degree_east'
    longitudes.standard_name = 'Longitude_degree_east'
    longitudes.point_spacing = 'even'

    latitudes = target_CDF.createVariable('lat','f8',('lat',))
    latitudes.units = 'degree north'
    latitudes.long_name = 'Latitudes_degree_north'
    latitudes.standard_name = 'Latitude_degree_north'
    latitudes.point_spacing = 'even'

    mask = target_CDF.createVariable('mask','f8',('lat','lon'))
    mask.long_name = 'Land Mask'
    mask.standard_name = 'Land_binary_mask'
    mask.units = 'nondimensional'

    water_u = target_CDF.createVariable('water_u','f8',('time', 'lat','lon',))
    water_u.long_name = 'Eastward Water Velocity'
    water_u.standard_name = 'surface_eastward_sea_water_velocity'
    water_u.units = 'm/s'
    water_u.axis = 'X'
    water_u.fill_value = 0.0
    # water_u.scale_factor = 1				## These two lines will make f8 to i8
    # water_u.add_offset = 0


    water_v = target_CDF.createVariable('water_v','f8',('time', 'lat','lon',))
    water_v.long_name = 'Northward Water Velocity'
    water_v.standard_name = 'surface_northward_sea_water_velocity'
    water_v.units = 'm/s'
    water_v.axis = 'Y'
    water_v.fill_value = 0.0
    # water_v.scale_factor = 1
    # water_v.add_offset = 0

    time = target_CDF.createVariable('time','f8',('time',))
    time.long_name = 'Valid Time'
    time.standard_name = 'time'
    time.units = 'seconds since 2003-10-28 0:00:00 0:00'
    time.axis = "T"

    target_CDF.title = "Forecast Corrected with Observation" 
    target_CDF.institution = "Texas A&M University, GERG"
    target_CDF.source = source_file + " with correction, and with longitude -98:-93; latitude 25:30"
    target_CDF.history = "Derived from " + source_file + ", only the portion in TABS eara was corrected with TABS observation.";
    target_CDF.references = "none" ;
    target_CDF.comment = "none" ;
    target_CDF.Conventions = "CF-1.0" ;
    target_CDF.grid_type = "REGULAR" ;


    # data from GROM-fore-reg-11-11-05-12-72.nc
    # data goes into GROM-fore-reg-11-11-06-12-72.nc


    """
    2, u_A_Ranges,        v_A_Ranges
    3, u_offset_analysis, v_offset_analysis

    order of the NetCDF vector:
    water_v = target_CDF.createVariable('water_v','f8',('time', 'lat','lon',))
    water_u[:,:,:] = source_CDF.variables['water_u'][12:19, :, :]

    order of the analysis: lon, lat
    xg, yg = mgrid[(-98):(-93):51j, 25:30:51j]		
    """

    # valid_time = source_CDF.variables['time'][:]


    time[:] = source_CDF.variables['time'][:]
    longitudes[:] = source_CDF.variables['lon'][:51]
    latitudes[:] = source_CDF.variables['lat'][70:121]
    # mask[:] = source_CDF.variables['mask'][70:121,:51]
# def NetCDF_correction_fn(source_file, target_file, u_offset_analysis, v_offset_analysis, u_A_Ranges, v_A_Ranges):

    print "u_offset_analysis.shape: ", u_offset_analysis.shape

    u_offset_analysis = np.int16(u_offset_analysis)
    v_offset_analysis = np.int16(v_offset_analysis)
	
    print water_u.shape
    print source_CDF.variables['water_u'][:].shape
    print "len(time)", len(time)
	
    # print "abs(-5): ", abs(-5)
    # exit()
    for lat_i in range(51):
        for lon_i in range(51):
            if (0 < u_offset_analysis[lon_i, lat_i]) and (u_offset_analysis[lon_i, lat_i] < len(time)):
                water_u[u_offset_analysis[lon_i, lat_i]:, lat_i, lon_i] = (
                    source_CDF.variables['water_u'][:(len(time)-u_offset_analysis[lon_i, lat_i]), (70 + lat_i), lon_i])		
					
            elif (u_offset_analysis[lon_i, lat_i] <= 0) and (abs(u_offset_analysis[lon_i, lat_i]) < len(time)):
                water_u[:(len(time) + u_offset_analysis[lon_i, lat_i]), lat_i, lon_i] = (
                    source_CDF.variables['water_u'][(-u_offset_analysis[lon_i, lat_i]):, (70 + lat_i), lon_i])    #############
								
            if (v_offset_analysis[lon_i, lat_i] > 0) and (v_offset_analysis[lon_i, lat_i] < len(time)):
                water_v[v_offset_analysis[lon_i, lat_i]:len(time), lat_i, lon_i] = (
                    source_CDF.variables['water_v'][:(len(time)-v_offset_analysis[lon_i, lat_i]), (70 + lat_i), lon_i])		
					
            elif (v_offset_analysis[lon_i, lat_i] <= 0) and (abs(v_offset_analysis[lon_i, lat_i]) < len(time)):
                water_v[:(len(time) + v_offset_analysis[lon_i, lat_i]), lat_i, lon_i] = (
                    source_CDF.variables['water_v'][(-v_offset_analysis[lon_i, lat_i]):, (70 + lat_i), lon_i])     ##########33
				
        if round(lat_i/5)*5 == lat_i: print "lat_i, lon_i:", lat_i, lon_i
		
    # correction for # 2, u_A_Ranges,        v_A_Ranges
    water_u = water_u * u_A_Ranges
    water_v = water_v * v_A_Ranges
	
    print water_u.shape
    print u_A_Ranges.shape



    source_CDF.close()
    target_CDF.close()
# exit()


"""
## small test for the file:
target_CDF = netCDF4.Dataset(target_file, mode='r')    
# target_CDF = netCDF4.Dataset(source_file, mode='r')  
print target_CDF.variables['water_v'][3,20,:]

target_CDF.close()

exit()

"""