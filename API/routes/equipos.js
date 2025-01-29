const express = require('express');
const router = express.Router();
const { pool } = require('../index'); 

// Ruta para obtener equipos
router.get('/equipos', (req, res) => {
  res.send('Equipos');
});

// Ruta para obtener usuarios
router.get('/usuarios', async (req, res) => {
    try {
      // Consulta SQL para obtener todos los usuarios
      const [rows] = await pool.query('SELECT * FROM users');
      res.json(rows); // Devuelve los usuarios en formato JSON
    } catch (error) {
      res.status(500).send('Error al obtener usuarios: ' + error.message);
    }
  });
module.exports = router;
