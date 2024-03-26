CREATE TABLE User (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(16) UNIQUE,
    FirstName VARCHAR(16),
    MiddleName VARCHAR(16),
    LastName VARCHAR(16),
    Birthdate DATE,
    Password VARCHAR(16),
    Email VARCHAR(100) UNIQUE
);

CREATE TABLE Buyer (
    BuyerID INT PRIMARY KEY,
    FOREIGN KEY (BuyerID) REFERENCES User (UserID)
);

CREATE TABLE Admin (
    AdminID INT PRIMARY KEY,
    FOREIGN KEY (AdminID) REFERENCES User (UserID)
);

CREATE TABLE Seller (
    SellerID INT PRIMARY KEY,
    FOREIGN KEY (SellerID) REFERENCES User (UserID)
);

CREATE TABLE TicketInventory (
    TicketID INT PRIMARY KEY,
    SellerID INT,
    TicketQty INT,
    TicketStatus BOOLEAN,
    IsOverdue BOOLEAN,
    FOREIGN KEY (SellerID) REFERENCES Seller (SellerID)
);

CREATE TABLE Event (
    EventID INT PRIMARY KEY,
    AdminID INT,
    Status ENUM ('Approved', 'Pending', 'Rejected'),
    EventName VARCHAR(100),
    Location VARCHAR(100),
    DateTime DATETIME,
    FOREIGN KEY (AdminID) REFERENCES Admin (AdminID)
);

CREATE TABLE TicketInfo (
    TicketID INT PRIMARY KEY,
    SellerID INT,
    EventID INT,
    TicketName VARCHAR(100),
    TicketDescription VARCHAR(255),
    Price DECIMAL(65, 2),
    Seat INT,
    OpeningDateTime DATETIME,
    ClosingDateTime DATETIME,
    FOREIGN KEY (EventID) REFERENCES Event (EventID)
);

CREATE TABLE Payment (
    PaymentID INT PRIMARY KEY AUTO_INCREMENT,
    PaymentMethod VARCHAR(50),
    UserID INT,
    Amount DECIMAL(10, 2),
    Status BOOLEAN,
    TransactionID INT,
    FOREIGN KEY (UserID) REFERENCES User(UserID)
);

CREATE TABLE CreditCard (
    CardID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    CardNumber VARCHAR(16),
    ExpiryDate DATE,
    CardHolderName VARCHAR(50),
    CVC INT,
    FOREIGN KEY (UserID) REFERENCES User(UserID)
);

CREATE TABLE BankTransfer (
    BankID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    BankName VARCHAR(50),
    AccountHolderName VARCHAR(50),
    AccountNumber VARCHAR(16),
    FOREIGN KEY (UserID) REFERENCES User(UserID)
);

CREATE TABLE Orders (
    OrderID INT PRIMARY KEY,
    UserID INT,
    PaymentID INT,
    TicketID INT,
    TicketQuantity INT,
    OrderCost DECIMAL(10, 2),
    OrderDateTime DATETIME,
    OrderStatus BOOLEAN
);

CREATE TABLE Cart (
    TicketID INT PRIMARY KEY,
    TicketName VARCHAR(100),
    Quantity INT,
    Price DECIMAL(10, 2)
);

-- Inserting data into User table
INSERT INTO User (Username, FirstName, MiddleName, LastName, Birthdate, Password, Email) 
VALUES ('john_doe', 'John', '', 'Doe', '1990-05-15', 'password1', 'john.doe@example.com'),
       ('jane_smith', 'Jane', '', 'Smith', '1985-08-22', 'password2', 'jane.smith@example.com'),
       ('mike_jones', 'Mike', '', 'Jones', '1995-11-10', 'password3', 'mike.jones@example.com'),
       ('admin_user', 'Admin', '', 'User', '1980-01-01', 'adminpass', 'admin@example.com');

-- Inserting data into Buyer table
INSERT INTO Buyer (BuyerID) VALUES (1), (3);

-- Inserting data into Seller table
INSERT INTO Seller (SellerID) VALUES (2);

-- Inserting data into Admin table
INSERT INTO Admin (AdminID) VALUES (4);

-- Inserting data into TicketInventory table
INSERT INTO TicketInventory (TicketID, SellerID, TicketQty, TicketStatus, IsOverdue) 
VALUES (1, 2, 50, TRUE, FALSE);

-- Inserting data into Event table
INSERT INTO Event (EventID, AdminID, Status, EventName, Location, DateTime) 
VALUES (1, 4, 'Approved', 'Concert', 'Venue A', '2024-04-10 18:00:00');

-- Inserting data into TicketInfo table
INSERT INTO TicketInfo (TicketID, SellerID, EventID, TicketName, TicketDescription, Price, Seat, OpeningDateTime, ClosingDateTime) 
VALUES (1, 2, 1, 'Concert Ticket', 'VIP Seat', 100.00, 101, '2024-04-01 10:00:00', '2024-04-10 17:00:00');

-- Inserting data into Payment table
INSERT INTO Payment (PaymentMethod, UserID, Amount, Status, TransactionID) 
VALUES ('Credit Card', 1, 100.00, TRUE, 123456),
       ('Credit Card', 2, 50.00, TRUE, 789012),
       ('Bank Transfer', 3, 75.00, TRUE, 345678),
       ('Bank Transfer', 1, 150.00, TRUE, 456789), 
       ('Credit Card', 3, 75.00, TRUE, 901234);   
-- Inserting data into CreditCard table
INSERT INTO CreditCard (UserID, CardNumber, ExpiryDate, CardHolderName, CVC) 
VALUES (1, '1234567890123456', '2025-12-01', 'john_doe', 123),
       (1, '9876543210987654', '2024-10-01', 'john_doe', 456),
       (2, '1111222233334444', '2026-06-01', 'jane_smith', 789),
       (3, '4444333322221111', '2025-08-01', 'mike_jones', 246);

-- Inserting data into BankTransfer table
INSERT INTO BankTransfer (UserID, BankName, AccountHolderName, AccountNumber) 
VALUES (2, 'Bank X', 'jane_smith', '1234567890123456'),
       (3, 'Bank Y', 'mike_jones', '9876543210987654'),
       (1, 'Bank Z', 'john_doe', '9876123456789012'); 
