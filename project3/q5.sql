SELECT count(*) FROM (SELECT category FROM Organization O, Prize P WHERE O.id=P.id group by awardYear) Y;