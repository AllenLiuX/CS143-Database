-- # SELECT rating, count(*), avg(year) from Movie group by rating having count(*)>4;
-- SELECT rating, genre from Movie, MovieGenre where Movie.id=MovieGenre.mid;

-- SELECT MIN(year), company from Movie group by Movie.rating having MIN(year)>2000;
SELECT company, year from Movie having MIN(year)>2000;
SELECT company, year from Movie EXCEPT (select company, year from Movie where year<=2002);

