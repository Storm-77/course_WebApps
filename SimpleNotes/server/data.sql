
DROP TABLE IF EXISTS users;
CREATE TABLE users(
    Id int not null auto_increment primary key,
    Login varchar(40),
    Passwd varchar(255)
);

DROP TABLE IF EXISTS notes;
CREATE TABLE notes(
    Id int not null auto_increment primary key,
    UserID int not null,
    Date date not null default CURRENT_TIMESTAMP,
    Title varchar(255),
    Content text
);

-- default user
-- password : 123
INSERT INTO users (Login, Passwd) VALUES ("admin", "40bd001563085fc35165329ea1ff5c5ecbdbbeef");