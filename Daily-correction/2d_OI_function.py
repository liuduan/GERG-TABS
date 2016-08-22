# This script was modified from Dr. Rob Hetland's

import numpy as np
from numpy import *
from mpl_toolkits.mplot3d.axes3d import Axes3D
import pylab as pl
from time import time

def OI_2d_function(xi, yi, zi):

    t_start = time()
	
    # making x, y grid
    xg, yg = mgrid[(-98):(-93):51j, 25:30:51j]				# xg --> x grid 1, 1, 1,...; 2, 2, 2...; 3, 3, 3...

    xg = xg.flatten()  # Grid points
    print "xg.shape after flat ", xg.shape

    print "yg.shape before flat ", yg.shape
    yg = yg.flatten()
    print "yg.shape after flat ", yg.shape
  
    rix= xg[newaxis,:]-xi[:,newaxis]         	# distance matrix: grid to obs points, in x axis only
    riy= yg[newaxis,:]-yi[:,newaxis]  			# distance matrix: grid to obs points
        
    rx = xi[newaxis,:] - xi[:,newaxis]  		# distance matrix: obs to obs points
    ry = yi[newaxis,:] - yi[:,newaxis]  		# distance matrix: obs to obs points

    ri = sqrt(rix**2+riy**2)
    r = sqrt(rx**2+ry**2)
        
    # Construct background error covariance matricies
    Ro = 0.8						# Ro is the background error covariance decay scale. It is the bending
										# Default Ro = 0.25/4.0, 0.15 is quite good.
    Be = 0.50 						# Be is the background error, critical for bending. default was Be=0.5
    Bi = Be*exp(-ri**2/Ro**2)
    B = Be*exp(-r**2/Ro**2)
    

    # Construct observational error covariance matrix (diagonal)
    N = zi.size 
    De = 0.01                                     # The observation error (standard deviation). The default is De=0.01.
    O = De**2*eye(N)
        
    # Weights, analysis and analysis error
    W = dot(linalg.inv(B + O), Bi)
        
    A = dot(zi, W).T					# Analysis
    Ea = sqrt(diag(Be - dot(W.T, Bi)))
        

    # Plotting

    fig = pl.figure() 
    ax = Axes3D(fig)

    The_Figure = ax.plot_wireframe(xg.reshape(51,51), yg.reshape(51,51), A.reshape(51,51))
               # ax.plot_wireframe(xg.reshape(51,51), yg.reshape(51,51), A.reshape(51,51))				# x mash, y mash, analysis


    ax.bar3d(xi,yi,zi, 0.05, 0.05, 0.1, color='r')

    pl.ylabel('Latitude')
    pl.xlabel('Longitude')
    ax.set_zlabel("Log amplitude adjustment")

    # pl.zlabel('Bias in Amplitude')
    pl.title('Analysis results on the grid points with the observation point')
    print 'Calculated in %7.3f seconds' % (time()-t_start)
    
	############################################# Inactivate the Show for the function to work #############
    # pl.show()
    # np.savetxt('myname_1.dat', A.reshape(xg.shape))
    # np.savetxt('liuduan_2.dat', A.reshape(xg.shape))
    return A				# analysis matrix


# Inactivate the following for the function to work.

"""
zi = [1.60123552, 4.09105309, 4.02329176, 7.27468651, 6.92632567, 5.22886285, 8.76550251, 2.94323305, 1.74731408]

# [1.60123552, 4.09105309, 4.02329176, 7.27468651, 6.92632567, 5.22886285, 8.76550251, 2.94323305, 1.74731408]

# [2.74091385, 3.13238422, 1.74563805, 1.40297249, 8.92231774, 1.46923623, 3.67720364, 1.72101212, 1.50497262]
zi = array(zi)
zi_log10 = log10(zi)

# longitude
yi = [28.9818, 27.9396, 28.8425, 26.194, 26.2168, 27.8903, 29.635, 27.8966, 28.3507]
yi = array(yi)

# latitude
xi = [-94.9186, -96.8429, -94.2416, -97.0507, -96.4998, -94.0367, -93.6417, -93.5973, -96.0058]
xi = array(xi)

Analysis = OI_2d_function(xi, yi, zi_log10)		# return analysis matrix
"""