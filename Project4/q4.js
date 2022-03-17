db.laureates.aggregate(
    { $unwind : '$nobelPrizes'},
    { $unwind : '$nobelPrizes.affiliations'},
    { $match : { "nobelPrizes.affiliations.name.en" : "University of California" }},
    { $group : { _id : { name : "$nobelPrizes.affiliations.name.en",
                        location : "$nobelPrizes.affiliations.locationString.en"}}},
    { $count : "locations" }
)
