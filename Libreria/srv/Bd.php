<?php

class Bd
{
 private static ?PDO $pdo = null;

 static function pdo(): PDO
 {
  if (self::$pdo === null) {

   self::$pdo = new PDO(
    // cadena de conexión
    "sqlite:srvbd.db",
    // usuario
    null,
    // contraseña
    null,
    // Opciones: pdos no persistentes y lanza excepciones.
    [PDO::ATTR_PERSISTENT => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
   );

   // Crear la tabla LIBRO
   self::$pdo->exec(
    "CREATE TABLE IF NOT EXISTS LIBRO (
      LIBRO_ID INTEGER,
      LIBRO_NOMBRE TEXT NOT NULL,
      LIBRO_AUTOR TEXT NOT NULL,
      LIBRO_GENERO TEXT NOT NULL,

      CONSTRAINT LIBRO_PK
       PRIMARY KEY(LIBRO_ID),

      CONSTRAINT LIBRO_NOM_UNQ
       UNIQUE(LIBRO_NOMBRE),

      CONSTRAINT LIBRO_NOM_NV
       CHECK(LENGTH(LIBRO_NOMBRE) > 0),
       
      CONSTRAINT LIBRO_AUTOR_NV
       CHECK(LENGTH(LIBRO_AUTOR) > 0),
       
      CONSTRAINT LIBRO_GENERO_NV
       CHECK(LENGTH(LIBRO_GENERO) > 0)
     )"
   );
  }

  return self::$pdo;
 }
}
