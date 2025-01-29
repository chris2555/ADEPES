const express = require('express');
const { Sequelize } = require('sequelize');
const mysql2 = require('mysql2/promise');

// Crear un pool de conexiones a la base de datos
const pool = mysql2.createPool({
  host: 'bd-fr-adepes-do-user-18789085-0.h.db.ondigitalocean.com',
  user: 'doadmin',
  password: 'AVNS_kMsb7qSbM-yNHZOmm2z',
  database: 'defaultdb',
  port: 25060,
});

// Crear una instancia de Sequelize para interactuar con la base de datos
const sequelize = new Sequelize('defaultdb', 'doadmin', 'AVNS_kMsb7qSbM-yNHZOmm2z', {
  dialect: 'mysql',
  host: 'bd-fr-adepes-do-user-18789085-0.h.db.ondigitalocean.com',
  pool: {
    max: 5,
    min: 0,
    acquire: 6000000, // 10 minutos
    idle: 2000000  
  }
});

// Prueba de conexión
sequelize.authenticate()
  .then(() => {
    console.log('Conexión a la base de datos establecida');
  })
  .catch(err => {
    if (err.original && err.original.code === 'ETIMEDOUT') {
    
    } else {
      console.error('Error al conectar a la base de datos:', err);
    }
  });

const app = express();
const port = process.env.PORT || 3000;

// Middleware para JSON (opcional si luego agregas POST o PUT)
app.use(express.json());

// Exportar el pool de conexiones
module.exports = { pool };

const equiposRoutes = require('./routes/equipos');
app.use(equiposRoutes);

// Ruta principal
app.get('/', (req, res) => {
  res.send('¡Hola desde tu API Node.js!');
});

// Iniciar servidor
app.listen(port, () => {
  console.log(`Servidor escuchando en el puerto ${port}`);
});
