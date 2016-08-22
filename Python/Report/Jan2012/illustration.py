# 1D-interpolation.py
# copyright LIU Duan
# The following is the Optimal Interpolation program. 
# It needs:  	
# The array of x values (xi)
# The array of y values (Obsv)
# The observation error (Obs_err), which should be 1/10 of y value to keep the program running well
# The background error (Bkg_err), it determines how stif the curve is. 
# The background error (Bkg_err), related to the scale of x. For TABS observation data, when x is 10^9 seconds, Bkg_err is 100000. 
# The background error (Bkg_err) could be related to y values.
# The background error Bkg_err is about the bending (Ro), when the scale of x-axsis changed, it need to change.
# Max_Bkg_err_va(Max_Bkg_err_va) is the maximum background error variance, it need to be less than 1/10 of the background error. 
# For TABS observation data, Max_Bkg_err_va(Max_Bkg_err_va) = 5000 works quite well. 
# It returns x array (x); Analysis array (Analysis); and analysis errow (Ea).

from numpy import *
import numpy as np
import time
import datetime
import pylab as pl

x = array(range(0, 600, 1)) * 0.1
y = sin(x)
y1 = y[30:160] + 1.5
x1 = x[30:160]

y2 = y[180:310]
x2 = x[180:310] + 1.5

y3 = y[350:550]*0.5
x3 = x[350:550]

pl.plot(x,y, 'r')
pl.plot(x1,y1, 'b')
pl.plot(x2,y2, 'g')
pl.plot(x3,y3, 'k')

pl.axis([-5, 65, -1.5, 3])
# pl.xlabel('Time')
# pl.ylabel('m/s or x10 hour')
pl.savefig("fig1.png", dpi=None, facecolor='w', edgecolor='w', orientation='portrait', papertype=None, format="png", transparent=True, bbox_inches=None, pad_inches=0.1)
pl.show()
exit()
