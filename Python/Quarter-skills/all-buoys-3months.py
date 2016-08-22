#
"""
/Python/Quarter-skills/quarter-skills-correct.py
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

for buoy_number in 0, 2, 3, 4, 5, 6, 8:
    # print Buoy_names[buoy_number]

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

    t_serries_obs_0 = datetime_to_seconds('2011-09-25 00:00:00')
    t_serries_obs_last = datetime_to_seconds('2012-01-04 00:30:00')

    t_series_obs = range(int(t_serries_obs_0), int(t_serries_obs_last), 30*60)

# producing u_series_obs and v_series_obs, from u_obs, and v_obs at exactly 30 minutes apart
    mm = 0
# print "len(t_series_obs):", len(t_series_obs)
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
         
################# Change Observation to along-shore (al_), and cross shore (cr_) #################3
    al_obs = u_series_obs * sin(angle) + v_series_obs*cos(angle)

################################################## 40 hour low pass filter, after low pass filter al_net ##############
# u_fft and v_fft are the arrays of fft product 
    al_fft = scipy.fft(al_obs) 

    for i in range(len(al_obs)):
        if i<= 120: 				# should be 120 for 40hr low pass
						### calculate the part to be discarded instead of the part to keep
            al_fft[i] = 0

    al_discard = scipy.ifft(al_fft).real

    al_net = al_obs - al_discard
    al_net = 2 * al_net - np.mean(al_net) 


################ Change observation to hourly data #########################

    t_series_obs = array(t_series_obs)
    al_net = array(al_net)

    t_hourly_obs = t_series_obs[::2]

    al_hourly_obs = al_net[::2]


    t_hourly_obs = array(t_hourly_obs)
    al_hourly_obs = array(al_hourly_obs)						######################### observation hourly array

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
       if i>= 56: 								### should be 56 for 40 hr low pass, calculate the part to be discarded instead of the part to keep
           al_ln_model_fft[i] = 0
	   
    al_net_model = scipy.ifft(al_ln_model_fft).real
    al_net_model = 2 * al_net_model - np.mean(al_net_model) 
    t_net_model = t_ln_model

    source_CDF.close()


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


######################################     Skills for each model forecast    ###################################
    al_skills = zeros((9, 368))						
    for n in range(22, 368):							# when cut data., default: 22, 367
        al_skills[buoy_number,n] = skill(al_hourly_obs, t_hourly_obs, al_model[buoy_number,n,:], t_model[buoy_number,n,:])


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

# find the past 5 days for shift, amplitude, and range
    for forecast_file_number in range(22, 368):			# change here if to see just one forecast file, default 22, 368, why not 21 to 368?

    ## generating past 5 days serial for model
        for n in range(len(t_ln_model)):
            if t_model[buoy_number,forecast_file_number,0] == t_net_model[n]:
                t_past_model = t_net_model[n-120: n]
                al_past_model = al_net_model[n-120: n]

        for n in range(len(t_hourly_obs)):
            if t_model[buoy_number,forecast_file_number,0] == t_hourly_obs[n]:
                t_past_obs = t_hourly_obs[n-120: n]
                al_past_obs = al_hourly_obs[n-120: n]


        ############# Amptitude Only###########
    
        amptitude[buoy_number, forecast_file_number] = mean(al_past_obs[24:]) - mean(al_past_model[24:])	
	
        al_ampt_model = al_model[buoy_number, forecast_file_number, :] + amptitude[buoy_number, forecast_file_number]
	
        ampt_skill[buoy_number, forecast_file_number] = (skill(al_hourly_obs, t_hourly_obs, al_ampt_model, 
            t_model[buoy_number, forecast_file_number, :]))
			
        if ampt_skill[buoy_number, forecast_file_number] > al_skills[buoy_number, forecast_file_number]:  
            amplitude_improved_counts[buoy_number] = amplitude_improved_counts[buoy_number] + 1







        """	
        ############# shift ###########
	
        cross_correlation, A_index_local_offset[buoy_number, forecast_file_number] = cross_correlate.cross_correlate(al_past_model, al_past_obs)
        if A_index_local_offset[buoy_number, forecast_file_number] != 0: offset_counts[buoy_number] = offset_counts[buoy_number] + 1
	
        if A_index_local_offset[buoy_number, forecast_file_number] > 0: 
            t_shift_model = t_model[buoy_number, forecast_file_number, A_index_local_offset[buoy_number, forecast_file_number]:73]
            al_shift_model = al_model[buoy_number, forecast_file_number, :73 - A_index_local_offset[buoy_number, forecast_file_number]]
		
        elif A_index_local_offset[buoy_number, forecast_file_number] < 0: 
            t_shift_model = t_model[buoy_number, forecast_file_number, :73 + A_index_local_offset[buoy_number, forecast_file_number]]
            al_shift_model = al_model[buoy_number, forecast_file_number, (0 - A_index_local_offset[buoy_number, forecast_file_number]):73]
        else: 
            t_shift_model = t_model[buoy_number, forecast_file_number, :]
            al_shift_model = al_model[buoy_number, forecast_file_number, :]            ##

        shift_skill[buoy_number, forecast_file_number] = skill(al_hourly_obs, t_hourly_obs, al_shift_model, t_shift_model)
	
        if shift_skill[buoy_number, forecast_file_number] > al_skills[buoy_number, forecast_file_number]:  
            offset_improved_counts[buoy_number] =offset_improved_counts[buoy_number] + 1

	
        ############# Range ###########

        Ranges[buoy_number, forecast_file_number] = std(al_past_obs)/std(al_past_model)

        al_range_model = (al_shift_model - mean(al_shift_model))*Ranges[buoy_number, forecast_file_number] + mean(al_shift_model)
	
        range_skill[buoy_number, forecast_file_number] = skill(al_hourly_obs, t_hourly_obs, al_range_model, t_shift_model)
        if range_skill[buoy_number, forecast_file_number] > shift_skill[buoy_number, forecast_file_number]:  
            Range_improved_counts[buoy_number] =Range_improved_counts[buoy_number] + 1


        ############# Amptitude ###########
    
        amptitude[buoy_number, forecast_file_number] = mean(al_past_obs) - mean(al_past_model)	
	
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
        """

    # print
    print "Before shift:", mean(al_skills[buoy_number,22:])	
    #print "shifted:", mean(shift_skill[buoy_number, 22:]), ', improved:', offset_improved_counts[buoy_number] , '/', offset_counts[buoy_number] 

    # print "range_skill: ", mean(range_skill[buoy_number, 22:]), ', improved:', Range_improved_counts[buoy_number] , '/', 368-22
    print "ampt_skill: ", mean(ampt_skill[buoy_number, 22:]), ', improved:', amplitude_improved_counts[buoy_number] , '/', 368-22
    # print "Overall improved:", overall_improved_counts[buoy_number] , '/', 368-22
    print



exit()


