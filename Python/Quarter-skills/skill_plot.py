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

import numpy as np
from numpy import *
from mpl_toolkits.mplot3d.axes3d import Axes3D
import pylab as pl
from time import time


all_skills = np.loadtxt('all_skills.dat')      # load data.
print "all_skills.shape", all_skills.shape

########## Plot
# pl.title('U East, Buoy ' + Buoy_name[5:6])
# pl.plot(all_skills[:,1:])
print all_skills[:9,0]
print all_skills[:9,1]
pl.plot(all_skills[:,7], 'r')
pl.plot(all_skills[:,8], 'g')
message = 'skill_before = ' + str(np.average(all_skills[:,1])) + ', skill_after = ' + str(np.average(all_skills[:,2]))
pl.text(2, -1, message,
     horizontalalignment='center',
     verticalalignment='center')
#pl.plot(all_skills[:9,0], all_skills[:9,1])
#pl.plot(all_skills[:9,0], all_skills[:9,2])
pl.show()




