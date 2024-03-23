CREATE TABLE User (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    Username VARCHAR(50) UNIQUE,
    FirstName VARCHAR(50),
    LastName VARCHAR(50),
    Birthdate DATE,
    Password VARCHAR(100),
    Email VARCHAR(100) UNIQUE
);

CREATE TABLE Buyer (
    BuyerID INT PRIMARY KEY,
    UserID INT UNIQUE, 
    FOREIGN KEY (UserID) REFERENCES User(UserID)
);

CREATE TABLE Admin (
    AdminID INT PRIMARY KEY,
    UserID INT UNIQUE,
    FOREIGN KEY (UserID) REFERENCES User(UserID)
);

CREATE TABLE Seller (
    SellerID INT PRIMARY KEY,
    UserID INT UNIQUE,
    FOREIGN KEY (UserID) REFERENCES User(UserID)
);
CREATE TABLE TicketInventory (
    TicketID INT PRIMARY KEY,
    SellerID INT,
    TicketQty INT,
    TicketStatus BOOLEAN,
    IsOverdue BOOLEAN,
    FOREIGN KEY (SellerID) REFERENCES Seller(SellerID)
);

CREATE TABLE TicketInfo (
    TicketID INT PRIMARY KEY,
    EventID INT,
    TicketName VARCHAR(100),
    TicketDescription VARCHAR(255),
    Price DECIMAL(10000, 2),
    Seat INT,
    OpeningDateTime DATETIME,
    ClosingDateTime DATETIME,
    FOREIGN KEY (EventID) REFERENCES Event(EventID)
);

CREATE TABLE Event (
    EventID INT PRIMARY KEY,
    EventName VARCHAR(100),
    EventDescription VARCHAR(255),
    EventType VARCHAR(50),
    ArtistID INT,
    Location VARCHAR(100),
    DateTime DATETIME,
);

CREATE TABLE Order (
    OrderID INT PRIMARY KEY,
    UserID INT,
    PaymentID INT,
    TicketID INT,
    TicketQuantity INT,
    OrderCost DECIMAL(10, 2),
    OrderDateTime DATETIME,
    OrderStatus BOOLEAN,
);

CREATE TABLE Payment (
    PaymentID INT PRIMARY KEY,
    PaymentMethod VARCHAR(50),
    UserID INT,
    Amount DECIMAL(10, 2),
    Status BOOLEAN,
    TransactionID INT,
    FOREIGN KEY (UserID) REFERENCES User(UserID)
);

CREATE TABLE Cart (
    TicketID INT PRIMARY KEY,
    TicketName VARCHAR(100),
    Quantity INT,
    Price DECIMAL(10, 2)
);
