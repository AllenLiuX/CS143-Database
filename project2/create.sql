CREATE TABLE IF NOT EXISTS Movie(
    id INT PRIMARY KEY,
    title VARCHAR(100),
    year INT,
    rating	VARCHAR(10),
    company	VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS Actor(
    id	INT PRIMARY KEY,
    last VARCHAR(20),
    first VARCHAR(20),
    sex	VARCHAR(6),
    dob	DATE,
    dod	DATE
);

CREATE TABLE IF NOT EXISTS Director(
    id INT PRIMARY KEY,
    last VARCHAR(20),
    first VARCHAR(20),
    dob	DATE,
    dod	DATE
);

CREATE TABLE IF NOT EXISTS MovieGenre(
    mid	INT,
    genre VARCHAR(20)
);

CREATE TABLE IF NOT EXISTS MovieDirector(
    mid	INT,
    did INT
);

CREATE TABLE IF NOT EXISTS MovieActor(
    mid	INT,
    aid INT,
    role VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS Review(
    name VARCHAR(20),
    time DATETIME,
    mid	INT,
    rating INT,
    comment TEXT
);
