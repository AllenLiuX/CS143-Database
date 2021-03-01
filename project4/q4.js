db.laureates.aggregate([
    { $group : { _id: "$nobelPrizes.affiliations"}},
    { $unwind: "$_id"},
    { $unwind: "$_id"},
    { $match : { "_id.name.en": "University of California"}},
    { $group : { _id: "$_id.city.en"}},
    { $group : { _id: null, locations: {$sum: 1}}},
    {$project: { _id: 0, locations: 1}},
]).pretty()