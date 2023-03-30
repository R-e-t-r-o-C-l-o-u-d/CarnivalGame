
var mysql = require('mysql');

var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "",
  database: "gamecarnival"
});

var express = require('express');
var bodyParser = require('body-parser');

var app = express();

app.use(bodyParser.json());
app.use(bodyParser.urlencoded({ extended: false }));

app.post("/data", (req, res) => {
  //req.body.name (format)
  console.log(req.body.name)
    con.query(`SELECT * FROM personer WHERE namn LIKE "${req.body.name}" LIMIT 1`, function(err, row) {

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
            var sql = `INSERT INTO personer (namn, score) VALUES ("${req.body.name}", ${req.body.score})`;
          con.query(sql, function (err, result) {
    if (err) throw err;
    console.log(result.affectedRows + " record inserted") //creates a new entry in db and throws error if something happens
  });
        }
    }
});
res.end('done')//response to post request
});

// Server listening to PORT 3000
app.listen(3000);
