# This script was modified from Dr. Rob Hetland's

import numpy as np
from numpy import *
from mpl_toolkits.mplot3d.axes3d import Axes3D
import pylab as pl
from time import time

def OI_2d_function(xi, yi, zi, xg, yg):

    print "xg.shape before flat ", xg.shape
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
    Ro = 1.0						# Ro is the background error covariance decay scale. It is the bending
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

    pl.xlabel('Latitude')
    pl.ylabel('Longitude')
    # pl.zlabel('Bias in Amplitude')
    pl.title('Analysis results on the grid points with the observation point')
    
    pl.show()
    # np.savetxt('myname_1.dat', A.reshape(xg.shape))
    # np.savetxt('liuduan_2.dat', A.reshape(xg.shape))
    return A				# analysis matrix


# load data
# V_Ranges:


zi = [2.74091385, 3.13238422, 1.74563805, 1.40297249, 8.92231774, 1.46923623, 3.67720364, 1.72101212, 1.50497262]
zi = array(zi)
# latitude
xi = [28.9818, 27.9396, 28.8425, 26.194, 26.2168, 27.8903, 29.635, 27.8966, 28.3507]
xi = array(xi)
# longitude
yi = [-94.9186, -96.8429, -94.2416, -97.0507, -96.4998, -94.0367, -93.6417, -93.5973, -96.0058]
yi = array(yi)

"""
xi, yi, zi = np.loadtxt('data_1.dat').T        # load data.
xi = xi[491:]
yi = yi[491:]
zi = zi[491:]
# print xi, yi, zi
print "xi.shape, yi.shape, zi.shape", xi.shape, yi.shape, zi.shape

"""



# create grid
xg, yg = mgrid[30:25:51j, (-98):(-93):51j]				# xg --> x grid 1, 1, 1,...; 2, 2, 2...; 3, 3, 3...
# xg, yg = mgrid[0:1:51j, 0:1:51j]
print "xg.shape, yg.shape ", xg.shape, yg.shape
print xg
print yg

# exit()


Analysis = OI_2d_function(xi, yi, zi, xg, yg)		# return analysis matrix
