const express = require('express');
const mysql = require('mysql2');
const cors = require('cors');
const multer = require('multer'); // Required to handle file uploads
const path = require('path');

const app = express();
const upload = multer({ dest: 'uploads/' }); // Set the destination for uploaded files

app.use(cors());

const pool = mysql.createPool({
  host: 'localhost',
  user: 'root',
  password: '',
  database: 'chandrayaan4', // Replace with your database name (contact_forms in this case)
  waitForConnections: true,
  connectionLimit: 10,
  queueLimit: 0,
});


app.post('/submit', upload.single('image'), (req, res) => {
  const { name, dob, contact, address, category } = req.body;
  const image = req.file ? req.file.filename : null; // Save the filename of the uploaded image

  // Save the form data to the database
  const sql = 'INSERT INTO contact_forms (name, dob, contact, address, category, image) VALUES (?, ?, ?, ?, ?, ?)';
  const values = [name, dob, contact, address, category, image];

  pool.query(sql, values, (err, results, fields) => {
    if (err) {
      console.error('Error executing query:', err);
      return res.status(500).send('Error saving contact data.');
    }

    return res.status(200).send('Contact data saved successfully.');
  });
});

const PORT = 3000;
app.listen(PORT, () => {
  console.log(`Server started on port ${PORT}`);
});
