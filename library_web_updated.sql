CREATE DATABASE library;
use library;

CREATE TABLE branches (
  branchID int NOT NULL AUTO_INCREMENT,
  branchName varchar(99) NOT NULL,
  address varchar(99) NOT NULL,
  phone varchar(20) DEFAULT NULL,
  PRIMARY KEY (branchID)
);

CREATE TABLE books (
  bookID int NOT NULL AUTO_INCREMENT,
  title varchar(99) NOT NULL,
  author varchar(99) DEFAULT NULL,
  pubYear year DEFAULT NULL,
  publisher varchar(99) DEFAULT NULL,
  isbn varchar(99) DEFAULT NULL,
  copiesAvailable int DEFAULT 1,
  available boolean default true,
  branchID int,
  PRIMARY KEY (bookID),
  FOREIGN KEY(branchID) references branches(branchID)
);

CREATE TABLE patrons(
  patronID int NOT NULL AUTO_INCREMENT,
  password varchar(99) NOT NULL,
  firstName varchar(99) NOT NULL,
  lastName varchar(99) NOT NULL,
  address varchar(99) NOT NULL,
  phone varchar(20) DEFAULT NULL,
  hasFines boolean DEFAULT false,
  PRIMARY KEY (patronID)
);

CREATE TABLE loans (
  loanID int  NOT NULL AUTO_INCREMENT,
  bookID int,
  branchID int,
  patronID int,
  loanDate date NOT NULL,
  dueDate date NOT NULL,
  returnDate date,
  PRIMARY KEY (loanID),
  foreign key(bookID) references books(bookID)
  on update cascade on delete set null,
  foreign key(branchID) references branches(branchID)
  on update cascade on delete set null,
  foreign key(patronID) references patrons(patronID)
  on update cascade on delete set null
);

CREATE TABLE fines (
  fineID int  NOT NULL AUTO_INCREMENT,
  loanID int,
  fineAmount decimal(8,2) NOT NULL,
  fineDate date NOT NULL,
  paid boolean default false,
  PRIMARY KEY (fineID),
  foreign key(loanID) references loans(loanID)
  on update cascade on delete set null
  );
  
CREATE TABLE periodicals (
  periodicalID int NOT NULL AUTO_INCREMENT,
  title varchar(99) NOT NULL,
  publisher varchar(99) DEFAULT NULL,
  pubYear year DEFAULT NULL,
  isbn varchar(99) DEFAULT NULL,
  branchID int,
  PRIMARY KEY (periodicalID),
  FOREIGN KEY(branchID) references branches(branchID)
);

CREATE TABLE holds (
    holdID INT  NOT NULL AUTO_INCREMENT,
    bookID INT,
    branchID INT,
    patronID INT,
    holdDate DATE NOT NULL,
    PRIMARY KEY (holdID),
	foreign key(bookID) references books(bookID)
	on update cascade on delete set null,
	foreign key(branchID) references branches(branchID)
	on update cascade on delete set null,
	foreign key(patronID) references patrons(patronID)
	on update cascade on delete set null
);

CREATE TABLE transfers (
  transferID INT NOT NULL AUTO_INCREMENT,
  bookID INT,
  fromBranchID INT,
  toBranchID INT,
  transferDate DATE NOT NULL,
  PRIMARY KEY (transferID),
  foreign key(bookID) references books(bookID)
  on update cascade on delete set null,
  foreign key(fromBranchID) references branches(branchID)
  on update cascade on delete set null,
  foreign key(toBranchID) references branches(branchID)
  on update cascade on delete set null
  );
  
CREATE TABLE videos (
  videoID int  NOT NULL AUTO_INCREMENT,
  title varchar(99) NOT NULL,
  director varchar(99) DEFAULT NULL,
  releaseYear year DEFAULT NULL,
  format varchar(99) DEFAULT NULL,
  branchID int,
  PRIMARY KEY (videoID),
  FOREIGN KEY(branchID) references branches(branchID)
);

CREATE TABLE cds (
  cdID int  NOT NULL AUTO_INCREMENT,
  title varchar(99) NOT NULL,
  artist varchar(99) DEFAULT NULL,
  releaseYear year DEFAULT NULL,
  genre varchar(99) DEFAULT NULL,
  branchID int,
  PRIMARY KEY (cdID),
  FOREIGN KEY(branchID) references branches(branchID)
);

CREATE TABLE video_loans (
  loanID int  NOT NULL AUTO_INCREMENT,
  videoID int,
  branchID int,
  patronID int,
  loanDate date NOT NULL,
  dueDate date NOT NULL,
  returnDate date,
  PRIMARY KEY (loanID),
  foreign key(videoID) references videos(videoID)
  on update cascade on delete set null,
  foreign key(branchID) references branches(branchID)
  on update cascade on delete set null,
  foreign key(patronID) references patrons(patronID)
  on update cascade on delete set null
);

CREATE TABLE cd_loans (
  loanID int  NOT NULL AUTO_INCREMENT,
  cdID int,
  branchID int,
  patronID int,
  loanDate date NOT NULL,
  dueDate date NOT NULL,
  returnDate date,
  PRIMARY KEY (loanID),
  foreign key(cdID) references cds(cdID)
  on update cascade on delete set null,
  foreign key(branchID) references branches(branchID)
  on update cascade on delete set null,
  foreign key(patronID) references patrons(patronID)
  on update cascade on delete set null
);

CREATE TABLE admins(
  adminID int NOT NULL AUTO_INCREMENT,
  password varchar(99) NOT NULL,
  firstName varchar(99) NOT NULL,
  lastName varchar(99) NOT NULL,
  address varchar(99) NOT NULL,
  phone varchar(20) DEFAULT NULL,
  PRIMARY KEY (adminID)
);

DELIMITER $$
CREATE TRIGGER UpdateAvailableAfterLoan
AFTER INSERT ON loans
FOR EACH ROW
BEGIN
    UPDATE books b
    SET b.available = (b.copiesAvailable - 1) > 0
    WHERE b.bookID = NEW.bookID;
END $$
DELIMTER ;

DELIMITER $$
CREATE TRIGGER UpdateAvailableAfterHold
AFTER INSERT ON holds
FOR EACH ROW
BEGIN
    UPDATE books b
    SET b.available = (b.copiesAvailable - 1) > 0
    WHERE b.bookID = NEW.bookID;
END $$
DELIMTER ;

DELIMITER $$
CREATE TRIGGER MaxBookOnLoan
BEFORE INSERT ON loans
FOR EACH ROW
BEGIN
    DECLARE loan_count INT;
    SELECT COUNT(*) INTO loan_count FROM loans WHERE patronID = NEW.patronID AND returnDate IS NULL;
    IF loan_count >= 5 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'This patron has already loaned 5 books.';
    END IF;
END $$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER UpdateCopiesAfterLoan
AFTER INSERT ON loans
FOR EACH ROW
BEGIN
    UPDATE books b
    SET b.copiesAvailable = b.copiesAvailable - 1
    where b.bookID = NEW.bookID;
END $$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER UpdateCopiesAfterHold
AFTER INSERT ON holds
FOR EACH ROW
BEGIN
    UPDATE books b
    SET b.copiesAvailable = b.copiesAvailable - 1
    where b.bookID = NEW.bookID;
END $$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER PreventLoanDueToFines
BEFORE INSERT ON loans
FOR EACH ROW
BEGIN
	declare has_fines boolean;
    SELECT hasFines into has_fines from patrons where patronID = NEW.patronID; 
    IF has_fines = true THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'This patron cannot borrow because patron has fines.';
    END IF;
END $$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER PreventHoldDueToFines
BEFORE INSERT ON holds
FOR EACH ROW
BEGIN
	DECLARE has_fines boolean;
    SELECT hasFines into has_fines from patrons where patronID = NEW.patronID; 
    IF has_fines = true THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'This patron cannot borrow because patron has fines.';
    END IF;
END $$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER IncrementFineAmount
AFTER UPDATE ON loans
FOR EACH ROW
BEGIN
    DECLARE weeks_overdue INT;
    SET weeks_overdue = TIMESTAMPDIFF(WEEK, NEW.dueDate, NEW.returnDate);
    IF weeks_overdue > 0 THEN
        UPDATE fines SET fineAmount = fineAmount + weeks_overdue WHERE loanID = NEW.loanID;
    END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER CheckAvailableBeforeLoan
BEFORE INSERT ON loans
FOR EACH ROW
BEGIN
	DEClARE available int;
    SELECT copiesAvailable into available from books where bookID = NEW.bookID; 
    IF available = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No copies available. Loan failed.';
    END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER CheckAvailableBeforeHold
BEFORE INSERT ON holds
FOR EACH ROW
BEGIN
	DEClARE available int;
    SELECT copiesAvailable into available from books where bookID = NEW.bookID; 
    IF available = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No copies available. Holding request failed.';
    END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER CheckAvailableBeforeTransfer
BEFORE INSERT ON transfers
FOR EACH ROW
BEGIN
	DEClARE available int;
    SELECT copiesAvailable into available from books where bookID = NEW.bookID; 
    IF available = 0 THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'No copies available. You cannot transfer selected book.';
    END IF;
END$$
DELIMITER ;

DELIMITER $$
CREATE TRIGGER UpdateFines
AFTER INSERT ON fines
FOR EACH ROW
BEGIN
	DECLARE has_fines boolean;
    SELECT hasFines into has_fines from patrons where patronID = NEW.patronID; 
    IF has_fines = true THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'This patron cannot borrow because patron has fines.';
    END IF;
END;
DELIMITER ;

INSERT INTO branches (branchID, branchName, address, phone)
VALUES
(1, 'Main Branch', '123 Main St', '555-1234'),
(2, 'Downtown Branch', '456 1st Ave', '555-5678'),
(3, 'Westside Branch', '789 Oak St', '555-9012'),
(4, 'Eastside Branch', '321 Elm St', '555-3456'),
(5, 'Northside Branch', '654 Pine St', '555-7890');
 
INSERT INTO books (BookID, Title, Author, PubYear, Publisher, ISBN, CopiesAvailable, Available, BranchID)
VALUES
(1234567891, 'The Catcher in the Rye', 'J.D. Salinger', 1951, 'Little, Brown and Company', '9780316769174', 3, true, 1),
(1234567892, 'To Kill a Mockingbird', 'Harper Lee', 1960, 'J.B. Lippincott & Co.', '9780446310789', 2, true, 3),
(1234567893, '1984', 'George Orwell', 1949, 'Secker & Warburg', '9780451524935', 1, true, 5),
(1234567894, 'The Great Gatsby', 'F. Scott Fitzgerald', 1925, 'Charles Scribners Sons', '9780743273565', 1, true, 4),
(1234567895, 'Pride and Prejudice', 'Jane Austen', 1901, 'T. Egerton, Whitehall', '9780486284736', 5, true, 2);

INSERT INTO patrons (patronID, password, firstName, lastName, address, phone)
VALUES
(1, 'J1','John', 'Doe', '123 Main St', '555-1234'),
(2, 'J2', 'Jane', 'Smith', '456 1st Ave', '555-5678'),
(3, 'B1', 'Bob', 'Johnson', '789 Oak St', '555-9012'),
(4, 'S1', 'Sarah', 'Williams', '321 Elm St', '555-3456'),
(5, 'M1', 'Mike', 'Davis', '654 Pine St', '555-7890');

INSERT INTO periodicals (periodicalID, title, publisher, pubYear, isbn)
VALUES
(1, 'Time', 'Time Inc.', 2022, '9781547843210'),
(2, 'National Geographic', 'National Geographic Society', 2022, '9781426252000'),
(3, 'The New Yorker', 'Condé Nast', 2022, '9781087698558'),
(4, 'Sports Illustrated', 'Maven Coalition, LLC', 2022, '9781547845429'),
(5, 'Scientific American', 'Springer Nature', 2022, '9781547851239');

INSERT INTO cds (cdID, title, artist, releaseYear, genre, branchID)
VALUES
(1, 'Beethoven: Symphony No. 5', 'Ludwig van Beethoven', 2010, 'Classical', 1),
(2, 'Mozart: Requiem', 'Wolfgang Amadeus Mozart', 2005, 'Classical', 2),
(3, 'Bach: Brandenburg Concertos', 'Johann Sebastian Bach', 2008, 'Classical', 3),
(4, 'Vivaldi: The Four Seasons', 'Antonio Vivaldi', 2003, 'Classical', 4),
(5, 'Chopin: Nocturnes', 'Frederic Chopin', 2012, 'Classical', 5);

INSERT INTO videos (videoID, title, director, releaseYear, format, branchID)
VALUES
(1, 'The Thin Blue Line', 'Errol Morris', 1988, 'DVD', 1),
(2, 'Man on Wire', 'James Marsh', 2008, 'Blu-ray', 2),
(3, 'Jiro Dreams of Sushi', 'David Gelb', 2011, 'DVD', 3),
(4, 'The Act of Killing', 'Joshua Oppenheimer', 2012, 'Blu-ray', 4),
(5, 'Won\'t You Be My Neighbor?', 'Morgan Neville', 2018, 'DVD', 5);

INSERT INTO admins (password, firstName, lastName, address, phone) 
VALUES 
('password123', 'Tony', 'Stark', '10880 Malibu Point', '555-123-4567'), 
('adminpass', 'Steve', 'Rogers', '569 Leaman Place', '555-234-5678'), 
('securepw', 'Natasha', 'Romanoff', '443 Black Widow Lane', NULL), 
('password456', 'Thor', 'Odinson', 'Asgard', '555-345-6789');

-- insert into holds values (1, 1234567891, 1, 2, '2022-05-09');

 
