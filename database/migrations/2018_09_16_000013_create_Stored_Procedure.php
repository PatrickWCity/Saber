<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStoredProcedure extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        DROP PROCEDURE IF EXISTS `sp_actualizarModulo`;
        DROP PROCEDURE IF EXISTS `sp_actualizarPerfil`;
        DROP PROCEDURE IF EXISTS `sp_actualizarSubmodulo`;
        DROP PROCEDURE IF EXISTS `sp_actualizarUsuario`;
        DROP PROCEDURE IF EXISTS `sp_agregarModulo`;
        DROP PROCEDURE IF EXISTS `sp_agregarPerfil`;
        DROP PROCEDURE IF EXISTS `sp_agregarSubmodulo`;
        DROP PROCEDURE IF EXISTS `sp_agregarUsuario`;
        DROP PROCEDURE IF EXISTS `sp_asignarModuloAPerfil`;
        DROP PROCEDURE IF EXISTS `sp_asignarSubmoduloAModulo`;
        DROP PROCEDURE IF EXISTS `sp_asignarUsuarioAPerfil`;
        DROP PROCEDURE IF EXISTS `sp_consultarModulosDePerfil`;
        DROP PROCEDURE IF EXISTS `sp_consultarModulosSinPerfil`;
        DROP PROCEDURE IF EXISTS `sp_consultarSubmodulosDeModulo`;
        DROP PROCEDURE IF EXISTS `sp_consultarSubmodulosSinModulo`;
        DROP PROCEDURE IF EXISTS `sp_consultarTodosModulo`;
        DROP PROCEDURE IF EXISTS `sp_consultarTodosUsuario`;
        DROP PROCEDURE IF EXISTS `sp_consultarTodosPerfil`;
        DROP PROCEDURE IF EXISTS `sp_consultarTodosSubmodulo`;
        DROP PROCEDURE IF EXISTS `sp_consultarUnModulo`;
        DROP PROCEDURE IF EXISTS `sp_consultarUnPerfil`;
        DROP PROCEDURE IF EXISTS `sp_consultarUnSubmodulo`;
        DROP PROCEDURE IF EXISTS `sp_consultarUnUsuario`;
        DROP PROCEDURE IF EXISTS `sp_consultarUsuariosDePerfil`;
        DROP PROCEDURE IF EXISTS `sp_consultarUsuariosSinPerfil`;
        DROP PROCEDURE IF EXISTS `sp_desasignarModuloDePerfil`;
        DROP PROCEDURE IF EXISTS `sp_desasignarSubmoduloDeModulo`;
        DROP PROCEDURE IF EXISTS `sp_desasignarUsuarioDePerfil`;
        DROP PROCEDURE IF EXISTS `sp_eliminarModulo`;
        DROP PROCEDURE IF EXISTS `sp_eliminarPerfil`;
        DROP PROCEDURE IF EXISTS `sp_eliminarSubmodulo`;
        DROP PROCEDURE IF EXISTS `sp_eliminarUsuario`;
        ');

        DB::unprepared("

        CREATE PROCEDURE `sp_actualizarModulo`(
            IN `idModulo` INT,
            IN `nombre` VARCHAR(60),
            IN `descripcion` VARCHAR(255)
        )
        BEGIN
        UPDATE Modulo
        SET nombre = nombre, descripcion = descripcion
        WHERE Modulo.idModulo = idModulo;
        END;

        CREATE PROCEDURE `sp_actualizarPerfil`(
            IN `idPerfil` INT,
            IN `nombre` VARCHAR(60),
            IN `descripcion` VARCHAR(255)
        )
        BEGIN
        UPDATE Perfil
        SET nombre = nombre, descripcion = descripcion
        WHERE Perfil.idPerfil = idPerfil;
        END;
        
        CREATE PROCEDURE `sp_actualizarSubmodulo`(
            IN `idSubmodulo` INT,
            IN `nombre` VARCHAR(60),
            IN `descripcion` VARCHAR(255),
            IN `ubicacion` VARCHAR(255)
        )
        BEGIN
        UPDATE Submodulo
        SET nombre = nombre, descripcion = descripcion, ubicacion = ubicacion
        WHERE Submodulo.idSubmodulo = idSubmodulo;
        END;
        
        CREATE PROCEDURE `sp_agregarModulo`(
            IN `nombre` VARCHAR(60),
            IN `descripcion` VARCHAR(255)
        )
        BEGIN
        INSERT INTO Modulo (nombre, descripcion)
        VALUES(nombre, descripcion);
        END;
        
        CREATE PROCEDURE `sp_agregarPerfil`(
            IN `nombre` VARCHAR(60),
            IN `descripcion` VARCHAR(255)
        )
        BEGIN
        INSERT INTO Perfil (nombre, descripcion)
        VALUES(nombre, descripcion);
        END;
        
        CREATE PROCEDURE `sp_agregarSubmodulo`(
            IN `nombre` VARCHAR(60),
            IN `descripcion` VARCHAR(255),
            IN `ubicacion` VARCHAR(255)
        )
        BEGIN
        INSERT INTO Submodulo (nombre, descripcion, ubicacion)
        VALUES(nombre, descripcion, ubicacion);
        END;
        
        CREATE PROCEDURE `sp_asignarModuloAPerfil`(
            IN `idModulo` INT,
            IN `idPerfil` INT
        )
        BEGIN
        INSERT INTO ModuloPerfil(fecha, estado, idModulo, idPerfil)
        VALUES(NOW(), 1, idModulo, idPerfil);
        END;
        
        CREATE PROCEDURE `sp_asignarSubmoduloAModulo`(
            IN `idSubmodulo` INT,
            IN `idModulo` INT
        )
        BEGIN
        INSERT INTO SubmoduloModulo(fecha, estado, idSubmodulo, idModulo)
        VALUES(NOW(6), 1, idSubmodulo, idModulo);
        END;
        
        CREATE PROCEDURE `sp_asignarUsuarioAPerfil`(
            IN `idUsuario` INT,
            IN `idPerfil` INT
        )
        BEGIN
        INSERT INTO PerfilUsuario(fecha, estado, idPerfil, idUsuario)
        VALUES(NOW(6), 1, idPerfil, idUsuario);
        END;
        
        CREATE PROCEDURE `sp_consultarModulosDePerfil`(
            IN `idPerfil` INT
        )
        BEGIN
        SELECT u.idModulo, u.nombre
        FROM Modulo u, ModuloPerfil pu, Perfil p
        WHERE p.idPerfil = idPerfil
        AND p.idPerfil = pu.idPerfil
        AND pu.idModulo = u.idModulo;
        END;
       
        CREATE PROCEDURE `sp_consultarModulosSinPerfil`(
            IN `idPerfil` INT
        )
        BEGIN
        SELECT u.idModulo, u.nombre
        FROM Modulo u
        WHERE u.idModulo NOT IN
        (
        SELECT u.idModulo
        FROM Modulo u, ModuloPerfil pu, Perfil p
        WHERE p.idPerfil = idPerfil
        AND p.idPerfil = pu.idPerfil
        AND pu.idModulo = u.idModulo
        );
        END;
        
        CREATE PROCEDURE `sp_consultarSubmodulosDeModulo`(
            IN `idModulo` INT
        )
        BEGIN
        SELECT u.idSubmodulo, u.nombre
        FROM Submodulo u, SubmoduloModulo pu, Modulo p
        WHERE p.idModulo = idModulo
        AND p.idModulo = pu.idModulo
        AND pu.idSubmodulo = u.idSubmodulo;
        END;
        
        CREATE PROCEDURE `sp_consultarSubmodulosSinModulo`(
            IN `idModulo` INT
        )
        BEGIN
        SELECT u.idSubmodulo, u.nombre
        FROM Submodulo u
        WHERE u.idSubmodulo NOT IN
        (
        SELECT u.idSubmodulo
        FROM Submodulo u, SubmoduloModulo pu, Modulo p
        WHERE p.idModulo = idModulo AND
        p.idModulo = pu.idModulo AND
        pu.idSubmodulo = u.idSubmodulo
        );
        END;
        
        CREATE PROCEDURE `sp_consultarTodosModulo`()
        BEGIN
        SELECT *
        FROM Modulo;
        END;
        
        CREATE PROCEDURE `sp_consultarTodosPerfil`()
        BEGIN
        SELECT *
        FROM Perfil;
        END;
        
        CREATE PROCEDURE `sp_consultarTodosSubmodulo`()
        BEGIN
        SELECT *
        FROM Submodulo;
        END;
        
        CREATE PROCEDURE `sp_consultarUnModulo`(
            IN `idModulo` INT,
            IN `palabraClave` VARCHAR(255)
        )
        BEGIN
        SELECT *
        FROM Modulo 
        WHERE Modulo.idModulo = idModulo
        OR nombre LIKE CONCAT('%',palabraClave,'%')
        OR descripcion LIKE CONCAT('%',palabraClave,'%');
        END;
        
        CREATE PROCEDURE `sp_consultarUnPerfil`(
            IN `idPerfil` INT,
            IN `palabraClave` VARCHAR(255)
        )
        BEGIN
        SELECT *
        FROM Perfil 
        WHERE Perfil.idPerfil = idPerfil
        OR nombre LIKE CONCAT('%',palabraClave,'%')
        OR descripcion LIKE CONCAT('%',palabraClave,'%');
        END;
        
        CREATE PROCEDURE `sp_consultarUnSubmodulo`(
            IN `idSubmodulo` INT,
            IN `palabraClave` VARCHAR(255)
        )
        BEGIN
        SELECT *
        FROM Submodulo 
        WHERE Submodulo.idSubmodulo = idSubmodulo
        OR nombre LIKE CONCAT('%',palabraClave,'%')
        OR descripcion LIKE CONCAT('%',palabraClave,'%')
        OR ubicacion LIKE CONCAT('%',palabraClave,'%');
        END;
        
        CREATE PROCEDURE `sp_consultarUsuariosDePerfil`(
            IN `idPerfil` INT
        )
        BEGIN
        SELECT u.idUsuario, u.nombre, u.appat, u.apmat
        FROM Usuario u, PerfilUsuario pu, Perfil p
        WHERE p.idPerfil = idPerfil
        AND p.idPerfil = pu.idPerfil
        AND pu.idUsuario = u.idUsuario;
        END;

        CREATE PROCEDURE `sp_consultarUsuariosSinPerfil`(
            IN `idPerfil` INT
        )
        BEGIN
        SELECT u.idUsuario, u.nombre, u.appat, u.apmat
        FROM Usuario u
        WHERE u.idUsuario NOT IN
        (
        SELECT u.idUsuario
        FROM Usuario u, PerfilUsuario pu, Perfil p
        WHERE p.idPerfil = idPerfil 
        AND p.idPerfil = pu.idPerfil
        AND pu.idUsuario = u.idUsuario
        );
        END;

        CREATE PROCEDURE `sp_desasignarModuloDePerfil`(
            IN `idModulo` INT,
            IN `idPerfil` INT
        )
        BEGIN
        DELETE FROM ModuloPerfil
        WHERE ModuloPerfil.idModulo=idModulo
        AND ModuloPerfil.idPerfil=idPerfil;
        END;

        CREATE PROCEDURE `sp_desasignarSubmoduloDeModulo`(
            IN `idSubmodulo` INT,
            IN `idModulo` INT
        )
        BEGIN
        DELETE FROM SubmoduloModulo
        WHERE SubmoduloModulo.idModulo=idModulo
        AND SubmoduloModulo.idSubmodulo=idSubmodulo;
        END;

        CREATE PROCEDURE `sp_desasignarUsuarioDePerfil`(
            IN `idUsuario` INT,
            IN `idPerfil` INT
        )
        BEGIN
        DELETE FROM PerfilUsuario
        WHERE PerfilUsuario.idUsuario = idUsuario
        AND PerfilUsuario.idPerfil = idPerfil;
        END;

        CREATE PROCEDURE `sp_eliminarModulo`(
            IN `idModulo` INT
        )
        BEGIN
        DELETE FROM ModuloPerfil
        WHERE ModuloPerfil.idModulo = idModulo;
        DELETE FROM SubmoduloModulo
        WHERE SubmoduloModulo.idModulo = idModulo;
        DELETE FROM Modulo
        WHERE Modulo.idModulo = idModulo;
        END;
        
        CREATE PROCEDURE `sp_eliminarPerfil`(
            IN `idPerfil` INT
        )
        BEGIN
        DELETE FROM ModuloPerfil
        WHERE ModuloPerfil.idPerfil = idPerfil;
        DELETE FROM PerfilUsuario
        WHERE PerfilUsuario.idPerfil = idPerfil;
        DELETE FROM Perfil
        WHERE Perfil.idPerfil = idPerfil;
        END;
        
        CREATE PROCEDURE `sp_eliminarSubmodulo`(
            IN `idSubmodulo` INT
        )
        BEGIN
        DELETE FROM SubmoduloModulo
        WHERE SubmoduloModulo.idSubmodulo = idSubmodulo;
        DELETE FROM Submodulo
        WHERE Submodulo.idSubmodulo = idSubmodulo;
        END;
        
        CREATE PROCEDURE `sp_actualizarUsuario`(
            IN `idUsuario` INT,
            IN `run` VARCHAR(10),
            IN `nombre` VARCHAR(60),
            IN `appat` VARCHAR(60),
            IN `apmat` VARCHAR(60),
            IN `direccion` VARCHAR(255),
            IN `telefono` VARCHAR(20),
            IN `email` VARCHAR(255)
        )
        BEGIN
        UPDATE Usuario
        SET run = run, nombre = nombre, appat = appat, apmat = apmat, direccion = direccion, telefono = telefono, email = email
        WHERE Usuario.idUsuario = idUsuario;
        END;
        
        CREATE PROCEDURE `sp_agregarUsuario`(
            IN `run` VARCHAR(10),
            IN `nombre` VARCHAR(60),
            IN `appat` VARCHAR(60),
            IN `apmat` VARCHAR(60),
            IN `direccion` VARCHAR(255),
            IN `telefono` VARCHAR(20),
            IN `email` VARCHAR(255)
        )
        BEGIN
        INSERT INTO Usuario (run, nombre, appat, apmat, direccion, telefono, email)
        VALUES(run, nombre, appat, apmat, direccion, telefono, email);
        END;
        
        CREATE PROCEDURE `sp_consultarTodosUsuario`()
        BEGIN
        SELECT *
        FROM Usuario;
        END;
        
        CREATE PROCEDURE `sp_consultarUnUsuario`(
            IN `idUsuario` INT,
            IN `palabraClave` VARCHAR(255)
        )
        BEGIN
        SELECT *
        FROM Usuario
        WHERE Usuario.idUsuario = idUsuario
        OR nombre LIKE CONCAT('%',palabraClave,'%')
        OR appat LIKE CONCAT('%',palabraClave,'%')
        OR apmat LIKE CONCAT('%',palabraClave,'%')
        OR email LIKE CONCAT('%',palabraClave,'%');
        END;
        
        CREATE PROCEDURE `sp_eliminarUsuario`(
            IN `idUsuario` INT
        )
        BEGIN
        DELETE FROM HistoricoAcceso
        WHERE HistoricoAcceso.idUsuario = idUsuario;
        DELETE FROM HistoricoClave
        WHERE HistoricoClave.idUsuario = idUsuario;
        DELETE FROM Acceso
        WHERE Acceso.idUsuario = idUsuario;
        DELETE FROM PerfilUsuario
        WHERE PerfilUsuario.idUsuario = idUsuario;
        DELETE FROM Usuario
        WHERE Usuario.idUsuario = idUsuario;
        END;

        CREATE PROCEDURE `sp_habilitarAcceso`(
            IN `idUsuario` INT
        )
        BEGIN
        UPDATE Acceso
        SET email_verified_at = NOW(), estadoAcceso = null
        WHERE Acceso.idUsuario = idUsuario;
        END;

        CREATE PROCEDURE `sp_deshabilitarAcceso`(
            IN `idUsuario` INT
        )
        BEGIN
        UPDATE Acceso
        SET email_verified_at = null, estadoAcceso = NOW()
        WHERE Acceso.idUsuario = idUsuario;
        END;

        CREATE PROCEDURE `sp_consultarUsuariosHabilitados`()
        BEGIN
        SELECT idUsuario, username, email
        FROM Acceso
        WHERE email_verified_at IS NOT NULL
        AND estadoAcceso IS NULL ;
        END;

        CREATE PROCEDURE `sp_consultarUsuariosDeshabilitados`()
        BEGIN
        SELECT idUsuario, username, email
        FROM Acceso
        WHERE email_verified_at IS NULL
        AND estadoAcceso IS NOT NULL ;
        END;

        CREATE PROCEDURE `sp_consultarUsuariosPendientes`()
        BEGIN
        SELECT idUsuario, username, email
        FROM Acceso
        WHERE email_verified_at IS NULL
        AND estadoAcceso IS NULL ;
        END;
        ");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::unprepared('
        DROP PROCEDURE IF EXISTS `sp_actualizarModulo`;
        DROP PROCEDURE IF EXISTS `sp_actualizarPerfil`;
        DROP PROCEDURE IF EXISTS `sp_actualizarSubmodulo`;
        DROP PROCEDURE IF EXISTS `sp_actualizarUsuario`;
        DROP PROCEDURE IF EXISTS `sp_agregarModulo`;
        DROP PROCEDURE IF EXISTS `sp_agregarPerfil`;
        DROP PROCEDURE IF EXISTS `sp_agregarSubmodulo`;
        DROP PROCEDURE IF EXISTS `sp_agregarUsuario`;
        DROP PROCEDURE IF EXISTS `sp_asignarModuloAPerfil`;
        DROP PROCEDURE IF EXISTS `sp_asignarSubmoduloAModulo`;
        DROP PROCEDURE IF EXISTS `sp_asignarUsuarioAPerfil`;
        DROP PROCEDURE IF EXISTS `sp_consultarModulosDePerfil`;
        DROP PROCEDURE IF EXISTS `sp_consultarModulosSinPerfil`;
        DROP PROCEDURE IF EXISTS `sp_consultarSubmodulosDeModulo`;
        DROP PROCEDURE IF EXISTS `sp_consultarSubmodulosSinModulo`;
        DROP PROCEDURE IF EXISTS `sp_consultarTodosModulo`;
        DROP PROCEDURE IF EXISTS `sp_consultarTodosUsuario`;
        DROP PROCEDURE IF EXISTS `sp_consultarTodosPerfil`;
        DROP PROCEDURE IF EXISTS `sp_consultarTodosSubmodulo`;
        DROP PROCEDURE IF EXISTS `sp_consultarUnModulo`;
        DROP PROCEDURE IF EXISTS `sp_consultarUnPerfil`;
        DROP PROCEDURE IF EXISTS `sp_consultarUnSubmodulo`;
        DROP PROCEDURE IF EXISTS `sp_consultarUnUsuario`;
        DROP PROCEDURE IF EXISTS `sp_consultarUsuariosDePerfil`;
        DROP PROCEDURE IF EXISTS `sp_consultarUsuariosSinPerfil`;
        DROP PROCEDURE IF EXISTS `sp_desasignarModuloDePerfil`;
        DROP PROCEDURE IF EXISTS `sp_desasignarSubmoduloDeModulo`;
        DROP PROCEDURE IF EXISTS `sp_desasignarUsuarioDePerfil`;
        DROP PROCEDURE IF EXISTS `sp_eliminarModulo`;
        DROP PROCEDURE IF EXISTS `sp_eliminarPerfil`;
        DROP PROCEDURE IF EXISTS `sp_eliminarSubmodulo`;
        DROP PROCEDURE IF EXISTS `sp_eliminarUsuario`;
        DROP PROCEDURE IF EXISTS `sp_habilitarAcceso`;
        DROP PROCEDURE IF EXISTS `sp_deshabilitarAcceso`;
        DROP PROCEDURE IF EXISTS `sp_consultarUsuariosHabilitados`;
        DROP PROCEDURE IF EXISTS `sp_consultarUsuariosDeshabilitados`;
        DROP PROCEDURE IF EXISTS `sp_consultarUsuariosPendientes`;
        ');
    }
}
