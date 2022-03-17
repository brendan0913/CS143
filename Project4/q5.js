db.laureates.aggregate(
    { $match : { orgName : { $exists: true }}},
    { $unwind : '$nobelPrizes'},
    { $group : { _id : { year : "$nobelPrizes.awardYear" }}},
    { $count : "years" }
)
