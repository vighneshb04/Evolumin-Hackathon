const express=require('express');
const mysql=require('mysql');
const bodyParser=require('body-parser');
const path=require('path');
const hbs=require('hbs');

const app=express();

const connection=mysql.createConnection({
    host:'localhost',
    user:'admin',
    password:'aadi4321',
    database:'storedlocation'
});

connection.connect(err =>{
    if(err){
        console.error('Error connecting to MySQL:', err.stack);
        return;
    }
    console.log('Connected to MySQL as ID', connection.threadId);
});
app.use(express.static(path.join(__dirname, 'views')));
app.use(bodyParser.urlencoded({extended: false}));
app.use(bodyParser.json());

app.set('view engine', 'hbs');
app.set('views', path.join(__dirname, 'views')); 
hbs.registerPartials(path.join(__dirname, 'views', 'partials')); 

app.get('/',(req, res) =>{
    res.render('homepage');
});

app.get('/index',(req,res)=>{
    res.render('index');
});

app.get('/authenticate',(req,res)=>{
    res.render('authenticate');
});

app.get('/submit',(req, res)=>{
    const username=req.query.username;
    const password=req.query.password;

    if (username==='admin' && password==='password') {
    
        res.redirect('/index');
    } else {
        res.redirect('/?error=authentication_failed');
    }
});

app.post('/location',(req, res) => {
    const {name, vehicle_number, latitude, longitude}=req.body;

    if (name && vehicle_number && latitude && longitude){
        const query = 'INSERT INTO locations (name,vehicle_number,latitude,longitude)VALUES (?,?,?,?)';
        connection.query(query, [name,vehicle_number,latitude,longitude],(err, results) =>{
              if(err){
                console.error('Error inserting into MySQL:', err.stack);
                res.status(500).send('Error inserting into database');
                return;
            }
            res.status(200).send('Location data inserted');
        });
    } else {
        res.status(400).send('Invalid data');
    }
});


app.get('/drivers',(req, res)=>{
    const query='SELECT name, vehicle_number, latitude, longitude FROM locations';
    connection.query(query, (err, results)=>{
        if (err){
            console.error('Error fetching data from MySQL:', err.stack);
            res.status(500).send('Error fetching data from database');
            return;
        }
        res.render('drivers',{ drivers: results });
    });
});

app.get('/map',(req, res)=>{
    const { latitude,longitude}=req.query;
    res.render('map',{ latitude,longitude});
});

app.use(express.static('public'));

const port=3000; 
app.listen(port,()=>{
    console.log(`Server running at http://localhost:${port}/`);
});
