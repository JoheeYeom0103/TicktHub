CREATE TABLE
    User (
        UserID INT PRIMARY KEY AUTO_INCREMENT,
        Username VARCHAR(16) UNIQUE,
        FirstName VARCHAR(16),
        MiddleName VARCHAR(16),
        LastName VARCHAR(16),
        -- Birthdate DATE,
        Phone VARCHAR(12),
        Password VARCHAR(14),
        Email VARCHAR(100) UNIQUE
        -- PRIMARY KEY (Username, FirstName, MiddleName, LastName)
    );

CREATE TABLE
    Buyer (
        BuyerID INT PRIMARY KEY,
        FOREIGN KEY (BuyerID) REFERENCES User (UserID)
    );

CREATE TABLE
    Admin (
        AdminID INT PRIMARY KEY,
        FOREIGN KEY (AdminID) REFERENCES User (UserID)
    );

CREATE TABLE
    Seller (
        SellerID INT PRIMARY KEY,
        FOREIGN KEY (SellerID) REFERENCES User (UserID)
    );

CREATE TABLE
    TicketInventory (
        TicketID INT PRIMARY KEY,
        SellerID INT,
        TicketQty INT,
        TicketStatus BOOLEAN,
        IsOverdue BOOLEAN,
        FOREIGN KEY (SellerID) REFERENCES Seller (SellerID)
    );

CREATE TABLE
    Event (
        EventID INT PRIMARY KEY,
        AdminID INT,
        Status ENUM ('Approved', 'Pending', 'Rejected'),
        EventName VARCHAR(100),
        Location VARCHAR(100),
        DateTime DATETIME,
        FOREIGN KEY (AdminID) REFERENCES Admin (AdminID)
    );

CREATE TABLE
    TicketInfo (
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

CREATE TABLE
    Payment (
        PaymentID INT PRIMARY KEY,
        PaymentMethod VARCHAR(50),
        PayoutID INT,
        BuyerID INT,
        Amount DECIMAL(10, 2),
        Status BOOLEAN,
        TransactionID INT,
        FOREIGN KEY (BuyerID) REFERENCES Buyer (BuyerID),
        FOREIGN KEY (PayoutID) REFERENCES Seller (SellerID)
    );

CREATE TABLE
    CreditCard (
        CardID INT PRIMARY KEY,
        SetDefault BOOLEAN,
        CardNumber VARCHAR(16),
        ExpiryDate DATE,
        CardHolderName VARCHAR(16),
        CVC INT,
        FOREIGN KEY (CardID) REFERENCES Payment (PaymentID)
    );

CREATE TABLE
    BankTransfer (
        BankID INT PRIMARY KEY,
        SetDefault BOOLEAN,
        BankName VARCHAR(16),
        AccountHolderName VARCHAR(16),
        AccountNumber VARCHAR(16),
        FOREIGN KEY (BankID) REFERENCES Payment (PaymentID)
    );

CREATE TABLE
    Orders (
        OrderID INT PRIMARY KEY,
        UserID INT,
        PaymentID INT,
        TicketID INT,
        TicketQuantity INT,
        OrderCost DECIMAL(10, 2),
        OrderDateTime DATETIME,
        OrderStatus BOOLEAN
    );

CREATE TABLE
    Cart (
        TicketID INT PRIMARY KEY,
        TicketName VARCHAR(100),
        Quantity INT,
        Price DECIMAL(10, 2)
    );

-- Inserting into Users table
INSERT INTO
    User (
        Username,
        FirstName,
        MiddleName,
        LastName,
        -- Birthdate,
        Phone,
        Password,
        Email
    )
VALUES
    (
        'JohnMarkDoe',
        'John',
        'Mark',
        'Doe',
        -- '1990-05-15',
        '403-123-4567',
        'password1',
        'john.doe@example.com'
    ),
    (
        'AliceMarieSmith',
        'Alice',
        'Marie',
        'Smith',
        -- '1985-08-20',
        '404-234-5678',
        'password2',
        'alice.smith@example.com'
    );

-- Inserting into Buyers table
INSERT INTO
    Buyer (BuyerID)
VALUES
    (1),
    (2);

-- Inserting into Admins table
INSERT INTO
    Admin (AdminID)
VALUES
    (1);

-- Inserting into Sellers table
INSERT INTO
    Seller (SellerID)
VALUES
    (1);

-- Inserting into TicketInventory table
INSERT INTO
    TicketInventory (
        TicketID,
        SellerID,
        TicketQty,
        TicketStatus,
        IsOverdue
    )
VALUES
    (1, 1, 50, 1, 0),
    (2, 1, 30, 1, 0);

-- Inserting into Event table
INSERT INTO
    Event (
        EventID,
        AdminID,
        Status,
        EventName,
        Location,
        DateTime
    )
VALUES
    (
        1,
        1,
        'Approved',
        'Music Fest',
        'Park A',
        '2024-05-20 18:00:00'
    ),
    (
        2,
        1,
        'Approved',
        'Soccer Cup',
        'Stadium B',
        '2024-06-10 15:00:00'
    );

-- Inserting into TicketInfo table
INSERT INTO
    TicketInfo (
        TicketID,
        SellerID,
        EventID,
        TicketName,
        TicketDescription,
        Price,
        Seat,
        OpeningDateTime,
        ClosingDateTime
    )
VALUES
    (
        1,
        1,
        1,
        'Concert',
        'Music event',
        50.00,
        101,
        '2024-05-20 18:00:00',
        '2024-05-20 22:00:00'
    ),
    (
        2,
        1,
        2,
        'Sports',
        'Sports event',
        25.00,
        202,
        '2024-06-10 15:00:00',
        '2024-06-10 18:00:00'
    );

-- Inserting into Order table
INSERT INTO
    Orders (
        OrderID,
        UserID,
        PaymentID,
        TicketID,
        TicketQuantity,
        OrderCost,
        OrderDateTime,
        OrderStatus
    )
VALUES
    (1, 1, 1, 1, 2, 100.00, '2024-03-12 10:30:00', 1),
    (2, 2, 2, 2, 1, 25.00, '2024-03-12 11:00:00', 1);

-- Inserting into Payment table
INSERT INTO
    Payment (
        PaymentID,
        PaymentMethod,
        PayoutID,
        BuyerID,
        Amount,
        Status,
        TransactionID
    )
VALUES
    (1, 'Credit Card', 1, 1, 100.00, 1, 123456),
    (2, 'PayPal', 1, 2, 25.00, 1, 789012);

-- Insert statement for CreditCard table
INSERT INTO
    CreditCard (
        CardID,
        SetDefault,
        CardNumber,
        ExpiryDate,
        CardHolderName,
        CVC
    )
VALUES
    (
        1,
        TRUE,
        '1234567812345678',
        '2025-12-31',
        'John Doe',
        123
    ),
    (
        2,
        FALSE,
        '9876543298765432',
        '2024-11-30',
        'Jane Smith',
        456
    );

-- Insert statement for BankTransfer table
INSERT INTO
    BankTransfer (
        BankID,
        SetDefault,
        BankName,
        AccountHolderName,
        AccountNumber
    )
VALUES
    (
        1,
        TRUE,
        'Bank of America',
        'Alice Johns',
        '1234567890123456'
    ),
    (
        2,
        FALSE,
        'Chase Bank',
        'Bob Wills',
        '9876543210987654'
    );

-- Inserting into Cart table
INSERT INTO
    Cart (TicketID, TicketName, Quantity, Price)
VALUES
    (1, 'Concert', 2, 50.00),
    (2, 'Sports', 1, 25.00);

-- select statements for currently working tables
SELECT
    *
FROM
    User;

SELECT
    *
FROM
    Admin;

SELECT
    *
FROM
    Buyer;

SELECT
    *
FROM
    Seller;

SELECT
    *
FROM
    Cart;

SELECT
    *
FROM
    Event;

-- nothing is inside orders
SELECT
    *
FROM
    Orders;

SELECT
    *
FROM
    Payment;

SELECT
    *
FROM
    CreditCard;

SELECT
    *
FROM
    BankTransfer;

SELECT
    *
FROM
    TicketInfo;

SELECT
    *
FROM
    TicketInventory;