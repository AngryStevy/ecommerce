CREATE TABLE clients (
    clientID INT PRIMARY KEY AUTO_INCREMENT,
    LastName VARCHAR(20),
    FirstName VARCHAR(20),
    Address VARCHAR(20),
    email VARCHAR(20),
    passwd VARCHAR(20)
);
CREATE TABLE administrator (
    administratortID INT PRIMARY KEY AUTO_INCREMENT,
    LastName VARCHAR(20),
    FirstName VARCHAR(20),
    email VARCHAR(20),
    passwd VARCHAR(20)
);
CREATE TABLE product (
    productID INT PRIMARY KEY AUTO_INCREMENT,
    productName VARCHAR(50),
    quantity INT
);
CREATE TABLE agence (
    agenceID INT PRIMARY KEY AUTO_INCREMENT,
    clientID INT,
    FOREIGN KEY (clientID) REFERENCES clients(clientID)
    );
    
   
);
CREATE TABLE accountType (
    accountTypeID INT PRIMARY KEY AUTO_INCREMENT,
    accountTypeName VARCHAR(20),
    
);
CREATE TABLE accounts (
    accountID INT PRIMARY KEY AUTO_INCREMENT,
    accountName VARCHAR(20),
    accountTypeID INT,
    FOREIGN KEY (accountTypeID) REFERENCES accountType(accountTypeID)
    );
CREATE TABLE orders (
    orderID INT PRIMARY KEY AUTO_INCREMENT,
    orderDate date,
    clientID INT,
    productID INT,
    FOREIGN KEY (productID) REFERENCES product(productID),
    FOREIGN KEY (clientID) REFERENCES clients(clientID)
    );
CREATE TABLE category (
    categoryID INT PRIMARY KEY AUTO_INCREMENT,
    categoryName VARCHAR(20),
    productID INT,
    FOREIGN KEY (productID) REFERENCES product(productID)
    );

CREATE TABLE cart (
    categoryID INT,
    productID INT,
    clientID INT,
    unit_number INT,
    FOREIGN KEY (categoryID) REFERENCES category(categoryID),
    FOREIGN KEY (productID) REFERENCES product(productID),
    FOREIGN KEY (clientID) REFERENCES clients(clientID)
    );
    
    

