
USE tabs_status;

# DROP TABLE TABS14m;

CREATE TABLE TABS14m (
file_number	VARCHAR(50), 
checkout	VARCHAR(50), 

system_SN	VARCHAR(20), 
Hull_SN		VARCHAR(20),
Technicians	VARCHAR(20),
Site		VARCHAR(10), 

start_date	DATE, 
deploy_date	DATE, 
HEX_ESN	VARCHAR(20),
Phone		VARCHAR(20), 

ADCP_SN		VARCHAR(25), 
ADCP_port	VARCHAR(15), 
MicroCat_SN_a	VARCHAR(25), 
MicroCat_port_a	VARCHAR(15), 
MicroCat_SN_b	VARCHAR(25), 
MicroCat_port_b	VARCHAR(15), 

Gill_SN		VARCHAR(25), 
Gill_port	VARCHAR(15), 
Airmar_SN_a		VARCHAR(25), 
Airmar_port_a	VARCHAR(15), 
Airmar_SN_b		VARCHAR(25), 
Airmar_port_b	VARCHAR(15), 
Airmar_SN_c		VARCHAR(25), 
Airmar_port_c	VARCHAR(15), 

Honeywell_SN		VARCHAR(25), 
Honeywell_port		VARCHAR(15), 
MicroStrain_SN_a	VARCHAR(25), 
MicroStrain_port_a	VARCHAR(15), 
MicroStrain_SN_b	VARCHAR(25), 
MicroStrain_port_b	VARCHAR(15), 
MicroStrain_SN_c	VARCHAR(25), 
MicroStrain_port_c	VARCHAR(15), 

Iridium_SN		VARCHAR(25), 
Iridium_port	VARCHAR(15), 
Freewave_SN		VARCHAR(25), 
Freewave_port	VARCHAR(15), 
TransSystem_SN	VARCHAR(25), 
TransSystem_port	VARCHAR(15), 

Sensor_Notes		TEXT(5000),

Battery_1a	VARCHAR(15), 
Battery_1b	VARCHAR(15), 
Battery_1c	VARCHAR(15), 
Battery_1d	VARCHAR(15), 
Battery_1e	VARCHAR(15), 
Battery_1f	VARCHAR(15), 

Battery_2a	VARCHAR(15), 
Battery_2b	VARCHAR(15), 
Battery_2c	VARCHAR(15), 
Battery_2d	VARCHAR(15), 
Battery_2e	VARCHAR(15), 
Battery_2f	VARCHAR(15), 


Battery_3a	VARCHAR(15), 
Battery_3b	VARCHAR(15), 
Battery_3c	VARCHAR(15), 
Battery_3d	VARCHAR(15), 
Battery_3e	VARCHAR(15), 
Battery_3f	VARCHAR(15), 

Measurements_1	VARCHAR(10), 
Measurements_2	VARCHAR(10), 
Measurements_3	VARCHAR(10), 
Measurements_4	VARCHAR(10), 
Measurements_5	VARCHAR(10), 
Measurements_6	VARCHAR(10), 
Measurements_7	VARCHAR(10), 
Measurements_8	VARCHAR(10), 
Measurements_9	VARCHAR(10), 
Measurements_10	VARCHAR(10), 
Measurements_11	VARCHAR(10), 
Measurements_12	VARCHAR(10), 

Measure_Notes		TEXT(1000),

Analog_1	VARCHAR(10), 
Analog_2	VARCHAR(10), 
Analog_3	VARCHAR(10), 
Analog_4	VARCHAR(10), 
Analog_5	VARCHAR(10), 
Analog_6	VARCHAR(10), 

Analog_Notes		TEXT(1000),

Allignment_1	VARCHAR(10), 
Allignment_2	VARCHAR(10), 
Allignment_3	VARCHAR(10), 
Allignment_4	VARCHAR(10), 
Allignment_5	VARCHAR(10),

Telemetry_1	VARCHAR(10), 
Telemetry_date_1	VARCHAR(15), 
Telemetry_2	VARCHAR(10), 
Telemetry_date_2	VARCHAR(15), 
Telemetry_3	VARCHAR(10), 
Telemetry_date_3	VARCHAR(15), 
Telemetry_4	VARCHAR(10), 
Telemetry_date_4	VARCHAR(15), 

Mechanical_1	VARCHAR(10), 
Mechanical_2	VARCHAR(10), 
Mechanical_3	VARCHAR(10), 
Mechanical_4	VARCHAR(10), 
Mechanical_5	VARCHAR(10), 
Mechanical_6	VARCHAR(10), 
Mechanical_7	VARCHAR(10), 
Mechanical_8	VARCHAR(10), 
Mechanical_9	VARCHAR(10), 
Mechanical_10	VARCHAR(10), 
Mechanical_11	VARCHAR(10), 
Mechanical_12	VARCHAR(10), 

Mechanical_Notes		TEXT(1000),

Comments	TEXT(5000)
);

Describe TABS14m;

