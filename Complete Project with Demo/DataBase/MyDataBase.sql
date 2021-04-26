CREATE DATABASE softwaredesign;
USE softwaredesign;

create table Accounts(
   username VARCHAR(100),
   encryptedpassword VARCHAR(100),
   checkpoint_update BOOLEAN,
   checkpoint_employee BOOLEAN,
   PRIMARY KEY ( username )
);

create table Personal(
   username VARCHAR(100),
   firstname VARCHAR(100),
   lastname VARCHAR(100),
   dob VARCHAR(100),
   email VARCHAR(100),
   phone VARCHAR(100),
   address1 VARCHAR(100),
   address2 VARCHAR(100),
   city VARCHAR(100),
   zipcode INT,
   statename VARCHAR(100),
   payment VARCHAR(100),
   PRIMARY KEY ( username )
);

create table History(
   id INT,
   username VARCHAR(100),
   deliverydate VARCHAR(100),
   gallons INT,
   deliveryaddress VARCHAR(100),
   totalprice VARCHAR(100),
   PRIMARY KEY ( id )
);

create table FuelQuote(
   fuelname VARCHAR(100),
   price FLOAT,
   tax FLOAT,
   PRIMARY KEY ( fuelname )
);

create table Company(
   branch VARCHAR(100),
   totalgallons INT,
   totalprofit FLOAT,
   totaltax FLOAT,
   PRIMARY KEY ( branch )
);

INSERT INTO Accounts(username, encryptedpassword, checkpoint_update, checkpoint_employee)
VALUES('username', '4VcqfMk/L9o=', TRUE, TRUE);

INSERT INTO Personal(username, firstname, lastname, dob, email, phone, address1, address2, city, zipcode, statename, payment)
VALUES('username', 'john', 'doe', '1998-03-04', 'johndoe@cheapboi.com', '888-888-8888','1203 cheap street drive', '1204 cheap street drive', 'houston', 77777, 'TX', "7777 7777 7777 7777");

INSERT INTO History(id, username, deliverydate, gallons, deliveryaddress, totalprice)
VALUES(1, 'username', '2021-03-04', 0, '1203 cheap street drive', '0');

INSERT INTO FuelQuote(fuelname, price, tax)
VALUES('cheap boi fuel', 1.50, 0.08);

INSERT INTO Company(branch, totalgallons, totalprofit, totaltax)
VALUES('cheap boi fuel distribution', 0, 0.00, 0.00);

DROP TABLE Accounts;
DROP TABLE Personal;
DROP TABLE History;
DROP TABLE FuelQuote;
DROP TABLE Company;

