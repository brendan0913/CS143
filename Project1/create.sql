USE class_db;

CREATE TABLE Movie(id INT PRIMARY KEY NOT NULL,
                   title VARCHAR(100) NOT NULL, 
                   year INT, 
                   rating VARCHAR(10),
                   company VARCHAR(50));

CREATE TABLE Actor(id INT PRIMARY KEY NOT NULL,
                   last VARCHAR(20),
                   first VARCHAR(20),
                   sex VARCHAR(6),
                   dob DATE NOT NULL,
                   dod DATE,
                   CHECK(dod IS NULL OR dob <= dod));

CREATE TABLE MovieGenre(mid INT NOT NULL,
                        genre VARCHAR(20) NOT NULL);

CREATE TABLE MovieActor(mid INT NOT NULL, 
                        aid INT NOT NULL,
                        role VARCHAR(50));

CREATE TABLE Review(name VARCHAR(20),
                    time DATETIME, 
                    mid INT NOT NULL, 
                    rating INT, 
                    comment TEXT,
                    CHECK(rating > 1 AND rating < 6));