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
        PaymentID INT PRIMARY KEY AUTO_INCREMENT,
        PaymentMethod VARCHAR(50),
        UserID INT,
        -- PayoutID INT,
        -- BuyerID INT,
        Amount DECIMAL(10, 2),
        Status BOOLEAN,
        TransactionID INT,
        FOREIGN KEY (UserID) REFERENCES User (UserID)
        -- FOREIGN KEY (PayoutID) REFERENCES Seller (SellerID)
    );

CREATE TABLE
    CreditCard (
        CardID INT AUTO_INCREMENT PRIMARY KEY,
        UserID INT,
        -- SetDefault BOOLEAN,
        CardNumber VARCHAR(16),
        ExpiryDate DATE,
        CardHolderName VARCHAR(50),
        CVC INT,
        FOREIGN KEY (UserID) REFERENCES User (UserID)
    );

CREATE TABLE
    BankTransfer (
        BankID INT AUTO_INCREMENT PRIMARY KEY,
        UserID INT,
        -- SetDefault BOOLEAN,
        BankName VARCHAR(50),
        AccountHolderName VARCHAR(50),
        AccountNumber VARCHAR(16),
        FOREIGN KEY (UserID) REFERENCES User (UserID)
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
        'john_doe',
        'John',
        'Mark',
        'Doe',
        -- '1990-05-15',
        '403-123-4567',
        'password1111',
        'john.doe@example.com'
    ),
    (
        'jane_smith',
        'Jane',
        'Marie',
        'Smith',
        -- '1985-08-20',
        '404-234-5678',
        'password2222',
        'jane.smith@example.com'
    ),
    (
        'mike_jones',
        'Mike',
        'David',
        'Jones',
        -- '1985-08-20',
        '403-345-6789',
        'password3333',
        'mike.jones@example.com'
    ),
    (
        'admin_user',
        'Admin',
        'Test',
        'User',
        -- '1985-08-20',
        '587-456-7890',
        'adminpassword',
        'admin@example.com'
    );

-- Inserting into Buyers table
INSERT INTO
    Buyer (BuyerID)
VALUES
    (1),
    (3);

-- Inserting into Admins table
INSERT INTO
    Admin (AdminID)
VALUES
    (4);

-- Inserting into Sellers table
INSERT INTO
    Seller (SellerID)
VALUES
    (2);

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
    -- (1, 1, 50, 1, 0),
    (1, 2, 50, TRUE, FALSE);

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
        4,
        'Approved',
        'Concert',
        'Venue A',
        '2024-04-10 18:00:00'
    );

-- (
--     2,
--     1,
--     'Approved',
--     'Soccer Cup',
--     'Stadium B',
--     '2024-06-10 15:00:00'
-- );
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
        2,
        1,
        'Concert Ticket',
        'VIP Seat',
        100.00,
        101,
        '2024-04-1 10:00:00',
        '2024-04-10 17:00:00'
    );

-- (
--     2,
--     1,
--     2,
--     'Sports',
--     'Sports event',
--     25.00,
--     202,
--     '2024-06-10 15:00:00',
--     '2024-06-10 18:00:00'
-- );
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
        -- PaymentID,
        PaymentMethod,
        UserID,
        -- PayoutID,
        -- BuyerID,
        Amount,
        Status,
        TransactionID
    )
VALUES
    ('Credit Card', 1, 100.00, TRUE, 123456),
    ('Credit Card', 2, 50.00, TRUE, 789012),
    ('Bank Transfer', 3, 75.00, TRUE, 345678),
    ('Bank Transfer', 1, 150.00, TRUE, 456789),
    ('Credit Card', 3, 75.00, TRUE, 901234);

-- Insert statement for CreditCard table
INSERT INTO
    CreditCard (
        -- CardID,
        UserID,
        -- SetDefault,
        CardNumber,
        ExpiryDate,
        CardHolderName,
        CVC
    )
VALUES
    (
        1,
        '1234567890123456',
        '2025-12-01',
        'john_doe',
        123
    ),
    (
        1,
        '9876543210987654',
        '2024-10-01',
        'john_doe',
        456
    ),
    (
        2,
        '1111222233334444',
        '2026-06-01',
        'jane_smith',
        789
    ),
    (
        3,
        '4444333322221111',
        '2025-08-01',
        'mike_jones',
        246
    );

-- Insert statement for BankTransfer table
INSERT INTO
    BankTransfer (
        -- BankID,
        UserID,
        -- SetDefault,
        BankName,
        AccountHolderName,
        AccountNumber
    )
VALUES
    (2, 'Bank X', 'jane_smith', '1234567890123456'),
    (3, 'Bank Y', 'mike_jones', '9876543210987654'),
    (1, 'Bank Z', 'john_doe', '9876123456789012');

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