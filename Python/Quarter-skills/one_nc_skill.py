#
"""
#### Program Notes ####
/Python/Annual-skills/skill-1-nc-file.py
The purpose of this file is to calculate the skill of one NetCDF file, and the skills should be for all the station.
Therefore, buy resue this file the skills of whole month or whole year can be calculated.

This program access MySQL database for TABS current data, and use optimal interpolation to filter the noise. 
Then it find the bias, and make the correction. 
This program was further improved from fit-correct, and now previous NetCDF files can be included for the correction. 


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

import Interpolation_1D                            # def interpolation(xi, Obsv, Obs_err, Bkg_err, Max_Bkg_err_va): 
import model_value								# get the forecast value from a NetCDF file


t_start = time.time()



"""
# The one_nc_skill.py should return skill an array, it has 34 elements, 
# 0, first time point in seconds
1, 2, 3, 4: before_B_u, after_B_u, before_B_v, after_B_v
5, 6, 7, 8: Buoy F
9, 10, 11, 12: J
K: 13-16
N: 17-20
R: 21-14
V: 25-28
W: 29-32
33: total hours
"""



###################### Functions ##########################

# From datetime to epoch seconds
def datetime_to_seconds(date_time):
    target_hour0 = datetime.datetime.strptime(date_time, "%Y-%m-%d %H:%M:%S")
    target_hour0_ep = time.mktime(target_hour0.timetuple())
    return target_hour0_ep
	
def seconds_to_datetime(ep_second):
    ep_second_back_to_datetime = datetime.datetime.fromtimestamp(ep_second)
    return ep_second_back_to_datetime
	
def skill(obs, model):
    skill_top = 0
    skill_bottom = 0
    for n in range(len(obs)):
        skill_top = (obs[n]-model[n])**2 + skill_top
        skill_bottom = obs[n]**2 + skill_bottom
    # print "skill_top: ", skill_top
    # print "skill_borrom: ", skill_bottom
    total_skill = 1 - skill_top/skill_bottom
    # print "total_skill: ", total_skill
    return round(total_skill, 3)


# From file name to epoch seconds. format "11-11-04-18"
def name_to_seconds(part_name):
    target_hour0 = datetime.datetime.strptime(part_name, "%y-%m-%d-%H")
    target_hour0_ep = time.mktime(target_hour0.timetuple())
    return target_hour0_ep
	
def seconds_to_name(ep_second):
    seconds_back_to_datetime = datetime.datetime.fromtimestamp(ep_second)
    part_name = seconds_back_to_datetime.strftime("%y-%m-%d-%H")
    return part_name


def Bias(model_t2, model_u2, model_v2):
    global total_n_Analy, x, Analysis_u, Analysis_v, match_analy_u2, match_analy_v2
    mm2 = 0
    match_analy_u2 = range(0, 6)
    match_analy_v2 = range(0, 6)
    for n2 in range(0, 6):
        for m2 in range(mm2, total_n_Analy):
            if (x[m2] <= model_t2[n2] and model_t2[n2]< x[m2+1]):
			
                match_analy_u2[n2]=(Analysis_u[m2]*(x[m2+1] - model_t2[n2]) + Analysis_u[m2+1]*(model_t2[n2] - x[m2]))/(x[m2+1]-x[m2])
                match_analy_v2[n2]=(Analysis_v[m2]*(x[m2+1] - model_t2[n2]) + Analysis_v[m2+1]*(model_t2[n2] - x[m2]))/(x[m2+1]-x[m2])
                mm2 = m2
    bias_u = np.average(match_analy_u2) - np.average(model_u2[:6]) 
    bias_v = np.average(match_analy_v2) - np.average(model_v2[:6]) 
    return round(bias_u, 4), round(bias_v, 4)               				

##### This is the main function
def One_buoy_skill(NetCDF_file_name, Buoy_name):
    global total_n_Analy, x, Analysis_u, Analysis_v, match_analy_u2, match_analy_v2
	
    ##################### Open database connection ##################
    # db = MySQLdb.connect("localhost","testuser","test123","TESTDB" )
    db = MySQLdb.connect("localhost","tabsweb","tabs","tabsdb" )

    # prepare a cursor object using cursor() method
    cursor = db.cursor()

    #### Set database and lines.
    # execute SQL query using execute() method.
    command = "SELECT * FROM " + Buoy_name + " WHERE obs_time<'2011-11-08 12:00:00' ORDER BY obs_time DESC limit 450"	#### Important ###
    cursor.execute(command)					

    numrows = int(cursor.rowcount)
    u_obs = range(0,numrows)
    v_obs = range(0,numrows)
    t_obs = range(0,numrows)
    # get and display one row at a time
    for i in range(0,numrows):
        row = cursor.fetchone()
        t_obs[numrows-i-1] = datetime_to_seconds(str(row[0]))
        # print "t_obs[numrows-i-1]: ", t_obs[numrows-i-1]
        u_obs[numrows-i-1] = row[3]/100
        v_obs[numrows-i-1] = row[4]/100

    # disconnect from server
    db.close()

    ############################# Optimal Interpolation #########################
    # Prepare for optimal interpolation.
    xi = array(t_obs)
    Obsv = array(u_obs)
    Obs_err = 0.03			# This is related to y, need to be 1/10 of y.
    Bkg_err = 50000		# Foe bending.
    Max_Bkg_err_va = 500

    # def interpolation(xi, Obsv, Obs_err, Bkg_err, Max_Bkg_err_va): 
    x, Analysis_u, Ea_u = Interpolation_1D.interpolation(xi, Obsv, Obs_err, Bkg_err, Max_Bkg_err_va)

    # Get the Analysis_v
    Obsv = array(v_obs)
    x, Analysis_v, Ea_v = Interpolation_1D.interpolation(xi, Obsv, Obs_err, Bkg_err, Max_Bkg_err_va)


    ########################### Prepare for getting forecast data from a NetCDF file #################
    # def model_value(NetCDF_file_name, Buoy_name, start_point, end_point):

    # NetCDF_file_name = "/home/liuduan/testpages/Grom/GROM-fore-reg-11-11-05-00-72.nc"			#### NetCDF file name from the begining.
    start_point = 0
    end_point = 0

    model_t, model_u, model_v = model_value.model_value(NetCDF_file_name, Buoy_name, start_point, end_point)    ## critical!

    f_CDF = netCDF4.Dataset(NetCDF_file_name, mode='r')              	# NetCDF file for reading.

    hours = len(f_CDF.dimensions['time'])
    f_CDF.close()

    ############ Correction ################

    #### Produce match_analy_u and match_analy_v to match the model elements.
    # print "model_t: ", model_t 
    # print "x: ", x					# For Analysis

    total_n_Analy = len(x)
    mm = 0
    match_analy_u = range(0, hours)			
    match_analy_v = range(0, hours)			

    for n in range(0, hours):                      
        for m in range(mm, total_n_Analy):
            if (x[m] <= model_t[n] and model_t[n]< x[m+1]):
                # print "n of model, m of Analysis: ", n, m
                match_analy_u[n]=(Analysis_u[m]*(x[m+1] - model_t[n]) + Analysis_u[m+1]*(model_t[n] - x[m]))/(x[m+1]-x[m])
                match_analy_v[n]=(Analysis_v[m]*(x[m+1] - model_t[n]) + Analysis_v[m+1]*(model_t[n] - x[m]))/(x[m+1]-x[m])
                mm = m
    #           print "match_analy_v[n], Analysis_v[m], Analysis_v[m+1]: ", match_analy_v[n], Analysis_v[m], Analysis_v[m+1]

    # print "match_analy_u ", match_analy_u






    # seconds = name_to_seconds("11-11-04-18")					## change here
    # print "seconds_to_name(seconds): ", seconds_to_name(seconds), "########"



    # print "NetCDF_file_name[-17:-6]  = ", NetCDF_file_name[-17:-6]
    # "/home/norman/grom/GROM-fore-reg-11-11-05-00-72.nc"	
    forecast_file_seconds = name_to_seconds(NetCDF_file_name[-17:-6])

    back_file = 16												##################### back_file number
    NetCDF_file_past = range(0, back_file+1)
    increment_u = 0
    increment_v = 0
    model_t_past = array(range(0, 73)) 			## change here
    model_u_past = range(0, 73)					## change here
    model_v_past = range(0, 73)					## change here
    for i in range(1, back_file+1):    
	    #print "i: ", i
        NetCDF_file_past[i] = "/home/liuduan/testpages/Grom/GROM-fore-reg-" + seconds_to_name(forecast_file_seconds - 3600*6*i) + "-72.nc"
        print NetCDF_file_past[i] 

        try:
            f_CDF2 = netCDF4.Dataset(NetCDF_file_past[i], mode='r')              	# NetCDF file for reading.
            # print "Do this, if the file exist."
            f_CDF2.close()
            # print "model_t_past, model_u_past, model_v_past: ", model_t_past, model_u_past, model_v_past
            model_t_past, model_u_past, model_v_past = model_value.model_value(NetCDF_file_past[i], Buoy_name, start_point, end_point)
  
            bias_u_past, bias_v_past = Bias(model_t_past, model_u_past, model_v_past)
            # print "bias_u_past, bias_v_past: ", bias_u_past, bias_v_past


            increment_u = increment_u + bias_u_past
            increment_v = increment_v + bias_v_past
        except (RuntimeError):
            print "RuntimeError, and the file does not exist"
            print "Go next file here."
            back_file = back_file -1
	

    increment_u = increment_u/back_file
    increment_v = increment_v/back_file

    # print "increment_u, increment_v: ", increment_u, increment_v

    model_u = array(model_u)
    model_v = array(model_v)
    corrected_u = model_u + increment_u 
    corrected_v = model_v + increment_v 

    # def skill(obs, model):
    skill_u_before = skill(match_analy_u, model_u)
    skill_u_after = skill(match_analy_u, corrected_u)
    # print "skill_u_before, skill_u_after: ", skill_u_before, skill_u_after


    skill_v_before = skill(match_analy_v, model_v)
    skill_v_after = skill(match_analy_v, corrected_v)
    # print "skill_v_before, skill_v_after: ", skill_v_before, skill_v_after

    buoy_skill=(model_t[0], skill_u_before, skill_u_after, skill_v_before, skill_v_after, hours)


    return buoy_skill
	





def one_nc_skill(NetCDF_file_name):

    B_skill = One_buoy_skill(NetCDF_file_name, "tabs_B_ven")					# return buoy_skill
    F_skill = One_buoy_skill(NetCDF_file_name, "tabs_F_ven")					# return buoy_skill
    J_skill = One_buoy_skill(NetCDF_file_name, "tabs_J_ven")					# return buoy_skill
    K_skill = One_buoy_skill(NetCDF_file_name, "tabs_K_ven")					# return buoy_skill
    N_skill = One_buoy_skill(NetCDF_file_name, "tabs_N_ven")					# return buoy_skill
    R_skill = One_buoy_skill(NetCDF_file_name, "tabs_R_ven")					# return buoy_skill
    V_skill = One_buoy_skill(NetCDF_file_name, "tabs_V_ven")					# return buoy_skill
    W_skill = One_buoy_skill(NetCDF_file_name, "tabs_W_ven")					# return buoy_skill

    print "buoy_skills="
    print "(model_t[0], skill_u_before, after, v_before, after, hours): "
    print ''.join('%7.3f,' % n for n in B_skill)
    print ''.join('%7.3f,' % n for n in F_skill)
    print ''.join('%7.3f,' % n for n in J_skill)
    print ''.join('%7.3f,' % n for n in K_skill)
    print ''.join('%7.3f,' % n for n in N_skill)
    print ''.join('%7.3f,' % n for n in R_skill)
    print ''.join('%7.3f,' % n for n in V_skill)
    print ''.join('%7.3f,' % n for n in W_skill)


    """
    # The one_nc_skill.py should return skill an array, it has 34 elements, 
    # 0, first time point in seconds
    1, 2, 3, 4: before_B_u, after_B_u, before_B_v, after_B_v
    5, 6, 7, 8: Buoy F
    9, 10, 11, 12: J
    K: 13-16
    N: 17-20
    R: 21-14
    V: 25-28
    W: 29-32
    33: total hours
    """

    one_file_skill = range(0,34)
    one_file_skill[0:5] = B_skill[0:5] 
    one_file_skill[5:9] = F_skill[1:5]
    one_file_skill[9:13] =  J_skill[1:5]
    one_file_skill[13:17] = K_skill[1:5]
    one_file_skill[17:21] = N_skill[1:5]
    one_file_skill[21:25] = R_skill[1:5]
    one_file_skill[25:29] = V_skill[1:5] 
    one_file_skill[29:34] = W_skill[1:6]

    print ''.join('%7.3f,' % n for n in one_file_skill)
    return one_file_skill

### The following line makes the file excutable.
NetCDF_file_name = "/home/liuduan/testpages/Grom/GROM-fore-reg-11-11-05-00-72.nc"				#### NetCDF file here.
# print one_nc_skill(NetCDF_file_name)

print 'one_nc_skill.py calculated in %7.3f seconds' % (time.time()-t_start)





