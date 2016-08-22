# This script was modified from Dr. Rob Hetland's

import numpy as np
from numpy import *
from mpl_toolkits.mplot3d.axes3d import Axes3D
import pylab as pl
from time import time


# load data
xi, yi, zi = np.loadtxt('data_1.dat').T        # load data.
print "xi.shape, yi.shape, zi.shape", xi.shape, yi.shape, zi.shape

# create grid
xg, yg = mgrid[0:1:51j, 0:1:51j]
print "xg.shape, yg.shape ", xg.shape, yg.shape

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
Ro = 0.15						# Ro is the background error covariance decay scale. It is the bending
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
        
A = dot(zi, W).T
Ea = sqrt(diag(Be - dot(W.T, Bi)))
        

# Plotting

fig = pl.figure() 
ax = Axes3D(fig)

The_Figure = ax.plot_wireframe(xg.reshape(51,51), yg.reshape(51,51), A.reshape(51,51))

ax.bar3d(xi,yi,zi, 0.01, 0.01, 0.01, color='r')

pl.xlabel('x')
pl.ylabel('y')
pl.title('Analysis results on the grid points with the observation point')
    
pl.show()
# np.savetxt('myname_1.dat', A.reshape(xg.shape))
np.savetxt('liuduan_2.dat', A.reshape(xg.shape))

