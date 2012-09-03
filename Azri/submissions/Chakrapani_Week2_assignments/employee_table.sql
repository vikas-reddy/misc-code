create database asnmt2_azri;
use asnmt2_azri;
create table employee(FNAME varchar(15) not null,LNAME varchar(15),ENO char(9) not null,DOB date,ADDRESS BLOB,SALARY decimal(10,2),DNUMBER int not null,PRIMARY KEY(ENO));
