# CREATE DATABASE BP_oil;
USE BP_oil;



LOAD DATA LOCAL INFILE 
'/home/liuduan/BP-oil/water.csv' INTO TABLE BP_oil  
FIELDS TERMINATED BY ',' 
LINES TERMINATED BY '\n' 
(Data_Publication_Date, 
Data_Publication_Reference, 
Study_Reference_Number, 
Study_Name, Harmonized_Study_Name, Location_or_Station_ID, Interpretive_Sample_ID, Sample_Date, Sample_Time, Latitude, Longitude, Spatial_Zone, Upper_Depth, Lower_Depth, Depth_Unit, Field_Fraction, Sample_Type, Field_Matrix, Field_Sample_Material, Field_Data_Verification_Status, Analytical_Sample_ID, Lab, Laboratory_Sample_ID, ASR_Number, SDG, Lab_Matrix, Lab_Material, Parameter_Type, Chemical_Name, Chemical_Code, Chemical_Type, Concentration_NDs_at_MDL, Concentration_NDs_at_zero, Unit, Final_Qualifiers, Validation_Qualifiers, Lab_Qualifiers, Nondetect_Flag, Validation_Level, Reporting_Limit, Method_Detection_Limit, Measurement_Basis, Lab_Fraction, Preparation_Method, Analytical_Method, Base_Analytical_Method, Lab_Replicate, Dilution_Factor, Date_Extracted, Date_Analyzed);

#SELECT * FROM BP_oil LIMIT 10;

