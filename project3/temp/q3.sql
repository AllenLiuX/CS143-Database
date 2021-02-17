SELECT familyName FROM People, Prize WHERE People.id=Prize.id group by familyName HAVING count(*)>=5;
