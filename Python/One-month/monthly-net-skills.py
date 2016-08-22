#
"""
#### Program Notes ####
/Python/One-month/monthly-shift.py
1, This program access MySQL database for TABS current data for one month plus 5 days at each end. 
2, Interpolation to make the data points one hour apart. 
3, Nov. 25 to Jan 5.
4, Find the model running status, for Dec 1 to Jan 1.
5, Calculate the skill.

al_obs --- along shore observed current.
al_net --- along shore net current (after 40 hr low pass)
al_model --- along shore model current
al_model_2x --- along shore model current with 2x number of values.

There is a problem that the observation is not always every 30 minutes, and some of the observations were missing.
The missing values need to be interpolated.

t_series_obs --- 30 minute step time series for observation
u_series_obs --- 30 minute step time series for observation
v_series_obs --- 30 minute step time series for observation
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
	
	
# From file name to epoch seconds. format "11-12-04-18"
def name_to_seconds(part_name):
    target_hour0 = datetime.datetime.strptime(part_name, "%y-%m-%d-%H")
    target_hour0_ep = time.mktime(target_hour0.timetuple())
    return target_hour0_ep
	
def seconds_to_name(ep_second):
    seconds_back_to_datetime = datetime.datetime.fromtimestamp(ep_second)
    part_name = seconds_back_to_datetime.strftime("%y-%m-%d-%H")
    return part_name
	

def skill(obs, model):
    # numpy.mean(obs)
    skill_top = 0
    skill_bottom = 0
    mean_obs = np.mean(obs)
    for n in range(len(obs)):
        # print "n, obs[n], model[n]: ", n, obs[n], model[n]
        skill_top = (obs[n]-model[n])**2 + skill_top
        # print "skill_bottom 1: ", skill_bottom
        skill_bottom = (obs[n]- mean_obs)**2 + skill_bottom
        # skill_bottom = (obs[n])**2 + skill_bottom
    total_skill = 1 - skill_top/skill_bottom
    # print "total_skill: ", total_skill
    return round(total_skill, 3)


################ Buoy Selection ######################

# Buoy_name = "tabs_B_ven"
# Buoy_name = "tabs_D_ven"		
# Buoy_name = "tabs_F_ven"		# Buoy F was down at 2011/12
# Buoy_name = "tabs_J_ven"
# Buoy_name = "tabs_K_ven"
# Buoy_name = "tabs_N_ven"
# Buoy_name = "tabs_R_ven"
# Buoy_name = "tabs_V_ven"
Buoy_name = "tabs_W_ven"

print "This is for:", Buoy_name

if Buoy_name == "tabs_B_ven": angle = 55     # along shore angle in degree, cross shore + 90 degree
elif Buoy_name == "tabs_D_ven": angle = 50*2*3.1416/360
elif Buoy_name == "tabs_F_ven": angle = 65*2*3.1416/360
elif Buoy_name == "tabs_J_ven": angle = 0*2*3.1416/360
elif Buoy_name == "tabs_K_ven": angle = 0*2*3.1416/360
elif Buoy_name == "tabs_N_ven": angle = 65*2*3.1416/360
elif Buoy_name == "tabs_R_ven": angle = 55*2*3.1416/360
elif Buoy_name == "tabs_V_ven": angle = 83*2*3.1416/360   # This should not be 83
elif Buoy_name == "tabs_W_ven": angle = 83*2*3.1416/360   # This should not be 83

##################### Open database connection ##################
db = MySQLdb.connect("localhost","tabsweb","tabs","tabsdb" )

# prepare a cursor object using cursor() method
cursor = db.cursor()

#### Set database and lines.
# execute SQL query using execute() method.

#### Important ###
command = "SELECT * FROM " + Buoy_name + " WHERE obs_time> '2011-11-25 00:00:00' ORDER BY obs_time limit 2048"	
cursor.execute(command)					

numrows = int(cursor.rowcount)
u_obs = range(0,numrows)
v_obs = range(0,numrows)
t_obs = range(0,numrows)
t_obs_date = range(0,numrows)

# get and display one row at a time
for i in range(0,numrows):
    row = cursor.fetchone()
    t_obs_date[i] = row[0]
    # print "t_obs_date[i]", i, t_obs_date[i]
    t_obs[i] = datetime_to_seconds(str(t_obs_date[i]))
    u_obs[i] = row[3]/100
    v_obs[i] = row[4]/100
    # noise[i] = sin(2*3.14259/80*i)

# exit()

#### Produce observation arrays that at exactly 30 minute step.

# print "t_obs_date[0]: ", t_obs_date[0]
# print datetime_to_seconds(str(t_obs_date[0]))

t_serries_obs_0 = datetime_to_seconds('2011-11-25 00:00:00')

t_series_obs = range(int(t_serries_obs_0), (int(t_obs[0])+30*60*2047), 30*60)


print "seconds_to_datetime(t_series_obs[288])", seconds_to_datetime(t_series_obs[288])
print "seconds_to_datetime(t_series_obs[1776])", seconds_to_datetime(t_series_obs[1776])
print
# print "seconds_to_datetime(t_series_obs[-1])", seconds_to_datetime(t_series_obs[-1])

print "seconds_to_datetime(t_obs[0]): ", seconds_to_datetime(t_obs[0])
print "seconds_to_datetime(t_obs[-1]): ", seconds_to_datetime(t_obs[-1])
# exit()


# producing u_series_obs and v_series_obs, from u_obs, and v_obs
mm = 0
u_series_obs = np.zeros(2048)
v_series_obs = np.zeros(2048)

for n in range(len(t_series_obs)):
    mmm = len(t_obs)-1
    for m in range(mm, mmm):
        # print "n, m: ", n, m
        if t_series_obs[n] == t_obs[m]: u_series_obs[n] = u_obs[m]; v_series_obs[n] = v_obs[m]; mm = m; break
        elif (t_obs[m]< t_series_obs[n] and t_series_obs[n]< t_obs[m+1]):
            u_series_obs[n]=(u_obs[m]*(t_obs[m+1] - t_series_obs[n]) + u_obs[m+1]*(t_series_obs[n] - t_obs[m]))/(t_obs[m+1]- t_obs[m])
            v_series_obs[n]=(v_obs[m]*(t_obs[m+1] - t_series_obs[n]) + v_obs[m+1]*(t_series_obs[n] - t_obs[m]))/(t_obs[m+1]- t_obs[m])
            mm = m
            break
            # continue

al_obs = u_series_obs * sin(angle) + v_series_obs*cos(angle)

# print "al_obs: ", al_obs
print "size(al_obs): ", size(al_obs)

# u_fft and v_fft are the arrays of fft product 
al_fft = scipy.fft(al_obs) 
# v_fft = scipy.fft(v_obs)

for i in range(0,numrows):
   if i>= 51: 
       al_fft[i] = 0
       # v_fft[i] = 0
al_net = scipy.ifft(al_fft).real
# v_net = scipy.ifft(v_fft)

al_net = 2 * al_net - np.mean(al_net) 
# v_net = 2 * v_net - np.mean(v_net)          ### make up the amptitude.


# print "seconds_to_datetime(t_series_obs[288])", seconds_to_datetime(t_series_obs[288])
# print "t_obs[288]: ", t_obs[288]
# print "seconds_to_datetime(t_series_obs[1776])", seconds_to_datetime(t_series_obs[1776])

# print "al_net: ", al_net

# exit()
########### show data ########
# pylab.plot(sigstat)  # random noise + signal
fig = pl.figure(1)
al_obs = array(al_obs)
t_series_obs = array(t_series_obs)
line_1 = pl.plot((t_series_obs[288:1776]-t_series_obs[288])/(3600*24.0) + 1, al_obs[288:1776], "y-")  

line_2 = pl.plot((t_series_obs[288:1776]-t_series_obs[288])/(3600*24.0) + 1, al_net[288:1776], "b-")




pl.grid(True)

pl.xlabel('December 2011')
pl.ylabel('Velocity, m/s')




"""
pl.show()
exit()
"""




######################################################## The Following Gets the Model Data ####################

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
    if n/10 == n/10.0: print
    print n, 
    NetCDF_file_name = "/home/liuduan/testpages/Grom/GROM-fore-reg-" + seconds_to_name(forecast_file_seconds + 3600*6*n) + "-72.nc"

    if os.path.exists(NetCDF_file_name) == False:
        NetCDF_file_name = "/home/liuduan/testpages/Grom/GROM-fore-reg-" + seconds_to_name(forecast_file_seconds + 3600*6*n) + "-48.nc"
        print "48 hour file is used.", 
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


al_model_2x = u_model_2x * sin(angle) + v_model_2x*cos(angle)


line_3 = pl.plot((t_model_2x-t_obs[288])/(3600*24) + 1, al_model_2x, "r-")    



pl.grid(True)

print "seconds_to_datetime(t_model_2x[0]): ", seconds_to_datetime(t_model_2x[0])
print "seconds_to_datetime(t_model_2x[-1]): ", seconds_to_datetime(t_model_2x[-1])
print "t_series_obs[288:1776]: ", t_series_obs[288:1776]

print "t_model_2x: ", t_model_2x

model_skill = skill(al_net[288:1776], al_model_2x)            ### skill calculation.
# print "model_skill =", model_skill

# print "al_net[288:1776]", al_net[288:1776]

print "al_net[288:1776].shape: ", al_net[288:1776].shape
print "al_model_2x.shape: ", al_model_2x.shape
# np.savetxt('al_net.dat', al_net[288:1776])
# np.savetxt('al_model_2x.dat', al_model_2x)





# exit()



message = 'Skill = ' + str(model_skill)
print message

print 'Calculated in %7.3f seconds' % (time.time()-t_start)


fig.legend((line_1, line_2, line_3), 
    ('Observation', 'Observ. w/ 40 Hr Low Pass', 'Model'), 'upper right')
# pl.suptitle('Buoy J, Along Shore') 

# plt.text(-94.7, 25.25, valid_hour, color='white', size = 8, bbox=dict(facecolor='blue', alpha=0.02))
pl.text(10, 0.5, 'Buoy ' + Buoy_name[5:6] +', Along Shore', horizontalalignment='center', verticalalignment='center', 
    color='blue', size = 18)
pl.text(10, 0.4, message, horizontalalignment='center', verticalalignment='center', color='black', size = 14)
pl.axis([1, 31, None, 0.8])

pl.show()	
exit()




