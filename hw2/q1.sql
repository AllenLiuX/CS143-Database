# SELECT company_name FROM Work GROUP BY company_name having MIN(salary)>250000;
# SELECT company_name from Work EXCEPT (select company_name from Work where salary<=250000);

# SELECT person_name, SUM(salary) FROM Work
#     WHERE person_name IN (select person_name FROM Employee WHERE city="Los Angeles")
#     GROUP BY person_name;
# SELECT (W.salary) FROM Work W, Employee E Where W.person_name=E.person_name
#     AND W.salary <= ALL

# Problem 2a
WITH All_salaries AS (SELECT W.person_name, SUM(salary) salary_sum FROM Work W, Employee E WHERE W.person_name=E.person_name GROUP BY W.person_name)
select person_name FROM All_salaries where salary_sum > ALL
(SELECT SUM(salary) salary_sum FROM Work W2, Employee E2 WHERE W2.person_name=E2.person_name AND E2.city="Los Angeles" GROUP BY W2.person_name);

WITH All_salaries AS (SELECT W.person_name, SUM(salary) salary_sum FROM Work W, Employee E WHERE W.person_name=E.person_name GROUP BY W.person_name),
Los_salaries AS (SELECT SUM(salary) salary_sum FROM Work W2, Employee E2 WHERE W2.person_name=E2.person_name AND E2.city="Los Angeles" GROUP BY W2.person_name)
select person_name FROM All_salaries EXCEPT (select person_name FROM All_salaries, Los_salaries where All_salaries.salary_sum <= Los_salaries.salary_sum);

SELECT M.manager_name, SUM(salary) salary_sum FROM Manage M, Work W WHERE M.manager_name=W.person_name GROUP BY W.person_name;
SELECT W2.person_name employee_name, SUM(salary) salary_sum FROM Work W2, Employee E2 WHERE W2.person_name=E2.person_name AND E2.city="Los Angeles" GROUP BY W2.person_name;

# Problem 2b
WITH Manager_salaries AS (SELECT M.manager_name, SUM(salary) salary_sum FROM Manage M, Work W WHERE M.manager_name=W.person_name GROUP BY W.person_name),
Em_salaries AS (SELECT person_name employee_name, SUM(salary) salary_sum FROM Work GROUP BY person_name)
select DISTINCT Manage.manager_name, Manager_salaries.salary_sum, Em_salaries.salary_sum FROM Manage
    JOIN Manager_salaries ON Manage.manager_name=Manager_salaries.manager_name
    JOIN Em_salaries ON Manage.person_name=Em_salaries.employee_name
    WHERE Manager_salaries.salary_sum>=Em_salaries.salary_sum;

WITH Manager_salaries AS (SELECT M.manager_name, SUM(salary) salary_sum FROM Manage M, Work W WHERE M.manager_name=W.person_name GROUP BY W.person_name)
select Manage.manager_name, Manager_salaries.salary_sum, Em_salaries.salary_sum FROM Manage
    JOIN Manager_salaries ON Manage.manager_name=Manager_salaries.manager_name
    WHERE Manager_salaries.salary_sum > SOME (SELECT SUM(salary) salary_sum FROM Work GROUP BY person_name);

# Problem 3
SELECT S.name, S.address from MovieStar S WHERE gende='F' INTERSECT (SELECT E.name, E.address from MovieExec WHERE netWorth > 1000000);
#                             , MovieExec E WHERE S.name=E.name AND gender='F' AND netWorth > 1000000
SELECT S.name, S.address from MovieStar S, MovieExec E WHERE S.name=E.name AND gender='F' AND netWorth > 1000000;

SELECT name from MovieStar EXCEPT (select name from MovieExec);
SELECT name from MovieStar WHERE name NOT IN (select name from MovieExec);
SELECT S.name from MovieStar S, MovieExec E WHERE S.name=E.name;

# Problem 4
SELECT AVG(Speed) FROM Desktop;
SELECT AVG(price) FROM CompuuterProduct Where manufacturer="Dell";
SELECT AVG(price) FROM Laptop L, ComputerProduct C Where L.model=C.model AND L.weight>3;
SELECT AVG(price) FROM Laptop L, ComputerProduct C Where L.model=C.model GROUP BY speed;
SELECT manufacturer FROM ComputerProduct WHERE COUNT(model)>=3 GROUP BY manufacturer;

#problem 5
INSERT INTO ComputerProduct VALUES ("HP", 1100, 1000);
INSERT INTO Desktop VALUES (1100, "1.2Ghz", "256MB", "40GB");
DELETE FROM ComputerProduct WHERE model IN (SELECT C.model FROM ComputerProduct C, Desktop D Where C.model=D.model AND manufacturer="IBM" AND price<1000);
DELETE FROM Desktop WHERE model IN (SELECT C.model FROM ComputerProduct C, Desktop D Where C.model=D.model AND manufacturer="IBM" AND price<1000);
UPDATE Laptop SET price = hdd-1 WHERE model IN (SELECT C.model FROM ComputerProduct C, Desktop D Where C.model=D.model AND manufacturer="Gateway");


SELECT MAX(Vincent.Love) FROM VincentHeart Where target="Candice" AND period="forever~";

#     JOIN Em_salaries ON Manage.person_name=Em_salaries.employee_name
#     WHERE Manager_salaries.salary_sum>=Em_salaries.salary_sum;

# select person_name FROM All_salaries EXCEPT (select person_name FROM All_salaries, Los_salaries where All_salaries.salary_sum <= Los_salaries.salary_sum);


# SELECT person_name, salary FROM Work WHERE person_name IN (select person_name FROM Employee WHERE city="Los Angeles");