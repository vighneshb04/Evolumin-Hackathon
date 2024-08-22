const express = require('express');
const mysql = require('mysql');
const bodyParser = require('body-parser');
const path = require('path');
const hbs = require('hbs');
const app = express();

const connection = mysql.createConnection({
    host: 'localhost',
    user: 'admin',
    password: 'aadi4321',
    database: 'alerts'
});

connection.connect(err => {
    if (err) {
        console.error('Error connecting to MySQL:', err.stack);
        return;
    }
    console.log('Connected to MySQL as ID', connection.threadId);
});

app.use(express.static(path.join(__dirname, 'views')));
app.use(bodyParser.urlencoded({ extended: false }));
app.use(bodyParser.json());

app.set('view engine', 'hbs');
app.set('views', path.join(__dirname, 'views')); 
hbs.registerPartials(path.join(__dirname, 'views', 'partials')); 

// Fetch and render current alerts
app.get('/', (req, res) => {
    const sql = 'SELECT * FROM student_alerts';

    connection.query(sql, (err, results) => {
        if (err) {
            console.error('Error retrieving alerts:', err.stack);
            return res.status(500).send('An error occurred while retrieving alerts.');
        }

        res.render('isolation', { alerts: results });
    });
});

// Handle alert creation
app.post('/alerts', (req, res) => {
    const { student_name, student_id, student_class, alert_message } = req.body;

    if (!student_name || !student_id || !student_class || !alert_message) {
        return res.status(400).send('All fields are required.');
    }

    const sql = 'INSERT INTO student_alerts (student_name, student_id, student_class, alert_message) VALUES (?, ?, ?, ?)';

    connection.query(sql, [student_name, student_id, student_class, alert_message], (err, result) => {
        if (err) {
            console.error('Error inserting into MySQL:', err.stack);
            return res.status(500).send('An error occurred while creating the alert.');
        }

        console.log('Alert created successfully with ID:', result.insertId);
        res.redirect('/');
    });
});

// Handle alert deletion
app.post('/alerts/delete/:id', (req, res) => {
    const { id } = req.params;

    const sql = 'DELETE FROM student_alerts WHERE id = ?';

    connection.query(sql, [id], (err, result) => {
        if (err) {
            console.error('Error deleting alert:', err.stack);
            return res.status(500).send('An error occurred while deleting the alert.');
        }

        console.log('Alert deleted successfully');
        res.redirect('/');
    });
});

const port = 3000; 
app.listen(port, () => {
    console.log(`Server running at http://localhost:${port}/`);
});
