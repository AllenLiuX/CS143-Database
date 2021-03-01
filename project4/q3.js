db.laureates.aggregate([
    { $group : { _id: "$familyName.en", count: {$sum: 1}}},
    { $match : {count: {"$gt": 4}, "_id": {"$ne": null}}},
    {$addFields: {familyName: "$_id"}},
    {$project: { _id: 0, familyName: 1}},
]).pretty()