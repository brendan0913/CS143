db.laureates.aggregate(
    { $unwind : "$familyName" },
    { $group : { _id : "$familyName.en", count : { $sum : 1 }}},
    { $match: { "count": { "$gte" : 5 }}},
    { $project : { _id : 0, "familyName" : "$_id"}}
)