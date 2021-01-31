SELECT Actor.first, Actor.last FROM Movie JOIN MovieActor
    ON Movie.id=MovieActor.mid JOIN Actor ON MovieActor.aid=Actor.id WHERE Movie.title='Die Another Day' ;

# SELECT * FROM MovieActor JOIN Actor ON MovieActor.aid=Actor.id where Actor.first='Judi';
# SELECT * FROM MovieActor, Actor where MovieActor.aid=Actor.id and Actor.first='Judi';
# mysql cs143 < q1.sql