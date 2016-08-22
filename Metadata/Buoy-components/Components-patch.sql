
USE Metadata;

ALTER TABLE Components ADD Repetition_period VARCHAR(10);
ALTER TABLE Components ADD Platform VARCHAR(20);
ALTER TABLE Components ADD Fireware VARCHAR(20);
ALTER TABLE Components ADD Phone_x121 VARCHAR(20);
ALTER TABLE Components ADD Phone_ESN VARCHAR(20);

ALTER TABLE Components ADD Cycle VARCHAR(20);
ALTER TABLE Components ADD Offset VARCHAR(15);
ALTER TABLE Components ADD Call_window VARCHAR(15);
ALTER TABLE Components ADD Base_number VARCHAR(20);
ALTER TABLE Components ADD PTT_ID VARCHAR(20);

ALTER TABLE Components ADD Argos_PTT_SN VARCHAR(20);
ALTER TABLE Components ADD Test_sched VARCHAR(20);
ALTER TABLE Components ADD Records_unack VARCHAR(20);
ALTER TABLE Components ADD HEX_ESN VARCHAR(20);
ALTER TABLE Components ADD DEC_ESN VARCHAR(20);

Describe Components;

