CREATE TABLE IF NOT EXISTS Employee(
    person_name VARCHAR(50) PRIMARY KEY,
    age int,
    street VARCHAR(50),
    city VARCHAR(50)
);

CREATE TABLE IF NOT EXISTS Work(
    person_name VARCHAR(50),
    company_name VARCHAR(50),
    salary int,
    PRIMARY KEY(person_name, company_name)
);

CREATE TABLE IF NOT EXISTS Company(
    company_name VARCHAR(50),
    city VARCHAR(50),
    PRIMARY KEY(company_name, city)
);

CREATE TABLE IF NOT EXISTS Manage(
    person_name VARCHAR(50),
    manager_name VARCHAR(50)
);