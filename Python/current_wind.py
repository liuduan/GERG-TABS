#!#/usr/bin/python

# This Python script uses model data from Steve Baum's ROMS model to generate images for overlay.
# The model data are in NetCDF format

from numpy import *
import numpy as np
import matplotlib
matplotlib.use('Agg')			# With this line, figures can be saved without display.
import matplotlib.pyplot as plt


import urllib
import csv
import time
import datetime
import os
import netCDF4


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


def name_to_seconds(part_name):														# may not need.
# From file name to epoch seconds. format "11-11-04-18"
    target_hour0 = datetime.datetime.strptime(part_name, "%y-%m-%d-%H")
    target_hour0_ep = netCDF4.date2num(target_hour0, "seconds since 1970-01-01 00:00:00")
    return target_hour0_ep
	
def seconds_to_name(ep_second):
    seconds_back_to_datetime = datetime.datetime.utcfromtimestamp(ep_second)
    part_name = seconds_back_to_datetime.strftime("%y-%m-%d-%H")
    return part_name


    # Function Plot_figures
def Plot_figures(data_U, data_V, exp_file, label, scale_bar, color, scale):
    axis_x = np.arange(-98, -91.9, 0.2)
    axis_y = np.arange(25.5, 30, 0.2)
    #axis_y = axis_y/10.
    #print 'axis_x, ', axis_x
    #print 'axis_y, ', axis_y

    X,Y = np.meshgrid(axis_x, axis_y) # X, Y are both arrays.
    #print 'X', X
    #print 'Y', Y


    plt.figure()
    ax = plt.axes()
    ax.set_frame_on(False)
    ax.set_xticks([])
    ax.set_yticks([])
    plt.axis([-98, -91.9, 25.5, 30])
    Q = plt.quiver(X, Y, data_U, data_V, color=color, units='inches', scale= scale)

    #plt.title(exp_file)
    valid_hour = 'Model Valid For ' + exp_file[-6:-4] + ':00 UTC.'
    plt.text(-94.7, 25.25, valid_hour, 
        color='white', 
        size = 8,
        bbox=dict(facecolor='red', alpha=0.02))
    qk = plt.quiverkey(Q, 0.92, -0.08, scale_bar, label, labelpos='N',
               fontproperties={'size': 10, 'weight':'bold'})

    plt.savefig(exp_file, dpi=None, facecolor='w', edgecolor='w', orientation='portrait', papertype=None, format="png", transparent=True, bbox_inches=None, pad_inches=0.1)

    # plt.show()
#end of the function Plot_figures.

	

# get UTC time now to Epoch Seconds.
t = datetime.datetime.utcnow()
Now_UTC_sec = time.mktime(t.timetuple())
print
print "Epoch Seconds now:", Now_UTC_sec





############ 1. Find the latest forcast file. ##################

############ Create a linear model array ################
directory = "/home/liuduan/testpages/Grom/"
partial_file_name = "GROM-fore-reg-"

latest_forecast_file_name = find_most_recent(directory, partial_file_name)

# latest_forecast_file_name = "GROM-fore-reg-12-03-28-12-72.nc"
# "GROM-fore-reg-12-02-26-18-48.nc"			#"GROM-fore-reg-12-02-27-00-72.nc"

print latest_forecast_file_name

latest_forecast_file_name = directory + latest_forecast_file_name     #"/home/liuduan/testpages/Grom/GROM-fore-reg-11-11-04-00-72.nc"	

print 'latest_forecast_file_name: ', latest_forecast_file_name


source_CDF = netCDF4.Dataset(latest_forecast_file_name, mode='r')      

model_0_seconds = 1067320800.0 - 3600      # "seconds at 2003-10-28 0:00:00 0:00 "

number_hours = len(source_CDF.dimensions['time'])      

print "number_hours:", number_hours

model_start_time = datetime.datetime.fromtimestamp(source_CDF.variables['time'][0] + model_0_seconds)
print "model_start_time:", model_start_time 

model_valid_time = datetime.datetime.fromtimestamp(source_CDF.variables['time'][72] + model_0_seconds)
print "model_valid_time:", model_valid_time 


# get ep second for targeted hour0
print

target_hour0_ep = source_CDF.variables['time'][0] + model_0_seconds

print 'target_hour0_ep ', target_hour0_ep

Time_now = datetime.datetime.fromtimestamp(Now_UTC_sec)

print 'longitude:', source_CDF.variables['lon'][0:61]
print 'latitude:', source_CDF.variables['lat'][75:120]

# u1 = source_CDF.variables['water_u'][time_ele, mod_lat_ele, mod_lon_ele]
u1 = source_CDF.variables['water_u'][1, 75:120:2, 0:61:2]
v1 = source_CDF.variables['water_v'][1, 75:120:2, 0:61:2]

print 'shape(u1):', shape(u1)



# def Plot_figures(data_U, data_V, exp_file, label, scale_bar, color, scale):

mask_a = source_CDF.variables['mask'][75:120:2, 0:61:2]
mask_b = (mask_a - 1)* (-1)

print 'mask_b:', mask_b[1, :]

print 'shape(mask_b):', shape(mask_b)





for hour in range(0, 73):

    print 'latest_forecast_file_name: ', latest_forecast_file_name
		
    data_U = source_CDF.variables['water_u'][hour, 75:120:2, 0:61:2]
    data_V = source_CDF.variables['water_v'][hour, 75:120:2, 0:61:2]

	# Generate the export file name.
    target_hour_datetime = datetime.datetime.fromtimestamp(target_hour0_ep + hour*3600)
    # print 'target_hour_datetime.strftime()', target_hour_datetime.strftime("%Y_%m_%d_%H.png")
    exp_file =  "/home/liuduan/testpages/Comparison/forecast_files/" + Time_now.strftime("%d") + "R" + target_hour_datetime.strftime("%y%m%d%H.png")
    print 'export file name: ', exp_file
    print
	
    mask_b[22, 19] = 1
    mask_b[17, 13] = 1
	
    masked_data_U = np.ma.masked_array(data_U, mask=mask_b)     # The mask was put in here.
    masked_data_V = np.ma.masked_array(data_V, mask=mask_b)
    # masked_data_U = data_U
    # masked_data_V = data_V
	
    #plot figures
    Plot_figures(masked_data_U, masked_data_V, exp_file, label = '50 cm/s', scale_bar = 0.5, color = 'w', scale = 1)
	
source_CDF.close()	








# The following are for wind plot.


############ 1. Find the latest forcast file. ##################

############ Create a linear model array ################
directory = "/home/liuduan/testpages/Grom/Wind/"
partial_file_name = "GNAM-fore-reg-"

latest_forecast_file_name = find_most_recent(directory, partial_file_name)

# latest_forecast_file_name = "GROM-fore-reg-12-03-28-12-72.nc"
# "GROM-fore-reg-12-02-26-18-48.nc"			#"GNAM-fore-reg-12-02-27-00-72.nc"

print latest_forecast_file_name

latest_forecast_file_name = directory + latest_forecast_file_name     #"/home/liuduan/testpages/Grom/Wind/GNAM-fore-reg-11-11-04-00-72.nc"	

print latest_forecast_file_name
forecast_file_seconds = name_to_seconds(latest_forecast_file_name[-17:-6])



source_CDF = netCDF4.Dataset(latest_forecast_file_name, mode='r')      

number_hours = len(source_CDF.dimensions['time'])      

print "number_hours:", number_hours

model_start_time = datetime.datetime.fromtimestamp(source_CDF.variables['time'][0] + model_0_seconds)
print "model_start_time:", model_start_time 

model_valid_time = datetime.datetime.fromtimestamp(source_CDF.variables['time'][28] + model_0_seconds)
print "model_valid_time:", model_valid_time 


print 'longitude', source_CDF.variables['lon'][0:61]
print 'latitude', source_CDF.variables['lat'][75:120]

# u1 = source_CDF.variables['air_u'][time_ele, mod_lat_ele, mod_lon_ele]
u1 = source_CDF.variables['air_u'][1, 75:120:2, 0:61:2]
v1 = source_CDF.variables['air_v'][1, 75:120:2, 0:61:2]

print 'shape(u1):', shape(u1)



# get UTC time now to Epoch Seconds.
print "Epoch Seconds:", Now_UTC_sec


# get ep second for targeted hour0
print 'target_hour0_ep ', target_hour0_ep 

for hour in range(0, 29):
    
    print 'latest_forecast_file_name: ', latest_forecast_file_name
		
    data_U = source_CDF.variables['air_u'][hour, 75:120:2, 0:61:2]
    data_V = source_CDF.variables['air_v'][hour, 75:120:2, 0:61:2]
	
			
	# Generate the export file name.
    target_hour_datetime = datetime.datetime.fromtimestamp(target_hour0_ep + hour*3600*3)
    # print 'target_hour_datetime.strftime()', target_hour_datetime.strftime("%Y_%m_%d_%H.png")
    exp_file = "/home/liuduan/testpages/Comparison/forecast_files/" + Time_now.strftime("%d") + "eta_" + target_hour_datetime.strftime("%y%m%d%H.png")
    print 'export file name: ', exp_file
    print
	

    #plot figures

    Plot_figures(data_U, data_V, exp_file, label = '15 m/s', scale_bar = 15, color = 'r', scale = 30)



