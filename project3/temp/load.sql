DROP TABLE People;
DROP TABLE Organization;
DROP TABLE Prize;
DROP TABLE Affiliation;

CREATE TABLE IF NOT EXISTS People(
    id INT PRIMARY KEY,
    givenName VARCHAR(100),
    familyName VARCHAR(100),
    gender VARCHAR(20),
    birthDate VARCHAR(20),
    birthCity VARCHAR(100),
    birthCountry VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS Organization(
    id INT PRIMARY KEY,
    orgName VARCHAR(100),
    foundDate VARCHAR(20),
    foundCity VARCHAR(100),
    foundCountry VARCHAR(100)
);

CREATE TABLE IF NOT EXISTS Prize(
    id INT,
    seq INT,
    awardYear VARCHAR(100),
    category VARCHAR(100),
    sortOrder VARCHAR(20),
    portion VARCHAR(20),
    prizeStatus VARCHAR(20),
    dateAwarded VARCHAR(20),
    motivation VARCHAR(200),
    prizeAmount int
);

CREATE TABLE IF NOT EXISTS Affiliation(
    id INT,
    seq INT,
    name VARCHAR(100),
    city VARCHAR(100),
    country VARCHAR(100)
);

LOAD DATA LOCAL INFILE 'people.del' INTO TABLE People FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';
LOAD DATA LOCAL INFILE 'organization.del' INTO TABLE Organization FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';
LOAD DATA LOCAL INFILE 'prize.del' INTO TABLE Prize FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';
LOAD DATA LOCAL INFILE 'affiliation.del' INTO TABLE Affiliation FIELDS TERMINATED BY ',' OPTIONALLY ENCLOSED BY '"';


