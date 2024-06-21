# create tables and db

CREATE DATABASE stockexplorer;
USE stockexplorer;

CREATE TABLE shortlist(
sid varchar(5) not null primary key, 
sname varchar(30), 
user_id varchar(5) not null); 

CREATE TABLE public_companies(
ceo_id varchar(5) not null primary key, 
company_id varchar(10) primary key not null, 
cname varchar(30) not null primary key, 
sector varchar(5), 
ebitda FLOAT); 

CREATE TABLE shortlist_contains(
sid varchar(5) not null, 
company_id varchar(10), 
user_id varchar(5) not null, 
sentiment ENUM('Bullish', 'Bearish'), 
date_shortlisted DATE not null,
primary key (sid, company_id),
FOREIGN KEY (sid) REFERENCES shortlist(sid), 
foreign key (company_id) references public_companies(company_id)) ; 


