
# CREATE DATABASE Metadata;

USE Metadata;

# DROP TABLE Components;

CREATE TABLE Components (
Component_N			VARCHAR(50), 
Component_type		VARCHAR(50), 

Date_received		DATE,
Manufacture			VARCHAR(50), 
Model				VARCHAR(20), 
Serial_N			VARCHAR(20), 
Owner				VARCHAR(20),

Inventory_N			VARCHAR(20), 
Sensor_range		VARCHAR(20), 
Factory_precision	VARCHAR(20),
Factory_accuracy	VARCHAR(20), 
Other_specif		VARCHAR(50), 

Status	VARCHAR(20),
Current_location	VARCHAR(20),

Notes				TEXT(1000)
);

Describe Components;

