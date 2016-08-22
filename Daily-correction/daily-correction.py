#
"""
/Daily-correction/daily-correction.py
Purpose: 
1. Make daily correction for the RAMS model, based on the last 5 days of observation.
2. Make only the time shift and the range adjustment. 

Steps:
1. Get last 6 days of model data.
2. Make a linear model series with first six hours from each forecast file. 
3. Apply FFT 40 hour low pass filter to the linear model series.
4. Get all the buoy location info from the last one.
5. Select buoys with a loop.
6. Get past 6 days of observation data.
3. Make the observation series with exactly 30 minute interval.
4. Use FFT to filter the series with 40 hour low pass filter. 
5. Make it exactly hourly interval to match the model interval.
6. Use past five days to calculate the X-shift of each forecast. Average currents of past five days were compared between model and the observation.
7. Correct the range of the forecasts, and correct with the standard deviations for both observation and model in past five days, and used for amplitude adjustment. 





List for Variables and hints:

linear model values: t_net_model, al_net_model, 	shape: 368*6				# linear model values
linear obser values: al_hourly_obs, t_hourly_obs							# linear observation values

t_model = source_CDF.variables['valid_time'][:,:,:] - 3600*12			# [9, 368, 73]
u_model = source_CDF.variables['water_u'][:,:,:]
v_model = source_CDF.variables['water_v'][:,:,:]
al_model = zeros((9,368,73))


u_series_obs = np.zeros((9, 241))		# exactly 30 minutes for each step
v_series_obs = np.zeros((9, 241))
u_net_obs = np.zeros((9, 241)) 			# After fft
v_net_obs = np.zeros((9, 241))
	

al_ -- along shore.
cr_ -- cross shore
net_ -- after 40 hour low pass.
low_ -- after low pass
past_ -- before the issuing time.
mdl -- model
valid_ -- valid time
shifted_ -- shifted
ampt_ -- after amptitude adjusted
rge_ -- after range adjusted


################         2d Optimal Interpolation         ########################

# For Range, give: u_Ranges,   v_Ranges
#            get:  u_A_Ranges, v_A_Ranges

# For shift, give: u_A_index_local_offset, v_A_index_local_offset, 
#            get:  u_offset_analysis,      v_offset_analysis


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
import os

import cross_correlate				# get the "cross_correlate(series_a, series_b)", "return cross_correlation, A_index_offset"
# import Interpolation_1D                            # def interpolation(xi, Obsv, Obs_err, Bkg_err, Max_Bkg_err_va): 
import opened_model_value								# get the forecast value from a NetCDF file
import OI_2d_function
import NetCDF_correction_fn

t_start = time.time()


###################### Functions ##########################

def datetime_to_seconds(date_time):
    # From datetime to epoch seconds. format "2011-11-04-18 15:00:00"
    time_object = datetime.datetime.strptime(date_time, "%Y-%m-%d %H:%M:%S")
    ep_seconds = netCDF4.date2num(time_object, "seconds since 1970-01-01 00:00:00")
    return ep_seconds
	
def seconds_to_datetime(ep_second):
    ep_second_back_to_datetime = datetime.datetime.utcfromtimestamp(ep_second)              # notice: utcfromtimestamp(ep_second)
    return ep_second_back_to_datetime
	

def name_to_seconds(part_name):
# From file name to epoch seconds. format "11-11-04-18"
    target_hour0 = datetime.datetime.strptime(part_name, "%y-%m-%d-%H")
    target_hour0_ep = netCDF4.date2num(target_hour0, "seconds since 1970-01-01 00:00:00")
    return target_hour0_ep
	
def seconds_to_name(ep_second):
    seconds_back_to_datetime = datetime.datetime.utcfromtimestamp(ep_second)
    part_name = seconds_back_to_datetime.strftime("%y-%m-%d-%H")
    return part_name


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



############ 1. Get last 6 days of model data. ##################

############ Create a linear model array ################
directory = "/home/liuduan/testpages/Grom/"
partial_file_name = "GROM-fore-reg-"

latest_forecast_file_name = find_most_recent(directory, partial_file_name)

# latest_forecast_file_name = "GROM-fore-reg-12-03-28-12-72.nc"
# "GROM-fore-reg-12-02-26-18-48.nc"			#"GROM-fore-reg-12-02-27-00-72.nc"

print latest_forecast_file_name

if os.path.lexists("./Corrected-NetCDF/TABS" + latest_forecast_file_name[-18:-6] + ".nc"):
    print "Exit, TABS" + latest_forecast_file_name[-18:-6] + ".nc, produced previously."
    # exit()

Buoy_names = ["tabs_B_ven", "tabs_D_ven", "tabs_F_ven", "tabs_J_ven", "tabs_K_ven", "tabs_N_ven", "tabs_R_ven", "tabs_V_ven", "tabs_W_ven"]


# def name_to_seconds(part_name):


latest_forecast_file_name = directory + latest_forecast_file_name     #"/home/liuduan/testpages/Grom/GROM-fore-reg-11-11-04-00-72.nc"	

forecast_file_seconds = name_to_seconds(latest_forecast_file_name[-17:-6])

file_number = 20										##################### 24 back files taken #########

forecast_file = range(20)
# u_model									#### just to read out from the NetCDF file
# v_model									#### just to read out from the NetCDF file
al_past = zeros((9,120))				#### 9 buoys, and each has 120 hours
t_past = zeros(120)
model_u_past = zeros((9, 120)) 		# buoy_number, time, u-east, v-north
model_v_past = zeros((9, 120))

for i in range(0, file_number):    
    forecast_file[i] = "/home/liuduan/testpages/Grom/GROM-fore-reg-" + seconds_to_name(forecast_file_seconds + 3600*6*(i-20)) + "-72.nc"
    if os.path.exists(forecast_file[i]) == False: forecast_file[i] = forecast_file[i][:-5] + "48.nc"
	
    print forecast_file[i]       # print all the forecast file names
 
 
    source_CDF = netCDF4.Dataset(forecast_file[i], mode='r')      

    for buoy_number in range(len(Buoy_names)):
        print "hello a."
        t_past[i*6:(i+1)*6], model_u_past[buoy_number, i*6:(i+1)*6], model_v_past[buoy_number, i*6:(i+1)*6] = ( 
             opened_model_value.model_value(source_CDF, Buoy_names[buoy_number], 0, 6))

    source_CDF.close()	

###### Apply model_u_past and model_v_past to fft (40 hour low pass filter) resulting t_net_past, u_net_past, v_net_past ##########


u_fft_past = zeros((9, 120))
v_fft_past = zeros((9, 120))

u_net_past = zeros((9, 120))
v_net_past = zeros((9, 120))

for buoy_number in range(9):
    u_fft_past[buoy_number, :] = scipy.fft(model_u_past[buoy_number,:])  # + sin(array(range(120))*6*3.14/120)) 
    v_fft_past[buoy_number, :] = scipy.fft(model_v_past[buoy_number,:]) 


    for i in range(120):
        if i >= 3: 								
            u_fft_past[buoy_number, i] = 0
            v_fft_past[buoy_number, i] = 0
    u_net_past[buoy_number, :] = scipy.ifft(u_fft_past[buoy_number, :]).real
    v_net_past[buoy_number, :] = scipy.ifft(v_fft_past[buoy_number, :]).real

    u_net_past[buoy_number, :] = 2 * u_net_past[buoy_number, :] - np.mean(u_net_past[buoy_number, :]) 
    v_net_past[buoy_number, :] = 2 * v_net_past[buoy_number, :] - np.mean(v_net_past[buoy_number, :]) 

t_net_past = t_past
#######

"""
print 'Calculated in %7.3f seconds' % (time.time()-t_start)

buoy_number = 5
pl.plot(model_v_past[buoy_number,:])
pl.plot(v_net_past[buoy_number,:])
# pl.plot(sin(array(range(120))*6*3.14/120))
print mean(model_v_past[buoy_number,:]), mean(v_net_past[buoy_number,:])
pl.show()


# def model_value(ff_CDF, Buoy_name, start_point, end_point):
    # return model_t, model_u, model_v

exit()
"""

print "Hello"
##################### Open MySQL database connection ######################################################################3
db = MySQLdb.connect("localhost","tabsweb","tabs","tabsdb" )

# prepare a cursor object using cursor() method
cursor = db.cursor()


# Figure out last 5 days prior to the latest_forecast_file_name.
# latest_forecast_file_name = "GROM-fore-reg-12-02-27-00-72.nc"

# def name_to_seconds(part_name):
# From file name to epoch seconds. format "11-11-04-18"

secds_5days_ago = name_to_seconds(latest_forecast_file_name[-17:-6]) - 5*24*3600

date_5days_ago = seconds_to_name(secds_5days_ago)[:-3] + " " + seconds_to_name(secds_5days_ago)[-2:]
print date_5days_ago

# exit()


t_serries_obs_0 = datetime_to_seconds("20" + date_5days_ago + ":00:00" )
t_serries_obs_last = datetime_to_seconds("20" + latest_forecast_file_name[-17:-9] + " 00:00:00") + 30*60

t_series_obs = range(int(t_serries_obs_0), int(t_serries_obs_last), 30*60)


print
print "seconds_to_datetime(t_series_obs[0])", seconds_to_datetime(t_series_obs[0])
print "seconds_to_datetime(t_series_obs[-1])", seconds_to_datetime(t_series_obs[-1])
print array(t_series_obs).shape, "elements total"

# exit()

u_series_obs = np.zeros((9, 241))
v_series_obs = np.zeros((9, 241))
u_net_obs = np.zeros((9, 241)) 			# After fft
v_net_obs = np.zeros((9, 241))
	

for buoy_number in range(9):
    #### Set database and lines.
    # execute SQL query using execute() method.

    #### Important ###
    # SELECT * FROM tabs_W_ven WHERE obs_time> '2011-11-25 00:00:00' AND obs_time< '2011-11-28 00:00:00'
    command = ("SELECT * FROM " + Buoy_names[buoy_number] + " WHERE obs_time> '20" + date_5days_ago + ":00:00' AND obs_time<= '20" + 
        latest_forecast_file_name[-17:-6] + ":00:00' ORDER BY obs_time")	
    # print command

    cursor.execute(command)					

    numrows = int(cursor.rowcount)
    # print "numrows: ", numrows
    u_obs = zeros(numrows)
    v_obs = zeros(numrows)
    t_obs = zeros(numrows)
    t_obs_date = range(numrows)
    # print t_obs.shape, size(t_obs_date)

    # get and display one row at a time
    for i in range(numrows):
        row = cursor.fetchone()
        t_obs_date[i] = row[0]
        # print "t_obs_date[i]", i, t_obs_date[i]
        t_obs[i] = datetime_to_seconds(str(t_obs_date[i]))
        u_obs[i] = row[3]/100
        v_obs[i] = row[4]/100
        # noise[i] = sin(2*3.14259/80*i)

    #### Produce observation arrays that at exactly 30 minute step.

    # producing u_series_obs and v_series_obs, from u_obs, and v_obs at exactly 30 minutes apart
    mm = 0
    # print "len(t_series_obs):", len(t_series_obs)

    for n in range(len(t_series_obs)):
        mmm = len(t_obs)-1
        for m in range(mm, mmm):
            # print "n, m: ", n, m
            if t_series_obs[n] == t_obs[m]: 
                u_series_obs[buoy_number, n] = u_obs[m] 
                v_series_obs[buoy_number, n] = v_obs[m]
                mm = m; break
            elif (t_obs[m]< t_series_obs[n] and t_series_obs[n]< t_obs[m+1]):
                u_series_obs[buoy_number, n] = ((u_obs[m]*(t_obs[m+1] - t_series_obs[n]) + u_obs[m+1]*(t_series_obs[n] - 
                    t_obs[m]))/(t_obs[m+1]- t_obs[m]))
                v_series_obs[buoy_number, n] = ((v_obs[m]*(t_obs[m+1] - t_series_obs[n]) + v_obs[m+1]*(t_series_obs[n] - 
                    t_obs[m]))/(t_obs[m+1]- t_obs[m]))
                mm = m
                break

    ########################### 40 hour low pass filter, after low pass filter: t_net, u_net, v_net ##############

    u_fft = scipy.fft(u_series_obs[buoy_number, :]) 
    v_fft = scipy.fft(v_series_obs[buoy_number, :]) 

    for i in range(len(t_series_obs)):
        if i > 10: 								### calculate the part to be discarded instead of the part to keep
            u_fft[i] = 0
            v_fft[i] = 0
    u_net_obs[buoy_number, :] = scipy.ifft(u_fft).real
    v_net_obs[buoy_number, :] = scipy.ifft(v_fft).real
	
    u_net_obs[buoy_number, :] = 2 * u_net_obs[buoy_number, :] - np.mean(u_net_obs[buoy_number, :]) 
    v_net_obs[buoy_number, :] = 2 * v_net_obs[buoy_number, :] - np.mean(v_net_obs[buoy_number, :]) 


    ################ Change observation to hourly data #########################

    # al_net = array(al_net)
	

t_series_obs = array(t_series_obs)

t_hourly_obs = t_series_obs[::2]
u_hourly_obs = u_net_obs[:, ::2]
v_hourly_obs = v_net_obs[:, ::2]





t_hourly_obs = array(t_hourly_obs)						######################### observation hourly array

print 
print "t_hourly_obs.shape:", t_hourly_obs.shape
print "u_hourly_obs.shape:", u_hourly_obs.shape

print "t_hourly_obs[0]: ", seconds_to_datetime(t_hourly_obs[0])
print "t_hourly_obs[-1]: ", seconds_to_datetime(t_hourly_obs[-1])

#############################################    Calculate Corrections   #############################
# variables: t_past_obs, al_past_obs, t_past_model, al_past_model

# t_model, al_net_model, 	shape: 368*6 = 2316				# linear model values
# al_hourly_obs, t_hourly_obs							# linear observation values
# find in t_hourly_obs, and 


# Amount of correction: 
u_A_index_local_offset = zeros(9)
v_A_index_local_offset = zeros(9)

u_Ranges = zeros(9)
v_Ranges = zeros(9)
#    amptitude = zeros(9)

past_mean_model = zeros(9)
past_mean_obs = zeros(9)
past_std_model = zeros(9)
past_std_obs = zeros(9)


# find the past 5 days for shift, amplitude, and range
for buoy_number in range(9):		
	
    ############# shift ###########
    cross_correlation, u_A_index_local_offset[buoy_number] = cross_correlate.cross_correlate(u_net_past[buoy_number, :], 
        u_hourly_obs[buoy_number,:])
    cross_correlation, v_A_index_local_offset[buoy_number] = cross_correlate.cross_correlate(v_net_past[buoy_number, :], 
        v_hourly_obs[buoy_number,:])
			
    ############# Range ###########

    u_Ranges[buoy_number] = std(u_hourly_obs[buoy_number])/std(u_net_past[buoy_number])
    v_Ranges[buoy_number] = std(v_hourly_obs[buoy_number])/std(v_net_past[buoy_number])

print
print "u_A_index_local_offset:", u_A_index_local_offset
print "v_A_index_local_offset:", v_A_index_local_offset

print "u_Ranges:", u_Ranges
print "v_Ranges:", v_Ranges


################         2d Optimal Interpolation         ########################


# longitude of buoy locations
yi = [28.9818, 27.9396, 28.8425, 26.194, 26.2168, 27.8903, 29.635, 27.8966, 28.3507]
yi = array(yi)

# latitude of buoy location
xi = [-94.9186, -96.8429, -94.2416, -97.0507, -96.4998, -94.0367, -93.6417, -93.5973, -96.0058]
xi = array(xi)


# For Range, give: 	u_Ranges,   	  v_Ranges
#					u_Ranges_log10,   v_Ranges_log10
#					u_A_Ranges_log10, v_A_Ranges_log10
#            get:  	u_A_Ranges,       v_A_Ranges

# change u_Ranges, v_Ranges to log10 Range first.
u_Ranges_log10 = log10(u_Ranges)
v_Ranges_log10 = log10(v_Ranges)

u_A_Ranges_log10 = OI_2d_function.OI_2d_function(xi, yi, u_Ranges_log10)		# return analysis matrix
v_A_Ranges_log10 = OI_2d_function.OI_2d_function(xi, yi, v_Ranges_log10)		# return analysis matrix

u_A_Ranges = 10**u_A_Ranges_log10     
v_A_Ranges = 10**v_A_Ranges_log10    

# For shift, give: u_A_index_local_offset, v_A_index_local_offset, 
#            get:  u_offset_analysis,      v_offset_analysis

u_offset_analysis = np.round(OI_2d_function.OI_2d_function(xi, yi, u_A_index_local_offset))		# return analysis matrix
print "u_offset_analysis.shape in daily-correction.py:", u_offset_analysis.shape
v_offset_analysis = np.round(OI_2d_function.OI_2d_function(xi, yi, v_A_index_local_offset))		# return analysis matrix


############################### NetCDF_correction #######################
directory = "/home/liuduan/testpages/Grom/"

# latest_forecast_file_name = "GROM-fore-reg-12-02-26-06-72.nc"
latest_forecast_file_name = latest_forecast_file_name     #"/home/liuduan/testpages/Grom/GROM-fore-reg-11-11-04-00-72.nc"	

source_file = latest_forecast_file_name

# print "source_file:", source_file

target_file_name = "TABS-" + source_file[-17:-6] + ".nc"

print "target_file_name:", target_file_name

target_file = "/home/liuduan/testpages/Daily-correction/Corrected-NetCDF/" + target_file_name

NetCDF_correction_fn.NetCDF_correction_fn(source_file, target_file, u_offset_analysis, v_offset_analysis, u_A_Ranges, v_A_Ranges)


print 'Calculated in %7.3f seconds' % (time.time()-t_start)


exit()



