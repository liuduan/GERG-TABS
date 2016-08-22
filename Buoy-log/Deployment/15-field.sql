
USE tabs_status;

DROP TABLE deployment_table2;

CREATE TABLE deployment_table2 (
File_Number	VARCHAR(50), 
checkout	VARCHAR(10), 
site	VARCHAR(5), 
Seapac_SN	VARCHAR(50), 
Current_Sensor_SN	VARCHAR(10), 
Current_Sensor_model	VARCHAR(20), 
Modem_Type	VARCHAR(20), 
Deployment_Ship	VARCHAR(30),  
Dep_time DATETIME, 
Recovery_time DATETIME, 
Recovery_Ship	VARCHAR(30),
Deployed_days	SMALLINT,
inclination	VARCHAR(10),
Comments	VARCHAR(150)
);

Describe deployment_table2;

