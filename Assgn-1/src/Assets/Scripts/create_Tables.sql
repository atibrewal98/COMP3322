Create Table book (
    BookId 			int AUTO_INCREMENT PRIMARY KEY,
    BookName			varchar(100),
    Publisher			varchar(100),
    Category			varchar(100),
    Lang 			varchar(100),
    Author 			varchar(100),
    Description 		varchar(500),
    Price			int,
    Published			varchar(100),
    BookImg			varchar(100)
)



Create Table login(
    UserId		varchar(100) PRIMARY KEY,
    Pwd			varchar(100)
)


Create Table cart(
    CartId		int PRIMARY KEY AUTO_INCREMENT,
    BookId		int,
    CONSTRAINT fk_BookId FOREIGN KEY (BookId) REFERENCES book(BookId),
    UserId		varchar(100),
    CONSTRAINT fk_UserId FOREIGN KEY (UserId) REFERENCES login(UserId),
    Quantity 	int
)