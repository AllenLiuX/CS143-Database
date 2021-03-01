db.laureates.aggregate([
    { $match : { "orgName": {$ne: null}}},
    { $group : { _id: "$nobelPrizes.awardYear"}},
    { $unwind: "$_id"},
    { $group : { _id: "$_id"}},
    { $group : { _id: null, years: {$sum: 1}}},
    {$project: { _id: 0, years: 1}},
]).pretty()