db.laureates.aggregate([
    { $group : { _id: "$nobelPrizes.affiliations"}},
    { $unwind: "$_id"},
    { $unwind: "$_id"},
    { $match : { "_id.name.en": "CERN"}},
    { $group : { _id:{country: "$_id.country.en"}}},
    {$addFields: {"country": "$_id.country"}},
    {$project: { _id: 0, country: 1}},
]).pretty()
//
// db.laureates.aggregate([
//     { $match : { "nobelPrizes.affiliations.name.en": "CERN"}},
//     { $group : { _id: "$nobelPrizes.affiliations"}},
//     { $unwind: "$_id"},
//     { $unwind: "$_id"},
//     { $match : { "_id.name.en": "CERN"}},
//     { $group : { _id:{country: "$_id.country.en"}}},
//     {$addFields: {"country": "$_id.country"}},
//     {$project: { _id: 0, country: 1}},
// ]).pretty()