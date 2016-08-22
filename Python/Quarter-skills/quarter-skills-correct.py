#
"""
/Python/Quarter-skills/quarter-skills-correct.py
by LIU Duan

Purpose: 
1. To calculate the model skills for 3 month. 
2. Make the shift, amptitude, and range adjustment, 
3. Recalculate the skills, and hope to improve.

Steps:
1. Determine one buoy at a time.
2. Get 3 months observation data.
3. Do fft to filter the 40 low pass. 
4. Make it a hourly series.
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
    if mean_obs == 0: return 0.0
    for n in range(len(t_model)):
        if t_model[n] < t_model[0]: mmm = m; break
        mmm = len(t_obs)-1
        for m in range(mm, mmm):
            # print "n, m: ", n, m
            if t_model[n] == t_obs[m]:
                skill_top = (obs[n]-model[n])**2 + skill_top
                skill_bottom = (obs[n]- mean_obs)**2 + skill_bottom
                # print skill_bottom
                mm = m
                break
    # print "skill_bottom: ", skill_bottom
    if skill_bottom == 0: return round(0.0, 3)
    total_skill = 1 - skill_top/skill_bottom
    return round(total_skill, 3)




######################### Buoy Selection #############
Buoy_names = ["tabs_B_ven", "tabs_D_ven", "tabs_F_ven", "tabs_J_ven", "tabs_K_ven", "tabs_N_ven", "tabs_R_ven", "tabs_V_ven", "tabs_W_ven"]

buoy_number = 3

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

if Buoy_name == "tabs_B_ven": angle = 55*2*3.1416/360    # along shore angle in degree, cross shore + 90 degree
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


print
print "seconds_to_datetime(t_obs[0]): ", seconds_to_datetime(t_obs[0])
print "seconds_to_datetime(t_obs[-1]): ", seconds_to_datetime(t_obs[-1])

print "seconds_to_datetime(t_series_obs[0])", seconds_to_datetime(t_series_obs[0])
print "seconds_to_datetime(t_series_obs[-1])", seconds_to_datetime(t_series_obs[-1])
print array(t_series_obs).shape, "elements total"

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


################ Change observation to hourly data #########################

t_series_obs = array(t_series_obs)
al_net = array(al_net)

print "t_series_obs.shape:", t_series_obs.shape
print "al_net.shape:", al_net.shape

t_hourly_obs = t_series_obs[::2]

al_hourly_obs = al_net[::2]


t_hourly_obs = array(t_hourly_obs)
al_hourly_obs = array(al_hourly_obs)						######################### observation hourly array

print 
print "t_hourly_obs.shape:", t_hourly_obs.shape
print "al_hourly_obs.shape:", al_hourly_obs.shape

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



#################################### Plot the linear data ####################
pl.subplot(1,3,1)


pl.hist(al_net_model, 50, histtype='bar')
print t_ln_model.shape

pl.xlabel('Along Shore Current m/s')
pl.ylabel('Frequency')
pl.title('Model')

pl.axis([-1.5, 1.5, 0, 350])

message2 = r'$\sigma = $' + str(std(al_net_model))[:5]
message1 = r'$\mu=$' + str(mean(al_net_model))[:7]


pl.text(-1, 275, message2)
pl.text(-1, 250, message1)

pl.grid(True)

pl.subplot(1,3,2)

pl.hist(al_net_model, 50, histtype='bar')
pl.hist(al_hourly_obs, 22, histtype='bar', facecolor='green', alpha = 0.7)
# pl.hist([al_net_model, al_hourly_obs], 50, normed=1, histtype='bar', label=['Model', 'Observation'])
print t_ln_model.shape

pl.xlabel('Along Shore Current m/s')
pl.title('Buoy ' + Buoy_name[5:6] + " Model and Observation")

pl.grid(True)

pl.subplot(1,3,3)

pl.hist(al_hourly_obs, 22, histtype='bar', facecolor='green', alpha = 0.7)
print t_ln_model.shape

pl.xlabel('Along Shore Current m/s')
pl.title('Observation')
pl.axis([-1.5, 1.5, 0, 350])

message1 = r'$\mu=$' + str(mean(al_hourly_obs))[:6]
message2 = r'$\sigma = $' + str(std(al_hourly_obs))[:5]



pl.text(-1, 275, message2)
pl.text(-1, 250, message1)


pl.grid(True)


pl.show() 
exit()



##################################   Calculate the skill values               #########################
##################################   Load the big NetCDF file into an array again  #############


source_CDF = netCDF4.Dataset("Quarter_model_data.nc", mode='r')    
## dimensions: buoys = 9; forecast_files = 368; valid_hours = 73 


t_model = source_CDF.variables['valid_time'][:,:,:] - 3600*12				# why?
u_model = source_CDF.variables['water_u'][:,:,:]
v_model = source_CDF.variables['water_v'][:,:,:]

al_model = zeros((9,368,73))
al_model[buoy_number,:,:] = u_model[buoy_number,:,:] * sin(angle) + v_model[buoy_number,:,:] * cos(angle)
# al_ln_model = u_ln_model * sin(angle) + v_ln_model * cos(angle)


"""
# look at the data.
fig2 = pl.figure(2)
pl.plot(al_net_model, 'b')
pl.plot(al_hourly_obs[30:], 'r')

pl.grid(True)
pl.show() 
exit()
"""


print t_model.shape
print u_model.shape
print v_model.shape


print datetime_to_seconds("2003-10-28 00:00:00")
print seconds_to_datetime(1067299200.0)

print seconds_to_datetime(t_model[0,0,0])
print seconds_to_datetime(t_model[0,367,0])


######################################     Skills for each model forecast    ###################################
al_skills = zeros((9, 368))						
for n in range(144, 368):							# when cut data., default: 22, 367
    # def skill(obs, t_obs, model, t_model)
    # print "n =", n
    al_skills[buoy_number,n] = skill(al_hourly_obs, t_hourly_obs, al_model[buoy_number,n,:], t_model[buoy_number,n,:])

# print al_skills[buoy_number,:]

"""
pl.plot(al_skills[buoy_number,:])
pl.show()
"""

# exit()

#############################################    Calculate and Apply Corrections   #############################
# variables: t_past_obs, al_past_obs, t_past_model, al_past_model

# t_model, al_net_model, 	shape: 368*6 = 2316				# linear model values
# al_hourly_obs, t_hourly_obs							# linear observation values
# find in t_hourly_obs, and 

# skills: 
shift_skill = zeros((9, 368))
range_skill = zeros((9, 368))
ampt_skill = zeros((9, 368))

# Amount of correction: 
A_index_local_offset = zeros((9,368))
Ranges = zeros((9,368))
amptitude = zeros((9,368))

# Improvement counts: 
offset_counts = zeros(9)
offset_improved_counts = zeros(9)
Range_improved_counts = zeros(9)
amplitude_improved_counts = zeros(9)
overall_improved_counts = zeros(9)

past_mean_model = zeros((9,368))
past_mean_obs = zeros((9,368))
past_std_model = zeros((9,368))
past_std_obs = zeros((9,368))

# find the past 5 days for shift
for forecast_file_number in range(22, 368):			# change here if to see just one forecast file, default 22, 368, why not 21 to 368?
    # print seconds_to_datetime(t_model[buoy_number,forecast_file_number,0])
    # print seconds_to_datetime(t_ln_model[0]), seconds_to_datetime(t_ln_model[-1])
    # print seconds_to_datetime(t_hourly_obs[0]), seconds_to_datetime(t_hourly_obs[-1])

    ## generating past 5 days serial for model
    for n in range(len(t_ln_model)):
        if t_model[buoy_number,forecast_file_number,0] == t_net_model[n]:
            t_past_model = t_net_model[n-120: n]
            al_past_model = al_net_model[n-120: n]
            # print "al_past_model"

    for n in range(len(t_hourly_obs)):
        if t_model[buoy_number,forecast_file_number,0] == t_hourly_obs[n]:
            t_past_obs = t_hourly_obs[n-120: n]
            al_past_obs = al_hourly_obs[n-120: n]
            # print "found"

    ############# See one forecast ##########
    """
    pl.figure(3)
    pl.plot(t_past_obs/3600, al_past_obs,'r', linewidth = 3)
    pl.plot(t_hourly_obs/3600, al_hourly_obs, 'r')
    pl.plot(t_past_model/3600, al_past_model,"b")
    pl.plot(t_model[buoy_number,forecast_file_number,:]/3600, al_model[buoy_number,forecast_file_number,:], 'g')
    print  seconds_to_datetime(t_model[buoy_number,forecast_file_number,0]), seconds_to_datetime(t_model[buoy_number,forecast_file_number,-1])
    print t_model[buoy_number,forecast_file_number,:]
    pl.axis([367500, None, None, None])
    pl.grid(True)
    pl.show()
exit()
	#### need to find the observation here.
    # shift_skill[buoy_number, forecast_file_number] = skill(al_hourly_obs, t_hourly_obs, al_shift_model, t_shift_model)
	
    # pl.plot(t_model[buoy_number,forecast_file_number,:], al_model[buoy_number,forecast_file_number,:]
##just to supress the erros
for n in range(0,1):
    """
	
    ############# shift ###########
	
    cross_correlation, A_index_local_offset[buoy_number, forecast_file_number] = cross_correlate.cross_correlate(al_past_model, al_past_obs)
    if A_index_local_offset[buoy_number, forecast_file_number] != 0: offset_counts[buoy_number] = offset_counts[buoy_number] + 1
    # print "A_index_local_offset: ", A_index_local_offset
	
    if A_index_local_offset[buoy_number, forecast_file_number] > 0: 
        t_shift_model = t_model[buoy_number, forecast_file_number, A_index_local_offset[buoy_number, forecast_file_number]:73]
        al_shift_model = al_model[buoy_number, forecast_file_number, :73 - A_index_local_offset[buoy_number, forecast_file_number]]
		
    elif A_index_local_offset[buoy_number, forecast_file_number] < 0: 
        t_shift_model = t_model[buoy_number, forecast_file_number, :73 + A_index_local_offset[buoy_number, forecast_file_number]]
        al_shift_model = al_model[buoy_number, forecast_file_number, (0 - A_index_local_offset[buoy_number, forecast_file_number]):73]
    else: 
        t_shift_model = t_model[buoy_number, forecast_file_number, :]
        al_shift_model = al_model[buoy_number, forecast_file_number, :]            ##
  
    # print t_shift_model.shape, al_shift_model.shape
    if forecast_file_number == round(forecast_file_number/100)*100: print "forecast_file_number:", forecast_file_number
    shift_skill[buoy_number, forecast_file_number] = skill(al_hourly_obs, t_hourly_obs, al_shift_model, t_shift_model)
	
    if shift_skill[buoy_number, forecast_file_number] > al_skills[buoy_number, forecast_file_number]:  
        offset_improved_counts[buoy_number] =offset_improved_counts[buoy_number] + 1
	
    ############# Range ###########
    """
    pl.plot(al_past_obs, 'r')
    pl.plot(al_shift_model, 'g')
    pl.plot(al_past_model, 'b')
    print A_index_local_offset[buoy_number, forecast_file_number]
    pl.grid(True)
    pl.show()
    """
	
    Ranges[buoy_number, forecast_file_number] = std(al_past_obs)/std(al_past_model)
    # print "Ranges", forecast_file_number, Ranges[buoy_number, forecast_file_number]
	
	# This is wrong, but works great.
    al_range_model = (al_shift_model - mean(al_shift_model))*Ranges[buoy_number, forecast_file_number] + mean(al_shift_model)
	
    range_skill[buoy_number, forecast_file_number] = skill(al_hourly_obs, t_hourly_obs, al_range_model, t_shift_model)
    if range_skill[buoy_number, forecast_file_number] > shift_skill[buoy_number, forecast_file_number]:  
        Range_improved_counts[buoy_number] =Range_improved_counts[buoy_number] + 1

    ############# Amptitude ###########
    
    amptitude[buoy_number, forecast_file_number] = mean(al_past_obs) - mean(al_past_model)
    # print "mean(al_past_obs), mean(al_range_model)", mean(al_past_obs), mean(al_range_model)
    """
    pl.plot(al_past_obs, 'r')
    pl.plot(al_range_model, 'g')
    pl.plot(al_past_model, 'b')
    print A_index_local_offset[buoy_number, forecast_file_number]
    pl.grid(True)
    pl.show()	
    """
	
	
	
    # print "amptitude[buoy_number, forecast_file_number]: ",forecast_file_number, amptitude[buoy_number, forecast_file_number]
    al_ampt_model = al_range_model + amptitude[buoy_number, forecast_file_number]
	
    ampt_skill[buoy_number, forecast_file_number] = skill(al_hourly_obs, t_hourly_obs, al_ampt_model, t_shift_model)
    if ampt_skill[buoy_number, forecast_file_number] > range_skill[buoy_number, forecast_file_number]:  
        amplitude_improved_counts[buoy_number] = amplitude_improved_counts[buoy_number] + 1
	
    ########## Mean and std for moving past ###############
    past_mean_model[buoy_number, forecast_file_number] = mean(al_past_model)
    past_mean_obs[buoy_number, forecast_file_number] = mean(al_past_obs)
    past_std_model[buoy_number, forecast_file_number] = std(al_past_model)
    past_std_obs[buoy_number, forecast_file_number] = std(al_past_obs)
    
    if ampt_skill[buoy_number, forecast_file_number] > al_skills[buoy_number, forecast_file_number]:  
        overall_improved_counts[buoy_number] = overall_improved_counts[buoy_number] + 1
	
################ showing Past Mean and std ################3 

"""
fig_mean_std = pl.figure(4)
line_mean_model = pl.plot(past_mean_model[buoy_number, :], 'r')
line_mean_obs = pl.plot(past_mean_obs[buoy_number, :], 'g')
line_std_model = pl.plot(past_std_model[buoy_number, :], 'b')
line_std_obs = pl.plot(past_std_obs[buoy_number, :], 'k')

fig_mean_std.legend((line_mean_model, line_mean_obs, line_std_model, line_std_obs), ('Model Mean', 'Observation Mean', 'Model std', 'Observation std'), 'upper right')


pl.xlabel('1/4 day, forecast file number')
pl.ylabel('m/s')

pl.title('Buoy ' + Buoy_name[5:6] + ", 10-1-2011... 3 months                   .")

pl.grid(True)
pl.show()
exit()
"""

print
print "Before shift:", mean(al_skills[buoy_number,144:])	
# print al_skills[buoy_number,345:367]
# print al_skills[buoy_number,:].shape
print "shifted:", mean(shift_skill[buoy_number, 144:]), 'improved:', offset_improved_counts[buoy_number] , '/', offset_counts[buoy_number] 
# print shift_skill[buoy_number, 345:367]

# print range_skill[buoy_number, :]
print "range_skill: ", mean(range_skill[buoy_number, 144:]), 'improved:', Range_improved_counts[buoy_number] , '/', 368-22
print "ampt_skill: ", mean(ampt_skill[buoy_number, 144:]), 'improved:', amplitude_improved_counts[buoy_number] , '/', 368-22
print "Overall improved:", overall_improved_counts[buoy_number] , '/', 368-22
print


# linear model values: t_net_model, al_net_model, 	shape: 368*6				# linear model values

print seconds_to_datetime(t_net_model[0])
print seconds_to_datetime(t_net_model[368*6-1])
# print t_net_model.shape


# linear obser values: al_hourly_obs, t_hourly_obs	

print seconds_to_datetime(t_hourly_obs[156])
print seconds_to_datetime(t_hourly_obs[156+368*6-1])

print al_hourly_obs[156:(156+368*6-1)].shape
print al_net_model[:368*6-1].shape


"""
# subplot
x = arange(0, 7, 0.01) 
 
pl.subplot(2, 1, 1) 
pl.plot(x, sin(x)) 
 
pl.subplot(2, 2, 3) 
pl.plot(x, cos(x)) 
 
pl.subplot(2, 2, 4) 
pl.plot(x, sin(x)*cos(x)) 
pl.show()
"""


 
x = pl.randn(10000) # some gaussian noise
 
pl.subplot(221) # a subplot
pl.hist(x, 100) # make a histogram
pl.grid(True) # make an axes grid
pl.ylabel('histogram')
# now do the regression...
x = arange(0.0, 2.0, 0.05)
y = 2+ 3*x + 0.2*pl.randn(len(x)) # y is a linear function of x + nse
 
# the bestfit line from polyfit
m,b = polyfit(x,y,1) # a line is 1st order polynomial...
 
# plot the data with blue circles and the best fit with a thick
 # solid black line
pl.subplot(222)
pl.plot(x, y, 'bo', x, m*x+b, '-k', linewidth=2)
pl.ylabel('regression')
pl.grid(True) 

# save the image to hardcopy
# savefig('demo')
pl.show()
 











exit()

fig = pl.figure(1)
line_shift = pl.plot(A_index_local_offset[buoy_number,:]*0.1, 'r')
# print A_index_local_offset[buoy_number,:]*0.1
line_amplitude = pl.plot(amptitude[buoy_number, :], 'b')
line_range = pl.plot(Ranges[buoy_number, :], 'g')
# print Ranges[buoy_number, :]


fig.legend((line_shift, line_amplitude, line_range), ('Shift in x10 hours', 'Amplitude adj. m/s', 'Range adj. m/s'), 'upper right')


pl.xlabel('1/4 day, forecast file number')
pl.ylabel('m/s or x10 hour')

pl.title('Buoy ' + Buoy_name[5:6] + ", 10-1-2011... 3 months                   .")

pl.grid(True)
pl.show()

exit()


