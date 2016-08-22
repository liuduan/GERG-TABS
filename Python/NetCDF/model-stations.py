#!/usr/bin/env python
# encoding: utf-8
"""
Python/NetCDF/model-stations.py
This file is in my crontab, and running every 30 minutes.
This Python program takes NetCDF file from /home/liuduan/testpages/Grom/ and isolate the value at the buoy locations. 
These values are saved in the file model-value.txt.
"""

import matplotlib
from matplotlib.pyplot import *

import numpy as np
from numpy import *

import os
import netCDF4
import time
import datetime
import shutil
import csv


from pylab import *

# Function find most recent file.
def find_most_recent(directory, partial_file_name):
 
    # list all the files in the directory
    files = os.listdir(directory)
	
    # print files[-5:]
	
    # remove all file names that don't match partial_file_name string
    files = filter(lambda x: x.find(partial_file_name) > -1, files)
 
    # print files
 
    # create a dict that contains list of files and their modification timestamps
    name_n_timestamp = dict([(x, os.stat(directory+x).st_mtime) for x in files])
 
    # return the file with the latest timestamp
    return max(name_n_timestamp, key=lambda k: name_n_timestamp.get(k))

directory = "/home/liuduan/testpages/Grom/"
partial_file_name = "GROM-fore-reg-"

latest_forecast_file_name = find_most_recent(directory, partial_file_name)

latest_CDF = latest_forecast_file_name 

"""
print
filelist = os.listdir("/home/liuduan/testpages/Grom/")
sorted = sort(filelist)[::-1]
print sorted
latest_CDF = sorted[1]					# should be [5]
"""

print "The latest NetCDF file in use is: /home/liuduan/testpages/Grom/" + latest_CDF



#shutil.copy("model-value.txt", "temporary.txt")									# copy file to temporary.txt

#sys.exit()

f_CDF = netCDF4.Dataset("/home/liuduan/testpages/Grom/" + latest_CDF, mode='r')              	# NetCDF file for reading.
#f_CDF = netCDF4.Dataset("25mb-test.nc", mode='r')   
 # open NetCDF file for reading.
print "The file format is: ", f_CDF.file_format
print f_CDF											  # print file info

for dimobj in f_CDF.dimensions.values():			# info for each dimension
    print dimobj

def d(x1, y1, x2, y2):
    distance = ((x1-x2)**2 + (y1-y2)**2)**0.5
    return distance

def interpo(buoy_name, time_ele, lon_buoy, lat_buoy, mod_lon_ele, mod_lat_ele):  
         
    # print buoy_name + ": "	
    model_valid_time = datetime.datetime.fromtimestamp(f_CDF.variables['time'][time_ele] + model_0_seconds)
    # print 'model_valid_time:', time_ele, model_valid_time
    
    # Here specify the lower left conner of the model point only.
    d1 = d(lon_buoy*10, lat_buoy*10, math.floor(lon_buoy*10), math.floor(lat_buoy*10))
    d2 = d(lon_buoy*10, lat_buoy*10, math.floor(lon_buoy*10), math.ceil(lat_buoy*10))
    d3 = d(lon_buoy*10, lat_buoy*10, math.ceil(lon_buoy*10), math.floor(lat_buoy*10))
    d4 = d(lon_buoy*10, lat_buoy*10, math.ceil(lon_buoy*10), math.ceil(lat_buoy*10))

    u1 = f_CDF.variables['water_u'][time_ele, mod_lat_ele, mod_lon_ele]
    u2 = f_CDF.variables['water_u'][time_ele, mod_lat_ele, mod_lon_ele + 1]
    u3 = f_CDF.variables['water_u'][time_ele, mod_lat_ele + 1, mod_lon_ele]
    u4 = f_CDF.variables['water_u'][time_ele, mod_lat_ele + 1, mod_lon_ele + 1]

    u = (u1/d1 + u2/d2 + u3/d3 + u4/d4)/(1/d1 + 1/d2 + 1/d3 + 1/d4)
	
    v1 = f_CDF.variables['water_v'][time_ele, mod_lat_ele, mod_lon_ele]
    v2 = f_CDF.variables['water_v'][time_ele, mod_lat_ele, mod_lon_ele + 1]
    v3 = f_CDF.variables['water_v'][time_ele, mod_lat_ele + 1, mod_lon_ele]
    v4 = f_CDF.variables['water_v'][time_ele, mod_lat_ele + 1, mod_lon_ele + 1]

    v = (v1/d1 + v2/d2 + v3/d3 + v4/d4)/(1/d1 + 1/d2 + 1/d3 + 1/d4)
	
    # print "For the lower left model element numbers (lon lat) are:", mod_lon_ele, mod_lat_ele
    # print 'lon[', mod_lon_ele, '] =', f_CDF.variables['lon'][mod_lon_ele], "      ", 'lon[', mod_lat_ele, '] =', f_CDF.variables['lat'][mod_lat_ele]
    # print buoy_name, "longitude, latitude: ", lon_buoy,  lat_buoy
    print "For " + buoy_name + ", u = ", u    
    # print "Model u1, u2, u3, u4 were: ", u1, u2, u3, u4
    print "For " + buoy_name + ", v = ", v    
    # print "Model v1, v2, v3, v4 were: ", v1, v2, v3, v4		
 
    f_writing.write(buoy_name + ", " + str(model_valid_time))
    f_writing.write(", u = " + str(round(u,3)))
    f_writing.write(", v = " + str(round(v,3)) + '\n')

    # print


shutil.copy("/home/liuduan/testpages/Python/NetCDF/model-value.txt", "/home/liuduan/testpages/Python/NetCDF/temporary.txt")
model_0_seconds = 1067320800.0       # "seconds at 2003-10-28 0:00:00 0:00"
f_writing = open('/home/liuduan/testpages/Python/NetCDF/model-value.txt', 'w')					#open file for writing.



print "The first hour of NetCDF is: ", datetime.datetime.fromtimestamp(f_CDF.variables['time'][0] + model_0_seconds)
print "The last hour of NetCDF is: ", datetime.datetime.fromtimestamp(f_CDF.variables['time'][-1] + model_0_seconds)


# From datetime to epoch seconds
def datetime_to_seconds(date_time):
    target_hour0 = datetime.datetime.strptime(date_time, "%Y-%m-%d %H:%M:%S")
    target_hour0_ep = time.mktime(target_hour0.timetuple())
    return target_hour0_ep
	
def seconds_to_datetime(ep_second):
    ep_second_back_to_datetime = datetime.datetime.fromtimestamp(ep_second)
    return ep_second_back_to_datetime
	
print datetime_to_seconds("2011-10-28 0:00:00")
print seconds_to_datetime(datetime_to_seconds("2011-10-28 0:00:00"))










record_to_keep_time = datetime.datetime.fromtimestamp(f_CDF.variables['time'][0] + model_0_seconds-5*24*3600)
print "record_to_keep_time: ", record_to_keep_time

model_start_time = datetime.datetime.fromtimestamp(f_CDF.variables['time'][0] + model_0_seconds)
print "model_start_time: ", model_start_time

print "str(record_to_keep_time): ", str(record_to_keep_time)
f_tempo = csv.reader(open('/home/liuduan/testpages/Python/NetCDF/temporary.txt', 'r'))			# read temporary.txt, no closing needed.

for row in f_tempo:
    if row[1][1:] > str(record_to_keep_time):
        if row[1][1:] == str(model_start_time):
            break 
        # print "Within if rwo from CVS: ", row
        f_writing.write(row[0] + ',' + row[1] + ',' + row[2] + ',' + row[3] + '\n')				# Write to model_value.txt



# f_tempo = open('temporary.txt', 'r')


    #line1=f_tempo.next() 
    #print "line1", line1
    #line2=f_tempo.next()
    #print "line2", line2




# sys.exit()

# f_CDF = netCDF4.Dataset("/home/liuduan/testpages/Grom/" + latest_CDF, mode='r') 



number_hours = len(f_CDF.dimensions['time'])     





# interpo(buoy_name, time_ele, lon_buoy, lat_buoy, mod_lon_ele, mod_lat_ele)

for n in range(number_hours):	
    interpo("tabs_B_ven", n, -94.9186, 28.9818, mod_lon_ele=30, mod_lat_ele=109)
    interpo("tabs_D_ven", n, -96.8429, 27.9396, 11, 99)
    interpo("tabs_F_ven", n, -94.2366, 28.0825, 37, 100)
    interpo("tabs_J_ven", n, -97.0507, 26.1914, 9, 81)
    interpo("tabs_K_ven", n, -96.4998, 26.2168, 15, 82)
    interpo("tabs_N_ven", n, -94.0367, 27.8903,  mod_lon_ele=39,  mod_lat_ele=98)
    interpo("tabs_R_ven", n, -93.6417, 29.635, 43, 116)
    interpo("tabs_V_ven", n, -93.5973, 27.8966, 44, 98)
    interpo("tabs_W_ven", n, -96.0058, 28.3507, 19, 103)
    interpo("tabs_X_ven", n, -96.3383, 27.066, 16, 90)
	
print "u for buoy N: ", f_CDF.variables['water_u'][2, 39, 98]
f_CDF.close()
f_writing.close()

print "The latest NetCDF file in use is: /home/liuduan/testpages/Grom/" + latest_CDF


