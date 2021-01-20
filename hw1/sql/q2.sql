SELECT Actor.first, Actor.last FROM Movie JOIN MovieActor
    ON Movie.id=MovieActor.mid JOIN Actor ON MovieActor.aid=Actor.id WHERE Movie.title='Die Another Day' ;