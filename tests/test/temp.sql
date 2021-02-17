Create Table if not exists Driver (
    name VARCHAR(50),
    phone int,
    address VARCHAR(50)
);

Create Table if not exists Car (
    name VARCHAR(50),
    family VARCHAR(50)
);

Create Table if not exists Ride (
    ID int primary key,
    source VARCHAR(50),
    destination VARCHAR(50),
    distance int
);

Create Table if not exists City (
    ID int primary key,
    name VARCHAR(50),
    tier int
);

Create Table if not exists Drive (
    driver_name VARCHAR(50),
    driver_phone int,
    car_name VARCHAR(50)
);

Create Table if not exists Take (
    driver_name VARCHAR(50),
    driver_phone int,
    ride_ID int
);

Create Table if not exists Live (
    driver_name VARCHAR(50),
    driver_phone int,
    city_id int
);

Create Table if not exists In (
    ride_ID int,
    city_ID int
);