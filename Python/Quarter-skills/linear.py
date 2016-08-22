#
"""
/Python/Quarter-skills/quarter-skills-correct.py
Purpose: 
1. To calculate the model skills for 3 month. 
2. Make the shift and the amptitude, and range adjustment, 
3. Recalculate the skills, and hope to improve.

Steps:
1. Determine one buoy at a time.
2. Get 3 months observation data.
3. Do fft to filter the 40 low pass. Note how much time needed, the file after fft may need to be saved.
	Try Buoy J first, because no angle need to changes.
4. Make it hourly array.
5. Calculate the skill value of each forecasts.

List for Variables and hinds:

linear model values: t_net_model, al_net_model, 	shape: 368*6				# linear model values
linear obser values: al_hourly_obs, t_hourly_obs							# linear observation values

t_model = source_CDF.variables['valid_time'][:,:,:] - 3600*12			# [9, 368, 73]
u_model = source_CDF.variables['water_u'][:,:,:]
v_model = source_CDF.variables['water_v'][:,:,:]
al_model = zeros((9,368,73))

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

This program was designed to calculate monthly skill of the ROMS model.
There are two ways to calculate the monthly skill,
1) Calculate the skill of each forecast, and the forecasts are issued four times a day. Each forecast predicts the current for next three days, then average for a month.
2) Use the first six hours of prediction from each forecast, and connect the forecast to a month or a year. The skill value of the whole month or whole year can then be calculated.

This program will try the first way.

Give one file NetCDF file get skill value for all the stations.



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

import cross_correlate				# get the "cross_correlate(series_a, series_b)", "return cross_correlation, A_index_offset"
# import Interpolation_1D                            # def interpolation(xi, Obsv, Obs_err, Bkg_err, Max_Bkg_err_va): 
# import model_value								# get the forecast value from a NetCDF file
import linear_222					# linear regression

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
	
# From file name to epoch seconds. format "11-11-04-18"
def name_to_seconds(part_name):
    target_hour0 = datetime.datetime.strptime(part_name, "%y-%m-%d-%H")
    target_hour0_ep = time.mktime(target_hour0.timetuple())
    return target_hour0_ep
	
def seconds_to_name(ep_second):
    seconds_back_to_datetime = datetime.datetime.fromtimestamp(ep_second)
    part_name = seconds_back_to_datetime.strftime("%y-%m-%d-%H")
    return part_name


def skill(obs, t_obs, model, t_model):
    skill_top = 0
    skill_bottom = 0
    mm = 0
    mean_obs = np.mean(obs)
    for n in range(len(t_model)):
        if t_model[n] < t_model[0]: mmm = m; break
        mmm = len(t_obs)-1
        for m in range(mm, mmm):
            # print "n, m: ", n, m
            if t_model[n] == t_obs[m]:
                skill_top = (obs[n]-model[n])**2 + skill_top
                skill_bottom = (obs[n]- mean_obs)**2 + skill_bottom
                mm = m
                break
    # print "skill_bottom: ", skill_bottom
    total_skill = 1 - skill_top/skill_bottom
    return round(total_skill, 3)




######################### Buoy Selection #############
Buoy_names = ["tabs_B_ven", "tabs_D_ven", "tabs_F_ven", "tabs_J_ven", "tabs_K_ven", "tabs_N_ven", "tabs_R_ven", "tabs_V_ven", "tabs_W_ven"]

buoy_number = 1

Buoy_name = Buoy_names[buoy_number]

# use Buoy_names[3] for buoy J.

# Buoy_name = "tabs_B_ven"
# Buoy_name = "tabs_D_ven"		
# Buoy_name = "tabs_F_ven"		# Buoy F was down at 2011/12
# Buoy_name = "tabs_J_ven"
# Buoy_name = "tabs_K_ven"
# Buoy_name = "tabs_N_ven"
# Buoy_name = "tabs_R_ven"
# Buoy_name = "tabs_V_ven"
# Buoy_name = "tabs_W_ven"

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

##################### Open MySQL database connection ######################################################################3
db = MySQLdb.connect("localhost","tabsweb","tabs","tabsdb" )

# prepare a cursor object using cursor() method
cursor = db.cursor()

#### Set database and lines.
# execute SQL query using execute() method.

#### Important ###
command = "SELECT * FROM " + Buoy_name + " WHERE obs_time> '2011-09-24 23:30:00' AND obs_time< '2012-01-04 00:30:00' ORDER BY obs_time"	
# SELECT * FROM tabs_W_ven WHERE obs_time> '2011-11-25 00:00:00' AND obs_time< '2011-11-28 00:00:00'
cursor.execute(command)					

numrows = int(cursor.rowcount)
print "numrows: ", numrows
u_obs = zeros(numrows)
v_obs = zeros(numrows)
t_obs = zeros(numrows)
t_obs_date = range(numrows)
print t_obs.shape, size(t_obs_date)




# get and display one row at a time
for i in range(numrows):
    row = cursor.fetchone()
    t_obs_date[i] = row[0]
    # print "t_obs_date[i]", i, t_obs_date[i]
    t_obs[i] = datetime_to_seconds(str(t_obs_date[i]))
    u_obs[i] = row[3]/100
    v_obs[i] = row[4]/100
    # noise[i] = sin(2*3.14259/80*i)

print "t_obs.shape:", t_obs.shape
# exit()

#### Produce observation arrays that at exactly 30 minute step.

# print "t_obs_date[0]: ", t_obs_date[0]
# print datetime_to_seconds(str(t_obs_date[0]))

t_serries_obs_0 = datetime_to_seconds('2011-09-25 00:00:00')
t_serries_obs_last = datetime_to_seconds('2012-01-04 00:30:00')

t_series_obs = range(int(t_serries_obs_0), int(t_serries_obs_last), 30*60)


print "seconds_to_datetime(t_series_obs[0])", seconds_to_datetime(t_series_obs[0])
print "seconds_to_datetime(t_series_obs[-1])", seconds_to_datetime(t_series_obs[-1])
print array(t_series_obs).shape, "elements total"

print
print "seconds_to_datetime(t_obs[0]): ", seconds_to_datetime(t_obs[0])
print "seconds_to_datetime(t_obs[-1]): ", seconds_to_datetime(t_obs[-1])
# exit()





# producing u_series_obs and v_series_obs, from u_obs, and v_obs at exactly 30 minutes apart
mm = 0
print "len(t_series_obs):", len(t_series_obs)
u_series_obs = np.zeros(4849)
v_series_obs = np.zeros(4849)

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

################# Change Observation to along-shore (al_), and cross shore (cr_) #################3
al_obs = u_series_obs * sin(angle) + v_series_obs*cos(angle)


# print "al_obs: ", al_obs
print "size(al_obs): ", size(al_obs)

################################################## 40 hour low pass filter, after low pass filter al_net ##############
# u_fft and v_fft are the arrays of fft product 
al_fft = scipy.fft(al_obs) 

# v_fft = scipy.fft(v_obs)


for i in range(len(al_obs)):
   if i<= 60: 								### calculate the part to be discarded instead of the part to keep
       al_fft[i] = 0
       # v_fft[i] = 0
al_discard = scipy.ifft(al_fft).real

al_net = al_obs - al_discard
al_net = 2 * al_net - np.mean(al_net) 



########### show data ########

"""
fig = pl.figure(1)
al_obs = array(al_obs)
t_series_obs = array(t_series_obs)
line_1 = pl.plot((t_series_obs-t_series_obs[0]) /(3600*24.0), al_obs, "y-")  

line_2 = pl.plot((t_series_obs-t_series_obs[0])/(3600*24.0), al_net, "b-")


pl.grid(True)

pl.xlabel('days, October - December 2011')
pl.ylabel('Velocity, m/s')

pl.show()
exit()
"""

################ Change observation back to hourly data #########################

t_series_obs = array(t_series_obs)
al_net = array(al_net)

print "t_series_obs.shape:", t_series_obs.shape
print "al_net.shape:", al_net.shape

t_hourly_obs = t_series_obs[::2]

al_hourly_obs = al_net[::2]


t_hourly_obs = array(t_hourly_obs)
al_hourly_obs = array(al_hourly_obs)

print t_hourly_obs.shape
print al_hourly_obs.shape

print "t_hourly_obs[0]: ", seconds_to_datetime(t_hourly_obs[0])
print "t_hourly_obs[-1]: ", seconds_to_datetime(t_hourly_obs[-1])



###############   Load the big NetCDF file ######################

###############   Making the linear model file   #############


source_CDF = netCDF4.Dataset("Quarter_model_data.nc", mode='r')    
## dimensions: buoys = 9; forecast_files = 368; valid_hours = 73 



t_ln_model = zeros(368*6)
u_ln_model = np.zeros(368*6)
v_ln_model = np.zeros(368*6)
for n in range(368):
    t_ln_model[n*6:(n+1)*6] = source_CDF.variables['valid_time'][buoy_number,n,0:6]
    u_ln_model[n*6:(n+1)*6] = source_CDF.variables['water_u'][buoy_number,n,0:6]
    v_ln_model[n*6:(n+1)*6] = source_CDF.variables['water_v'][buoy_number,n,0:6]

al_ln_model = u_ln_model * sin(angle) + v_ln_model * cos(angle)

al_ln_model_fft = scipy.fft(al_ln_model) 

for i in range(len(al_ln_model)):
   if i>= 56: 								### calculate the part to be discarded instead of the part to keep
       al_ln_model_fft[i] = 0
	   
al_net_model = scipy.ifft(al_ln_model_fft).real
al_net_model = 2 * al_net_model - np.mean(al_net_model) 
t_net_model = t_ln_model

source_CDF.close()

"""
print t_ln_model.shape
pl.plot(al_net_model)
pl.plot(al_ln_model)
pl.grid(True)

pl.show() 
exit()
"""

############### Show data in histongram
"""
# check the data
pl.plot(al_hourly_obs)
pl.grid(True)
pl.show()
exit()
"""
n, bins, patches = pl.hist(al_hourly_obs[:], bins=100, normed=False, facecolor='g', alpha=0.75)				# show data in histon gram
message1  = "Observations(green): $\mu=" + str(mean(al_hourly_obs[:]))[:6] + ",\ \sigma=" + str(std(al_hourly_obs[:]))[:6] + "$"
pl.text(-0.7, 6.5, message1)

n2, bins2, patches2 = pl.hist(al_net_model[:], 100, normed=False, facecolor='b', alpha=0.6)			# show histongram
message2  = "Model(blue): $\mu=" + str(mean(al_net_model[:]))[:6] + ",\ \sigma=" + str(std(al_net_model[:]))[:6] + "$"
pl.text(-0.7, 6, message2)



pl.xlabel('Along shore speed, m/s')
pl.ylabel('Point Counts')

pl.grid(True)
pl.title('Buoy ' + Buoy_name[5:6] + ", 3 months: 10-1-2011 - 1-1-2012")


pl.show()
exit()








##################################   Calculate the skill values               #########################
##################################   Load the big NetCDF file into an array   #############


source_CDF = netCDF4.Dataset("Quarter_model_data.nc", mode='r')    
## dimensions: buoys = 9; forecast_files = 368; valid_hours = 73 



t_model = source_CDF.variables['valid_time'][:,:,:] - 3600*12
u_model = source_CDF.variables['water_u'][:,:,:]
v_model = source_CDF.variables['water_v'][:,:,:] 

al_model = zeros((9,368,73))
al_model[buoy_number,:,:] = u_model[buoy_number,:,:] * sin(angle) + v_model[buoy_number,:,:] * cos(angle)
# al_ln_model = u_ln_model * sin(angle) + v_ln_model * cos(angle)

print t_model.shape
print u_model.shape
print v_model.shape


print datetime_to_seconds("2003-10-28 00:00:00")
print seconds_to_datetime(1067299200.0)

print seconds_to_datetime(t_model[0,0,0])
print seconds_to_datetime(t_model[0,367,0])


# print t_hourly_obs.shape
# print al_hourly_obs.shape



al_skills = zeros((9, 368))
print al_skills.shape
for n in range(368):
    # def skill(obs, t_obs, model, t_model)
    # print "n =", n
    al_skills[buoy_number,n] = skill(al_hourly_obs, t_hourly_obs, al_model[buoy_number,n,:], t_model[buoy_number,n,:])

# print al_skills[buoy_number,:]

"""
pl.plot(al_skills[buoy_number,:])
pl.show()
"""

# exit()

print seconds_to_datetime(t_net_model[0])
print seconds_to_datetime(t_net_model[368*6-1])
print t_net_model.shape


# linear obser values: al_hourly_obs, t_hourly_obs	

print seconds_to_datetime(t_hourly_obs[156])
print seconds_to_datetime(t_hourly_obs[156+368*6-1])

print al_hourly_obs[156:(156+368*6-1)].shape
print al_net_model[:368*6-1].shape

# exit()

pl.plot(al_hourly_obs[156:(156+368*6-1)], al_net_model[:368*6-1], 'ro')

pl.xlabel('All observation points, m/s')
pl.ylabel('All model points, m/s')

pl.grid(True)
pl.title('Buoy ' + Buoy_name[5:6] + ", 3 months: 10-1-2011 - 1-1-2012")

Slope, Y_intercection, RR = linear_222.linreg(al_hourly_obs[156:(156+368*6-1)], al_net_model[:368*6-1])

print "linear regression (Slope, Y_intercection, RR):", Slope, Y_intercection, RR

x = array(range(-95, 35.0, 2))/100.0
# print x
y = Slope*x + Y_intercection
pl.plot(x, y)


message = 'Y = ' + str(Slope)[:5] + 'X + ' + str(Y_intercection)[:6]
pl.text(0.1, -1, message, horizontalalignment='center', verticalalignment='center', color='blue', size = 18)

message2 = 'RR = ' + str(RR)[:5]
pl.text(0.1, -1.25, message2, horizontalalignment='center', verticalalignment='center', color='blue', size = 18)

print 'Calculated in %7.3f seconds' % (time.time()-t_start)
pl.show()


exit()

pl.plot(al_skills[buoy_number,:], 'r')
pl.plot(shift_skill[buoy_number, :], 'b')
pl.plot(ampt_skill[buoy_number, :], 'g')
pl.plot(range_skill[buoy_number, :], 'k')
pl.grid(True)
pl.show()

exit()



