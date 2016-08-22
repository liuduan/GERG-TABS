# Interpolation_1D.py
# copyright LIU Duan
# The following is the Optimal Interpolation program. 
# It needs:  	
# The array of x values (xi)
# The array of y values (Obsv)
# The observation error (Obs_err), which should be 1/10 of y value to keep the program running well
# The background error (Bkg_err), it determines how stif the curve is. (For bending)
# The background error (Bkg_err), related to the scale of x. For TABS observation data, when x is 10^9 seconds, Bkg_err is 100000. 
# The background error (Bkg_err) could be related to y values.
# The background error Bkg_err is about the bending (Ro), when the scale of x-axsis changed, it need to change.
# Max_Bkg_err_va(Max_Bkg_err_va) is the maximum background error variance, it need to be less than 1/10 of the background error. 
# For TABS observation data, Max_Bkg_err_va(Max_Bkg_err_va) = 500 works quite well. 
# It returns x array (x); Analysis array (Analysis); and analysis errow (Ea).

from numpy import *
import numpy as np
import time
import datetime

def interpolation(xi, Obsv, Obs_err, Bkg_err, Max_Bkg_err_va): 
    t_start = time.time()
	
    N = len(xi)
    # Grid and backround information
    x = mgrid[xi[0]:xi[N-1]:80j]              # produce grid, 0-1, 0-1000? x is now array not grid.
    # print "This is x: ", x
	
	# Construct distance matricies
    Gr_Obs_dist = x[newaxis,:]-xi[:,newaxis]  			# distance matrix: grid to obs points in x axis
    Obs_Obs_dist = xi[newaxis,:]-xi[:,newaxis]  		# distance matrix: obs to obs points in x axis
    # print "shape of Obs_Obs_dist: ", Obs_Obs_dist.shape
    # print "shape of Gr_Obs_dist: ", Gr_Obs_dist.shape
    # xi[newaxis,:] add all the necessary rows or colums needed for the operation, each row or colunm will be exactly the same as the original one.		
	
	# Construct background error covariance matricies
    Bi = Max_Bkg_err_va*exp(-Gr_Obs_dist**2/Bkg_err**2)
    B = Max_Bkg_err_va*exp(-Obs_Obs_dist**2/Bkg_err**2)
    # print "B shape: ", B.shape
    #print "B: ", B		

    O = Obs_err**2*eye(N)                 #eye(N) Return a 2-D array with ones on the diagonal and zeros elsewhere

    # Weights, analysis and analysis error
    W = dot(linalg.inv(B + O), Bi)					# linear algebra, invert a matrix
    # print "This is W.shape", W.shape	
    Analysis = dot(Obsv,W).T										# .T for Transpose.
    # print 'This is Analysis.shape: ', Analysis.shape
    Ea = diag(sqrt(Max_Bkg_err_va - dot(W.T, Bi)))

    print 'Interpolation_1D.py Calculated in %7.3f seconds' % (time.time()-t_start)

    return x, Analysis, Ea

