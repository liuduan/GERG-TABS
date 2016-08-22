#
"""
#### Program Notes ####
/Python/Interpolation/correct-extesion.py
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


def cross_correlate(series_a, series_b):
    cross_correlation = concatenate((series_a*0, series_b*0))
    series_c = concatenate((series_a*0, series_b, series_a*0))

    for n in range(len(series_b)+len(series_a)):
        corr_point = 0
        for m in range(len(series_a)):
            corr_ele = series_a[m] * series_c[m+n]
            corr_point = corr_point + corr_ele
            # print "n, m, corr_ele", n, m, corr_ele 
        # print correla1
        cross_correlation[n] = cross_correlation[n] + corr_point
		
    A_index_offset = 0
	
    """	
    for i in range(len(cross_correlation)):
        if cross_correlation[i] == np.max(cross_correlation, axis=None, out=None):
            A_index_offset = i-len(series_a)
            # print "i", i
            # print "len(series_a)", len(series_a)
    """
	
    ######## Find local peak within +-12 hours.

    cross_correlation = list(cross_correlation)
    A_index_local_offset = cross_correlation.index(np.max(cross_correlation[60:85]))-72

    if abs(A_index_local_offset) == 12: A_index_local_offset = 0
    # print "A_index_local_offset: ", A_index_local_offset 

    return cross_correlation, A_index_local_offset