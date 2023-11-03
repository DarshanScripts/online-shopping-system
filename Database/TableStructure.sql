CREATE DATABASE OnlineShopping;

USE OnlineShopping;


CREATE TABLE Admin
(
    aId INT PRIMARY KEY AUTO_INCREMENT,
    firstName VARCHAR(15) NOT NULL,
    lastName VARCHAR(15) NOT NULL,
    email VARCHAR(35) NOT NULL,
    password CHAR(32),
    creationDate DATETIME
);


CREATE TABLE Customer
(
    cId INT PRIMARY KEY AUTO_INCREMENT,
    firstName VARCHAR(15) NOT NULL,
    lastName VARCHAR(15) NOT NULL,
    email VARCHAR(35) NOT NULL,
    password CHAR(32),
    creationDate DATETIME
);


CREATE TABLE Shoe
(
    sId INT PRIMARY KEY AUTO_INCREMENT,
    brand VARCHAR(25) NOT NULL,
    description VARCHAR(100) NOT NULL,
    category VARCHAR(25) NOT NULL,
    photo VARCHAR(40),
    price DECIMAL(8,2) NOT NULL,
    stock INT(4) NOT NULL
);

INSERT INTO Shoe VALUES
(1,"Adidas","Men's Forum Mid Black Ankle High Sneakers","Running","adidas1.jpeg",1000.00,15),
(2,"Puma","Punch Comfort Insole Basics Sneakers","Sports","puma1.jpeg",1500.00,98),
(3,"U.S. Polo Assn.","Synthetic Sneakers For Men","Casual","uspolo1.jpeg",1399.00,2),
(4,"Nike","Impact 4 Basketball Shoes","Sports","nike1.jpeg",999.00,44),
(5,"Adidas","Men's Forum Low Shoes","Casual","adidas2.jpeg",2199.00,13);


CREATE TABLE PurchasedShoes
(
    pcId INT,
    psId INT,
    quantity INT NOT NULL,
    purchasedDate DATETIME,
    PRIMARY KEY(pcId,psId),
    FOREIGN KEY (pcId) REFERENCES Customer(cId), 
    FOREIGN KEY (psId) REFERENCES Shoe(sId)
);


CREATE TABLE Cart
(
    ccId INT,
    csId INT,
    PRIMARY KEY(ccId,csId),
    FOREIGN KEY (ccId) REFERENCES Customer(cId),
    FOREIGN KEY (csId) REFERENCES Shoe(sId)
);