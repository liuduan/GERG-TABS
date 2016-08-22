#
# model_value.py
# LIU Duan.
#
# The purpose of this module is to get the prediction data for each buoy from specific NetCDF file.
# A specific time period may be planned.
# The inputs: NetCDF file name and path, buoy name (location is in the module)
# The outputs: an array of prediction data specific for a buoy
#				an array of time series for the prediction
# 
#


import pylab as pl
from time import time
from numpy import *
import numpy as np
import netCDF4
import time
import datetime

def model_value(NetCDF_file_name, Buoy_name, start_point, end_point):
    
    global f_CDF, model_0_seconds, u, v
    # print NetCDF_file_name
    f_CDF = netCDF4.Dataset(NetCDF_file_name, mode='r')              	# NetCDF file for reading.
    
    # print "The file format is: ", f_CDF.file_format
    # print f_CDF											  # print file info
    # for dimobj in f_CDF.dimensions.values():			# info for each dimension
    #     print dimobj
 
    model_0_seconds = 1067320800.0       # "seconds at 2003-10-28 0:00:00 0:00"

    number_hours = len(f_CDF.dimensions['time'])
	
    # print "NetCDF_file_name in use: ", NetCDF_file_name
    # print "The first hour of NetCDF is: ", datetime.datetime.fromtimestamp(f_CDF.variables['time'][0] + model_0_seconds)
    # print "The last hour of NetCDF is: ", datetime.datetime.fromtimestamp(f_CDF.variables['time'][number_hours-1] + model_0_seconds)

    model_start_time = datetime.datetime.fromtimestamp(f_CDF.variables['time'][0] + model_0_seconds)
    # print "model_start_time: ", model_start_time

    u = range(0,73)
    v = range(0,73)

	
    if Buoy_name == "tabs_B_ven":
        for n in range(0,number_hours):	
            interpo("tabs_B_ven", n, -94.9186, 28.9818, 30, 109)
    elif Buoy_name == "tabs_D_ven":
        for n in range(0,number_hours):	
            interpo("tabs_D_ven", n, -96.8429, 27.9396, 11, 99)
    elif Buoy_name == "tabs_F_ven":
        for n in range(0,number_hours):	
            interpo("tabs_F_ven", n, -94.2366, 28.0825, 37, mod_lat_ele = 100)	    
    elif Buoy_name == "tabs_J_ven":
        for n in range(0,number_hours):	
            interpo("tabs_J_ven", n, -97.0507, 26.1914, mod_lon_ele = 9, mod_lat_ele = 81)
    elif Buoy_name == "tabs_K_ven":
        for n in range(0,number_hours):	
            interpo("tabs_K_ven", n, -96.4998, 26.2168, 15, 82)
    elif Buoy_name == "tabs_N_ven":
        for n in range(0,number_hours):	
            interpo("tabs_N_ven", n, -94.0367, 27.8903, 39, 98)
    elif Buoy_name == "tabs_R_ven":
        for n in range(0,number_hours):	
            interpo("tabs_R_ven", n, -93.6417, 29.635, 43, 116)
    elif Buoy_name == "tabs_V_ven":
        for n in range(0,number_hours):	
            interpo("tabs_V_ven", n, -93.5973, 27.8966, 44, 98)
    elif Buoy_name == "tabs_W_ven":
        for n in range(0,number_hours):	
            interpo("tabs_W_ven", n, -96.0058, 28.3507, 19, 103)


    t = f_CDF.variables['time']
    model_t = t[:] + model_0_seconds
    # print "model_t: ", model_t

    # print "model_t[0]: ", seconds_to_datetime(model_t[0])
    # print u
    # print v

    # longitude = f_CDF.variables['lon'][100]
    # print "longitude: ", longitude


    f_CDF.close()

    model_u = u
    model_v = v
    return model_t[start_point:end_point], model_u[start_point:end_point], model_v[start_point:end_point]
	




def d(x1, y1, x2, y2):						# calculate distances.
    distance = ((x1-x2)**2 + (y1-y2)**2)**0.5
    return distance

def interpo(buoy_name, time_ele, lon_buoy, lat_buoy, mod_lon_ele, mod_lat_ele):  

    global u, v, t, f_CDF
	     
    # print buoy_name + ": "	
    model_valid_time = datetime.datetime.fromtimestamp(f_CDF.variables['time'][time_ele] + model_0_seconds)
    # print 'model_valid_time:', time_ele, model_valid_time
    
    # Here specify the lower left conner of the model point only.
    d1 = d(lon_buoy*10, lat_buoy*10, np.math.floor(lon_buoy*10), math.floor(lat_buoy*10))
    d2 = d(lon_buoy*10, lat_buoy*10, np.math.floor(lon_buoy*10), math.ceil(lat_buoy*10))
    d3 = d(lon_buoy*10, lat_buoy*10, np.math.ceil(lon_buoy*10), math.floor(lat_buoy*10))
    d4 = d(lon_buoy*10, lat_buoy*10, np.math.ceil(lon_buoy*10), math.ceil(lat_buoy*10))

    u1 = f_CDF.variables['water_u'][time_ele, mod_lat_ele, mod_lon_ele]
    # print "f_CDF.variables['water_u'][time_ele, mod_lat_ele, mod_lon_ele], time_ele, mod_lat_ele, mod_lon_ele: "
    # print f_CDF.variables['water_u'][time_ele, mod_lat_ele, mod_lon_ele], time_ele, mod_lat_ele, mod_lon_ele
    u2 = f_CDF.variables['water_u'][time_ele, mod_lat_ele, mod_lon_ele + 1]
    u3 = f_CDF.variables['water_u'][time_ele, mod_lat_ele + 1, mod_lon_ele]
    u4 = f_CDF.variables['water_u'][time_ele, mod_lat_ele + 1, mod_lon_ele + 1]

    u[time_ele] = (u1/d1 + u2/d2 + u3/d3 + u4/d4)/(1/d1 + 1/d2 + 1/d3 + 1/d4)
	
    v1 = f_CDF.variables['water_v'][time_ele, mod_lat_ele, mod_lon_ele]
    v2 = f_CDF.variables['water_v'][time_ele, mod_lat_ele, mod_lon_ele + 1]
    v3 = f_CDF.variables['water_v'][time_ele, mod_lat_ele + 1, mod_lon_ele]
    v4 = f_CDF.variables['water_v'][time_ele, mod_lat_ele + 1, mod_lon_ele + 1]

    v[time_ele] = (v1/d1 + v2/d2 + v3/d3 + v4/d4)/(1/d1 + 1/d2 + 1/d3 + 1/d4)
	
    # print "For the lower left model element numbers (lon lat) are:", mod_lon_ele, mod_lat_ele
    # print 'lon[', mod_lon_ele, '] =', f_CDF.variables['lon'][mod_lon_ele], "      ", 'lon[', mod_lat_ele, '] =', f_CDF.variables['lat'][mod_lat_ele]
    # print buoy_name, "longitude, latitude: ", lon_buoy,  lat_buoy
    # print "For " + buoy_name + ", u = ", u    
    # print "Model u1, u2, u3, u4, time_ele were: ", u1, u2, u3, u4, time_ele
    # print "f_CDF.variables['water_u'][time_ele, 81, 9]", f_CDF.variables['water_u'][1, 81, 9]
    # print "For " + buoy_name + ", v = ", v    
    # print "Model v1, v2, v3, v4 were: ", v1, v2, v3, v4		

# From datetime to epoch seconds
def datetime_to_seconds(date_time):
    target_hour0 = datetime.datetime.strptime(date_time, "%Y-%m-%d %H:%M:%S")
    target_hour0_ep = time.mktime(target_hour0.timetuple())
    return target_hour0_ep
	
def seconds_to_datetime(ep_second):
    ep_second_back_to_datetime = datetime.datetime.fromtimestamp(ep_second)
    return ep_second_back_to_datetime
	

