// import fs module to read/write file
const fs = require('fs');

// load JSON data
let file = fs.readFileSync("/home/cs143/data/nobel-laureates.json");
let data = JSON.parse(file);

var stream = fs.createWriteStream("laureates.import", {flags:'a'});

data.laureates.forEach(laureate => {
    stream.write(JSON.stringify(laureate) + "\n")
})