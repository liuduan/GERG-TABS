#!#/usr/bin/python

"""
Python/current_wind-v2.py
This is modified from current_wind.py
The major changes: 
generate image files for some specific days.
1. Start to use NetCDF file in local computer (tabs2.gerg.tamu.edu) instead of ASCII file form remote server. 
# This Python script uses ASCII form data from Steve Baum's ROMS model to generate images for overlay.
"""

import numpy as np
import matplotlib
matplotlib.use('Agg')
import matplotlib.pyplot as plt

import urllib
import csv
import time
import datetime


# get UTC time now to Epoch Seconds.
t = datetime.datetime.utcnow()
Now_UTC_sec = time.mktime(t.timetuple())
print
print "Epoch Seconds:", Now_UTC_sec

# 7 hours ago in UTC.
past7 = datetime.datetime.fromtimestamp(Now_UTC_sec - 3600*7 - 18*3600)
Time_now = datetime.datetime.fromtimestamp(Now_UTC_sec)
print 'past7 UTC: ', past7
print 'Now UTC: ', Time_now

# Round up to the issuing hour, 0, 6, 12, 18.
issue_hour_int = int(int(past7.strftime("%H"))/6)*6
issue_hour_str = "18"  # %02d"%(issue_hour_int)
print 'issue_hour: ', issue_hour_str

# File_name_part2 including y-m-d-issue_hour.
# file_name_part2 = past7.strftime("-%y-%m-%d-") + issue_hour_str
file_name_part2 = "-12-02-28-18"

print 'file_name_part2', file_name_part2

# part1, 3, and 6 of the file name, part4 will be later.
file_name_part1 = "http://csanady.tamu.edu/cgi-bin/nph-dods/TGLO/GNOME/GROM-fore-reg-sfc-72/GROM-fore-reg"
file_name_part3 = "-72.nc.ascii?lon[0:2:60],lat[75:2:120],"
file_name_part6 = "][75:2:120][0:2:60],time[0:1:0]"


# get ep second for targeted hour0
target_hour0 = datetime.datetime.strptime(past7.strftime("%Y-%m-%d ") + issue_hour_str + ":00:00", "%Y-%m-%d %H:%M:%S")
print
print "target_hour0 is: ", target_hour0
target_hour0_ep = time.mktime(target_hour0.timetuple())
print 'target_hour0_ep ', target_hour0_ep 

# Just to verify the seconds are right.
target_hour0_datetime = datetime.datetime.fromtimestamp(target_hour0_ep)
print 'target_hour0_datetime time from ep seconds', target_hour0_datetime
print 'target_hour0_strf of datetime: ', target_hour0_datetime.strftime("%Y_%m_%d_%H")
print

# exit()
# Function Generate_data_array
def Generate_data_array(file_name):

    this_file = urllib.urlopen(file_name, 'rb')
    spamReader = csv.reader(this_file)
    	
    array1 = (np.zeros(768))
    i=0
    line_count = 0

    for row in spamReader:
        if line_count > 2 and line_count < 27:
            for element in row:
                element = element[1:]
                try: 
                    array1[i] = float(element) + 0
                except ValueError:
                    array1[i] = 0
                if str.isalpha(element):
                    array1[i] = 0
                i = i + 1
        line_count = line_count + 1
    # print line_count
    if line_count < 3:    
        print "This file is too short: ", file_name
        exit()       # exit if the file is too small.
    
    array1 = np.reshape(array1, (24,32))
    #print 'array1'
    #print array1

    data_array_UV = array1[1:, 1:]
    #print 'data_U', data_U
    return data_array_UV



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







# Generate mask array
# Mask file name.
mask_file = "http://csanady.tamu.edu/cgi-bin/nph-dods/TGLO/GNOME/GROM-fore-reg-sfc-72/GROM-fore-reg" + file_name_part2 +  "-72.nc.ascii?mask[75:2:120][0:2:60]"
# mask_file = "./mask.txt"
mask_a = Generate_data_array(mask_file)
mask_b = (mask_a - 1)* (-1)
#print mask_b





for hour in range(0, 73):
    file_name_part5 = str(hour) + ":1:" + str(hour) 
    
    # switch water_u and water_v (part4 of the file name)
    for file_name_part4 in ("water_u[", "water_v["):
        # print "file_name_part4 is: ", file_name_part4 
	
        file_name = file_name_part1 + file_name_part2 + file_name_part3 + file_name_part4 + file_name_part5 + file_name_part6
        print 'file name', file_name
		# generate water_u, and water_v
        if file_name_part4 == "water_u[":
            data_U = Generate_data_array(file_name)
        else:
            data_V = Generate_data_array(file_name)			




	# Generate the export file name.
    target_hour_datetime = datetime.datetime.fromtimestamp(target_hour0_ep + hour*3600)
    # print 'target_hour_datetime.strftime()', target_hour_datetime.strftime("%Y_%m_%d_%H.png")
	# exp_file =  "/home/liuduan/testpages/Comparison/forecast_files/" + Time_now.strftime("%d") + "R" + target_hour_datetime.strftime("%y%m%d%H.png")
    exp_file =  "/home/liuduan/testpages/Comparison/forecast_files/" + "28R" + target_hour_datetime.strftime("%y%m%d%H.png")
    print 'export file name: ', exp_file
    print
	
    mask_b[20, 19] = 1
	
    masked_data_U = np.ma.masked_array(data_U, mask=mask_b)     # The mask was put in here.
    masked_data_V = np.ma.masked_array(data_V, mask=mask_b)
	
    #plot figures
    Plot_figures(masked_data_U, masked_data_V, exp_file, label = '50 cm/s', scale_bar = 0.5, color = 'w', scale = 1)

################# The following are for wind plot. ##############################

# get UTC time now to Epoch Seconds.
print "Epoch Seconds:", Now_UTC_sec

# 7 hours ago in UTC.
print 'past7 UTC: ', past7

# Round up to the issuing hour, 0, 6, 12, 18.
print 'issue_hour: ', issue_hour_str

# File_name_part2 including y-m-d-issue_hour.
# file_name_part2 = past7.strftime("-%y-%m-%d-") + issue_hour_str
print 'file_name_part2', file_name_part2

# part1, 3, and 6 of the file name, part4 will be later.
file_name_part1 = "http://csanady.tamu.edu/cgi-bin/nph-dods/TGLO/GNOME/GNAM-fore-reg-72/GNAM-fore-reg"
file_name_part3 = "-72.nc.ascii?"
file_name_part6 = "][75:2:120][0:2:60]"

# get ep second for targeted hour0
print 'target_hour0_ep ', target_hour0_ep 

for hour in range(0, 29):
    file_name_part5 = str(hour) + ":1:" + str(hour) 
    
    # switch air_u and air_v (part4 of the file name)
    for file_name_part4 in ("air_u[", "air_v["):
        # print "file_name_part4 is: ", file_name_part4 
	
        file_name = file_name_part1 + file_name_part2 + file_name_part3 + file_name_part4 + file_name_part5 + file_name_part6
        print 'file name', file_name
		# generate air_u, and air_v
        if file_name_part4 == "air_u[":
            data_U = Generate_data_array(file_name)
        else:
            data_V = Generate_data_array(file_name)			
			
	# Generate the export file name.
    target_hour_datetime = datetime.datetime.fromtimestamp(target_hour0_ep + hour*3600*3)
    # print 'target_hour_datetime.strftime()', target_hour_datetime.strftime("%Y_%m_%d_%H.png")
    # exp_file = "/home/liuduan/testpages/Comparison/forecast_files/" + Time_now.strftime("%d") + "eta_" + target_hour_datetime.strftime("%y%m%d%H.png")
    exp_file = "/home/liuduan/testpages/Comparison/forecast_files/" + "28eta_" + target_hour_datetime.strftime("%y%m%d%H.png")
    print 'export file name: ', exp_file
    print
	
    #plot figures

    Plot_figures(data_U, data_V, exp_file, label = '15 m/s', scale_bar = 15, color = 'r', scale = 30)

#current
#http://csanady.tamu.edu/cgi-bin/nph-dods/TGLO/GNOME/GROM-fore-reg-sfc-72/GROM-fore-reg-11-04-07-06-72.nc.ascii?lon[0:2:60],lat[75:2:120],water_u[0:1:0][75:2:120][0:2:60],time[0:1:0]", 'rb')

#wind
#http://csanady.tamu.edu/cgi-bin/nph-dods/TGLO/GNOME/GNAM-fore-reg-72/GNAM-fore-reg-11-04-14-06-72.nc.ascii?air_u[0:1:0][75:2:120][0:2:60]





