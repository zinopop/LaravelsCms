var mysql = require('mysql');
var pool = mysql.createPool({
    host     : 'localhost',
    user     : 'root',
    password : 'root',
    port: '3306',
    database: 'laraveltest',
    connectionLimit:10,
    //queueLimit:20
});

function query(sql,callback){
    pool.getConnection(function(err,connection){
        connection.query(sql, function (err,rows) {
            callback(err,rows);
            connection.release();
        });
    });
}
exports.query = query;