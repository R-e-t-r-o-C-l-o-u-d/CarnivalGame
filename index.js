
var mysql = require('mysql');
const { v4: uuidv4 } = require('uuid');
const fs = require('fs');


var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "gamecarnival"
});

var express = require('express');
var bodyParser = require('body-parser');
const { response } = require('express');

var app = express();

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));
console.log("up and running")
/*
app.post("/data", (req, res) => {
  //req.body.name (format)
  fucking = uuidv4()
  console.log(req.body.name)
    con.query(`SELECT * FROM personer WHERE namn LIKE "${fucking}" LIMIT 1`, function(err, row) { //yes this is dumb and is not needed anymore
      //but i will not spend the 1 minute it takes to quickly rewrite some of this shit so instead fuck it we ball 6969 none of this is my fault the other people changed the fucking requirements
      //this can also be changed easily if u want to change peoples score
    if(err) {
        console.log('Error in DB');
        console.log(row)
        if (err) throw err;
        return;
    } else {
        if (row && row.length ) {
          console.log('Case row was found!');
            if(req.body.score > row[0].SCORE){
             var sql = `UPDATE personer SET score = '${req.body.score}' WHERE namn = '${req.body.name}'`;
              con.query(sql, function (err, result) {
              if (err) throw err;
            console.log(result.affectedRows + " record(s) updated"); //checks if the new score is bigger than the last, if not it doesnt update
  });
           } else {
            console.log("No rows updated, score not higher than last")
          }


      } else {
            console.log('No case row was found :( !');
            var sql = `INSERT INTO personer (namn, score, rfid) VALUES ("${req.body.name}", ${req.body.score}, "${fucking}")`;
          con.query(sql, function (err, result) {
    if (err) throw err;
    console.log(result.affectedRows + " record inserted") //creates a new entry in db and throws error if something happens
  });
        }
    }
});
res.end('done')//response to post request
});*/ //deprecated feauture because the shitlings in my group decided to redo it for no reason, god kill me


app.post("/beta", (req, res) => {

  var content = req.body.name
console.log(req.body.name)



fs.writeFile('namefile.txt', content, err => {
  if (err) {
    console.error(err);
  }
});
res.redirect(301, 'http://localhost:8080/arduino.php')


})

// Server listening to PORT 3000
app.listen(3000);
