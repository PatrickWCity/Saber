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
        DROP PROCEDURE IF EXISTS `sp_habilitarAcceso`;
        DROP PROCEDURE IF EXISTS `sp_deshabilitarAcceso`;
        DROP PROCEDURE IF EXISTS `sp_consultarUsuariosHabilitados`;
        DROP PROCEDURE IF EXISTS `sp_consultarUsuariosDeshabilitados`;
        DROP PROCEDURE IF EXISTS `sp_consultarUsuariosPendientes`;
        DROP PROCEDURE IF EXISTS `sp_consultarTodosTipoNoticia`;
        DROP PROCEDURE IF EXISTS `sp_consultarTodosTipoDocumento`;
        DROP PROCEDURE IF EXISTS `sp_consultarTodosEvento`;
        DROP PROCEDURE IF EXISTS `sp_actualizarEvento`;
        DROP PROCEDURE IF EXISTS `sp_agregarEvento`;
        DROP PROCEDURE IF EXISTS `sp_consultarUnEvento`;
        DROP PROCEDURE IF EXISTS `sp_eliminarEvento`;
        DROP PROCEDURE IF EXISTS `sp_consultarTodosTipoEvento`;
        DROP PROCEDURE IF EXISTS `sp_actualizarTipoNoticia`;
        DROP PROCEDURE IF EXISTS `sp_agregarTipoNoticia`;
        DROP PROCEDURE IF EXISTS `sp_consultarUnTipoNoticia`;
        DROP PROCEDURE IF EXISTS `sp_eliminarTipoNoticia`;
        DROP PROCEDURE IF EXISTS `sp_actualizarTipoDocumento`;
        DROP PROCEDURE IF EXISTS `sp_agregarTipoDocumento`;
        DROP PROCEDURE IF EXISTS `sp_consultarUnTipoDocumento`;
        DROP PROCEDURE IF EXISTS `sp_eliminarTipoDocumento`;
        DROP PROCEDURE IF EXISTS `sp_actualizarTipoEvento`;
        DROP PROCEDURE IF EXISTS `sp_agregarTipoEvento`;
        DROP PROCEDURE IF EXISTS `sp_consultarUnTipoEvento`;
        DROP PROCEDURE IF EXISTS `sp_eliminarTipoEvento`;
        DROP PROCEDURE IF EXISTS `sp_consultarTodosTipoVoluntario`;
        DROP PROCEDURE IF EXISTS `sp_actualizarTipoVoluntario`;
        DROP PROCEDURE IF EXISTS `sp_agregarTipoVoluntario`;
        DROP PROCEDURE IF EXISTS `sp_consultarUnTipoVoluntario`;
        DROP PROCEDURE IF EXISTS `sp_eliminarTipoVoluntario`;
        DROP PROCEDURE IF EXISTS `sp_consultarTodosArea`;
        DROP PROCEDURE IF EXISTS `sp_actualizarArea`;
        DROP PROCEDURE IF EXISTS `sp_agregarArea`;
        DROP PROCEDURE IF EXISTS `sp_consultarUnArea`;
        DROP PROCEDURE IF EXISTS `sp_eliminarArea`;
        DROP PROCEDURE IF EXISTS `sp_consultarTodosSede`;
        DROP PROCEDURE IF EXISTS `sp_actualizarSede`;
        DROP PROCEDURE IF EXISTS `sp_agregarSede`;
        DROP PROCEDURE IF EXISTS `sp_consultarUnSede`;
        DROP PROCEDURE IF EXISTS `sp_eliminarSede`;
        DROP PROCEDURE IF EXISTS `sp_consultarTodosExpositor`;
        DROP PROCEDURE IF EXISTS `sp_actualizarExpositor`;
        DROP PROCEDURE IF EXISTS `sp_agregarExpositor`;
        DROP PROCEDURE IF EXISTS `sp_consultarUnExpositor`;
        DROP PROCEDURE IF EXISTS `sp_eliminarExpositor`;
        DROP PROCEDURE IF EXISTS `sp_consultarTodosDocumento`;
        DROP PROCEDURE IF EXISTS `sp_actualizarDocumento`;
        DROP PROCEDURE IF EXISTS `sp_agregarDocumento`;
        DROP PROCEDURE IF EXISTS `sp_consultarUnDocumento`;
        DROP PROCEDURE IF EXISTS `sp_eliminarDocumento`;
        DROP PROCEDURE IF EXISTS `sp_consultarTodosNoticia`;
        DROP PROCEDURE IF EXISTS `sp_actualizarNoticia`;
        DROP PROCEDURE IF EXISTS `sp_agregarNoticia`;
        DROP PROCEDURE IF EXISTS `sp_consultarUnNoticia`;
        DROP PROCEDURE IF EXISTS `sp_eliminarNoticia`;
        DROP PROCEDURE IF EXISTS `sp_consultarUltimasNoticia`;
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

        CREATE PROCEDURE `sp_consultarTodosTipoNoticia`()
        BEGIN
        SELECT *
        FROM TipoNoticia;
        END;

        CREATE PROCEDURE `sp_consultarTodosTipoDocumento`()
        BEGIN
        SELECT *
        FROM TipoDocumento;
        END;

        CREATE PROCEDURE `sp_consultarTodosTipoEvento`()
        BEGIN
        SELECT *
        FROM TipoEvento;
        END;

        CREATE PROCEDURE `sp_actualizarTipoNoticia`(
            IN `idTipoNoticia` INT,
            IN `nombre` VARCHAR(60),
            IN `descripcion` VARCHAR(255)
        )
        BEGIN
        UPDATE TipoNoticia
        SET nombre = nombre, descripcion = descripcion
        WHERE TipoNoticia.idTipoNoticia = idTipoNoticia;
        END;

        CREATE PROCEDURE `sp_agregarTipoNoticia`(
            IN `nombre` VARCHAR(60),
            IN `descripcion` VARCHAR(255)
        )
        BEGIN
        INSERT INTO TipoNoticia (nombre, descripcion)
        VALUES(nombre, descripcion);
        END;

        CREATE PROCEDURE `sp_consultarUnTipoNoticia`(
            IN `idTipoNoticia` INT,
            IN `palabraClave` VARCHAR(255)
        )
        BEGIN
        SELECT *
        FROM TipoNoticia 
        WHERE TipoNoticia.idTipoNoticia = idTipoNoticia
        OR nombre LIKE CONCAT('%',palabraClave,'%')
        OR descripcion LIKE CONCAT('%',palabraClave,'%');
        END;

        CREATE PROCEDURE `sp_eliminarTipoNoticia`(
            IN `idTipoNoticia` INT
        )
        BEGIN
        DELETE FROM TipoNoticia
        WHERE TipoNoticia.idTipoNoticia = idTipoNoticia;
        END;

        CREATE PROCEDURE `sp_actualizarTipoDocumento`(
            IN `idTipoDocumento` INT,
            IN `nombre` VARCHAR(60),
            IN `descripcion` VARCHAR(255)
        )
        BEGIN
        UPDATE TipoDocumento
        SET nombre = nombre, descripcion = descripcion
        WHERE TipoDocumento.idTipoDocumento = idTipoDocumento;
        END;

        CREATE PROCEDURE `sp_agregarTipoDocumento`(
            IN `nombre` VARCHAR(60),
            IN `descripcion` VARCHAR(255)
        )
        BEGIN
        INSERT INTO TipoDocumento (nombre, descripcion)
        VALUES(nombre, descripcion);
        END;

        CREATE PROCEDURE `sp_consultarUnTipoDocumento`(
            IN `idTipoDocumento` INT,
            IN `palabraClave` VARCHAR(255)
        )
        BEGIN
        SELECT *
        FROM TipoDocumento 
        WHERE TipoDocumento.idTipoDocumento = idTipoDocumento
        OR nombre LIKE CONCAT('%',palabraClave,'%')
        OR descripcion LIKE CONCAT('%',palabraClave,'%');
        END;

        CREATE PROCEDURE `sp_eliminarTipoDocumento`(
            IN `idTipoDocumento` INT
        )
        BEGIN
        DELETE FROM TipoDocumento
        WHERE TipoDocumento.idTipoDocumento = idTipoDocumento;
        END;

        CREATE PROCEDURE `sp_actualizarTipoEvento`(
            IN `idTipoEvento` INT,
            IN `nombre` VARCHAR(60),
            IN `descripcion` VARCHAR(255)
        )
        BEGIN
        UPDATE TipoEvento
        SET nombre = nombre, descripcion = descripcion
        WHERE TipoEvento.idTipoEvento = idTipoEvento;
        END;

        CREATE PROCEDURE `sp_agregarTipoEvento`(
            IN `nombre` VARCHAR(60),
            IN `descripcion` VARCHAR(255)
        )
        BEGIN
        INSERT INTO TipoEvento (nombre, descripcion)
        VALUES(nombre, descripcion);
        END;

        CREATE PROCEDURE `sp_consultarUnTipoEvento`(
            IN `idTipoEvento` INT,
            IN `palabraClave` VARCHAR(255)
        )
        BEGIN
        SELECT *
        FROM TipoEvento 
        WHERE TipoEvento.idTipoEvento = idTipoEvento
        OR nombre LIKE CONCAT('%',palabraClave,'%')
        OR descripcion LIKE CONCAT('%',palabraClave,'%');
        END;

        CREATE PROCEDURE `sp_eliminarTipoEvento`(
            IN `idTipoEvento` INT
        )
        BEGIN
        DELETE FROM TipoEvento
        WHERE TipoEvento.idTipoEvento = idTipoEvento;
        END;

        CREATE PROCEDURE `sp_consultarTodosTipoVoluntario`()
        BEGIN
        SELECT *
        FROM TipoVoluntario;
        END;

        CREATE PROCEDURE `sp_actualizarTipoVoluntario`(
            IN `idTipoVoluntario` INT,
            IN `nombre` VARCHAR(60),
            IN `descripcion` VARCHAR(255)
        )
        BEGIN
        UPDATE TipoVoluntario
        SET nombre = nombre, descripcion = descripcion
        WHERE TipoVoluntario.idTipoVoluntario = idTipoVoluntario;
        END;

        CREATE PROCEDURE `sp_agregarTipoVoluntario`(
            IN `nombre` VARCHAR(60),
            IN `descripcion` VARCHAR(255)
        )
        BEGIN
        INSERT INTO TipoVoluntario (nombre, descripcion)
        VALUES(nombre, descripcion);
        END;

        CREATE PROCEDURE `sp_consultarUnTipoVoluntario`(
            IN `idTipoVoluntario` INT,
            IN `palabraClave` VARCHAR(255)
        )
        BEGIN
        SELECT *
        FROM TipoVoluntario 
        WHERE TipoVoluntario.idTipoVoluntario = idTipoVoluntario
        OR nombre LIKE CONCAT('%',palabraClave,'%')
        OR descripcion LIKE CONCAT('%',palabraClave,'%');
        END;

        CREATE PROCEDURE `sp_eliminarTipoVoluntario`(
            IN `idTipoVoluntario` INT
        )
        BEGIN
        DELETE FROM TipoVoluntario
        WHERE TipoVoluntario.idTipoVoluntario = idTipoVoluntario;
        END;

        CREATE PROCEDURE `sp_consultarTodosArea`()
        BEGIN
        SELECT *
        FROM Area;
        END;

        CREATE PROCEDURE `sp_actualizarArea`(
            IN `idArea` INT,
            IN `nombre` VARCHAR(191),
            IN `descripcion` VARCHAR(255)
        )
        BEGIN
        UPDATE Area
        SET nombre = nombre, descripcion = descripcion
        WHERE Area.idArea = idArea;
        END;

        CREATE PROCEDURE `sp_agregarArea`(
            IN `nombre` VARCHAR(191),
            IN `descripcion` VARCHAR(255)
        )
        BEGIN
        INSERT INTO Area (nombre, descripcion)
        VALUES(nombre, descripcion);
        END;

        CREATE PROCEDURE `sp_consultarUnArea`(
            IN `idArea` INT,
            IN `palabraClave` VARCHAR(255)
        )
        BEGIN
        SELECT *
        FROM Area 
        WHERE Area.idArea = idArea
        OR nombre LIKE CONCAT('%',palabraClave,'%')
        OR descripcion LIKE CONCAT('%',palabraClave,'%');
        END;

        CREATE PROCEDURE `sp_eliminarArea`(
            IN `idArea` INT
        )
        BEGIN
        DELETE FROM Area
        WHERE Area.idArea = idArea;
        END;

        CREATE PROCEDURE `sp_actualizarSede`(
            IN `idSede` INT,
            IN `nombre` VARCHAR(60),
            IN `descripcion` VARCHAR(255),
            IN `ubicacion` VARCHAR(255)
        )
        BEGIN
        UPDATE Sede
        SET nombre = nombre, descripcion = descripcion, ubicacion = ubicacion
        WHERE Sede.idSede = idSede;
        END;
        
        CREATE PROCEDURE `sp_agregarSede`(
            IN `nombre` VARCHAR(60),
            IN `descripcion` VARCHAR(255),
            IN `ubicacion` VARCHAR(255)
        )
        BEGIN
        INSERT INTO Sede (nombre, descripcion, ubicacion)
        VALUES(nombre, descripcion, ubicacion);
        END;
        
        CREATE PROCEDURE `sp_consultarTodosSede`()
        BEGIN
        SELECT *
        FROM Sede;
        END;

        CREATE PROCEDURE `sp_consultarUnSede`(
            IN `idSede` INT,
            IN `palabraClave` VARCHAR(255)
        )
        BEGIN
        SELECT *
        FROM Sede 
        WHERE Sede.idSede = idSede
        OR nombre LIKE CONCAT('%',palabraClave,'%')
        OR descripcion LIKE CONCAT('%',palabraClave,'%')
        OR ubicacion LIKE CONCAT('%',palabraClave,'%');
        END;

        CREATE PROCEDURE `sp_eliminarSede`(
            IN `idSede` INT
        )
        BEGIN
        DELETE FROM Sede
        WHERE Sede.idSede = idSede;
        END;

        CREATE PROCEDURE `sp_actualizarExpositor`(
            IN `idExpositor` INT,
            IN `run` VARCHAR(10),
            IN `nombre` VARCHAR(60),
            IN `appat` VARCHAR(60),
            IN `apmat` VARCHAR(60)
        )
        BEGIN
        UPDATE Expositor
        SET run = run, nombre = nombre, appat = appat, apmat = apmat
        WHERE Expositor.idExpositor = idExpositor;
        END;
        
        CREATE PROCEDURE `sp_agregarExpositor`(
            IN `run` VARCHAR(10),
            IN `nombre` VARCHAR(60),
            IN `appat` VARCHAR(60),
            IN `apmat` VARCHAR(60)
        )
        BEGIN
        INSERT INTO Expositor (run, nombre, appat, apmat)
        VALUES(run, nombre, appat, apmat);
        END;
        
        CREATE PROCEDURE `sp_consultarTodosExpositor`()
        BEGIN
        SELECT *
        FROM Expositor;
        END;
        
        CREATE PROCEDURE `sp_consultarUnExpositor`(
            IN `idExpositor` INT,
            IN `palabraClave` VARCHAR(255)
        )
        BEGIN
        SELECT *
        FROM Expositor
        WHERE Expositor.idExpositor = idExpositor
        OR nombre LIKE CONCAT('%',palabraClave,'%')
        OR appat LIKE CONCAT('%',palabraClave,'%')
        OR apmat LIKE CONCAT('%',palabraClave,'%');
        END;
        
        CREATE PROCEDURE `sp_eliminarExpositor`(
            IN `idExpositor` INT
        )
        BEGIN
        DELETE FROM Expositor
        WHERE Expositor.idExpositor = idExpositor;
        END;
        
        CREATE PROCEDURE `sp_actualizarEvento`(
            IN `idEvento` INT,
            IN `nombre` VARCHAR(60),
            IN `descripcion` VARCHAR(255),
            IN `fechaInicio` DATETIME,
            IN `fechaTermino` DATETIME,
            IN `idTipoEvento` INT,
            IN `idSede` INT,
            IN `idArea` INT,
            IN `idExpositor` INT
        )
        BEGIN
        UPDATE Evento
        SET nombre = nombre, descripcion = descripcion, fechaInicio = fechaInicio, fechaTermino = fechaTermino, idTipoEvento = idTipoEvento, idSede = idSede, idArea = idArea, idExpositor = idExpositor
        WHERE Evento.idEvento = idEvento;
        END;
        
        CREATE PROCEDURE `sp_agregarEvento`(
            IN `nombre` VARCHAR(60),
            IN `descripcion` VARCHAR(255),
            IN `fechaInicio` DATETIME,
            IN `fechaTermino` DATETIME,
            IN `idTipoEvento` INT,
            IN `idSede` INT,
            IN `idArea` INT,
            IN `idExpositor` INT
        )
        BEGIN
        INSERT INTO Evento (nombre, descripcion, fechaInicio, fechaTermino, idTipoEvento, idSede, idArea, idExpositor)
        VALUES(nombre, descripcion, fechaInicio, fechaTermino, idTipoEvento, idSede, idArea, idExpositor);
        END;
        
        CREATE PROCEDURE `sp_consultarTodosEvento`()
        BEGIN
        SELECT Evento.*, TipoEvento.nombre as TipoEvento, Sede.nombre as Sede, Area.nombre as Area, CONCAT_WS(' ',Expositor.nombre,Expositor.appat,Expositor.apmat) as Expositor
        FROM Evento, Sede, Area, Expositor, TipoEvento
		WHERE Evento.idTipoEvento = TipoEvento.idTipoEvento
		AND Evento.idSede = Sede.idSede
		AND Evento.idArea = Area.idArea
		AND Evento.idExpositor = Expositor.idExpositor;
        END;
        
        CREATE PROCEDURE `sp_consultarUnEvento`(
            IN `idEvento` INT,
            IN `palabraClave` VARCHAR(255)
        )
        BEGIN
        SELECT Evento.*, TipoEvento.nombre as TipoEvento, Sede.nombre as Sede, Area.nombre as Area, CONCAT_WS(' ',Expositor.nombre,Expositor.appat,Expositor.apmat) as Expositor
        FROM Evento, Sede, Area, Expositor, TipoEvento
		WHERE Evento.idTipoEvento = TipoEvento.idTipoEvento
		AND Evento.idSede = Sede.idSede
		AND Evento.idArea = Area.idArea
        AND Evento.idExpositor = Expositor.idExpositor
        AND Evento.idEvento = idEvento;
        END;
        
        CREATE PROCEDURE `sp_eliminarEvento`(
            IN `idEvento` INT
        )
        BEGIN
        DELETE FROM Evento
        WHERE Evento.idEvento = idEvento;
        END;

        CREATE PROCEDURE `sp_actualizarDocumento`(
            IN `idDocumento` INT,
            IN `nombre` VARCHAR(60),
            IN `descripcion` VARCHAR(255),
            IN `archivo` VARCHAR(255),
            IN `fechaCreada` TIMESTAMP,
            IN `fechaActualizada` TIMESTAMP,
            IN `idTipoDocumento` INT
        )
        BEGIN
        UPDATE Documento
        SET nombre = nombre, descripcion = descripcion, archivo = archivo, fechaCreada = fechaCreada, fechaActualizada = fechaActualizada, idTipoDocumento = idTipoDocumento
        WHERE Documento.idDocumento = idDocumento;
        END;
        
        CREATE PROCEDURE `sp_agregarDocumento`(
            IN `nombre` VARCHAR(60),
            IN `descripcion` VARCHAR(255),
            IN `archivo` VARCHAR(255),
            IN `fechaCreada` TIMESTAMP,
            IN `fechaActualizada` TIMESTAMP,
            IN `idTipoDocumento` INT
        )
        BEGIN
        INSERT INTO Documento (nombre, descripcion, archivo, fechaCreada, fechaActualizada, idTipoDocumento)
        VALUES(nombre, descripcion, archivo, fechaCreada, fechaActualizada, idTipoDocumento);
        END;

        CREATE PROCEDURE `sp_consultarUnDocumento`(
            IN `idDocumento` INT,
            IN `palabraClave` VARCHAR(255)
        )
        BEGIN
        SELECT Documento.*, TipoDocumento.nombre as TipoDocumento
        FROM Documento, TipoDocumento
        WHERE Documento.idTipoDocumento = TipoDocumento.idTipoDocumento
        AND Documento.idDocumento = idDocumento;
        END;

        CREATE PROCEDURE `sp_consultarTodosDocumento`()
        BEGIN
        SELECT Documento.*, TipoDocumento.nombre as TipoDocumento
        FROM Documento, TipoDocumento
		WHERE Documento.idTipoDocumento = TipoDocumento.idTipoDocumento;
        END;

        CREATE PROCEDURE `sp_eliminarDocumento`(
            IN `idDocumento` INT
        )
        BEGIN
        DELETE FROM Documento
        WHERE Documento.idDocumento = idDocumento;
        END;

        CREATE PROCEDURE `sp_actualizarNoticia`(
            IN `idNoticia` INT,
            IN `titulo` VARCHAR(191),
            IN `contenido` LONGTEXT,
            IN `imagenPortada` VARCHAR(191),
            IN `fechaCreada` TIMESTAMP,
            IN `fechaActualizada` TIMESTAMP,
            IN `idTipoNoticia` INT
        )
        BEGIN
        UPDATE Noticia
        SET titulo = titulo, contenido = contenido, imagenPortada = imagenPortada, fechaCreada = fechaCreada, fechaActualizada = fechaActualizada, idTipoNoticia = idTipoNoticia
        WHERE Noticia.idNoticia = idNoticia;
        END;
        
        CREATE PROCEDURE `sp_agregarNoticia`(
            IN `titulo` VARCHAR(191),
            IN `contenido` LONGTEXT,
            IN `imagenPortada` VARCHAR(191),
            IN `fechaCreada` TIMESTAMP,
            IN `fechaActualizada` TIMESTAMP,
            IN `idTipoNoticia` INT
        )
        BEGIN
        INSERT INTO Noticia (titulo, contenido, imagenPortada, fechaCreada, fechaActualizada, idTipoNoticia)
        VALUES(titulo, contenido, imagenPortada, fechaCreada, fechaActualizada, idTipoNoticia);
        END;

        CREATE PROCEDURE `sp_consultarUnNoticia`(
            IN `idNoticia` INT,
            IN `palabraClave` VARCHAR(255)
        )
        BEGIN
        SELECT Noticia.*, TipoNoticia.nombre as TipoNoticia
        FROM Noticia, TipoNoticia
        WHERE Noticia.idTipoNoticia = TipoNoticia.idTipoNoticia
        AND Noticia.idNoticia = idNoticia;
        END;

        CREATE PROCEDURE `sp_consultarTodosNoticia`()
        BEGIN
        SELECT Noticia.*, TipoNoticia.nombre as TipoNoticia
        FROM Noticia, TipoNoticia
		WHERE Noticia.idTipoNoticia = TipoNoticia.idTipoNoticia;
        END;

        CREATE PROCEDURE `sp_eliminarNoticia`(
            IN `idNoticia` INT
        )
        BEGIN
        DELETE FROM Noticia
        WHERE Noticia.idNoticia = idNoticia;
        END;

        CREATE PROCEDURE `sp_consultarUltimasNoticia`()
        BEGIN
        SELECT Noticia.*, TipoNoticia.nombre as TipoNoticia
        FROM Noticia, TipoNoticia
        WHERE Noticia.idTipoNoticia = TipoNoticia.idTipoNoticia
        ORDER BY idNoticia DESC LIMIT 0,4;
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
        DROP PROCEDURE IF EXISTS `sp_consultarTodosTipoNoticia`;
        DROP PROCEDURE IF EXISTS `sp_consultarTodosTipoDocumento`;
        DROP PROCEDURE IF EXISTS `sp_consultarTodosEvento`;
        DROP PROCEDURE IF EXISTS `sp_actualizarEvento`;
        DROP PROCEDURE IF EXISTS `sp_agregarEvento`;
        DROP PROCEDURE IF EXISTS `sp_consultarUnEvento`;
        DROP PROCEDURE IF EXISTS `sp_eliminarEvento`;
        DROP PROCEDURE IF EXISTS `sp_consultarTodosTipoEvento`;
        DROP PROCEDURE IF EXISTS `sp_actualizarTipoNoticia`;
        DROP PROCEDURE IF EXISTS `sp_agregarTipoNoticia`;
        DROP PROCEDURE IF EXISTS `sp_consultarUnTipoNoticia`;
        DROP PROCEDURE IF EXISTS `sp_eliminarTipoNoticia`;
        DROP PROCEDURE IF EXISTS `sp_actualizarTipoDocumento`;
        DROP PROCEDURE IF EXISTS `sp_agregarTipoDocumento`;
        DROP PROCEDURE IF EXISTS `sp_consultarUnTipoDocumento`;
        DROP PROCEDURE IF EXISTS `sp_eliminarTipoDocumento`;
        DROP PROCEDURE IF EXISTS `sp_actualizarTipoEvento`;
        DROP PROCEDURE IF EXISTS `sp_agregarTipoEvento`;
        DROP PROCEDURE IF EXISTS `sp_consultarUnTipoEvento`;
        DROP PROCEDURE IF EXISTS `sp_eliminarTipoEvento`;
        DROP PROCEDURE IF EXISTS `sp_consultarTodosTipoVoluntario`;
        DROP PROCEDURE IF EXISTS `sp_actualizarTipoVoluntario`;
        DROP PROCEDURE IF EXISTS `sp_agregarTipoVoluntario`;
        DROP PROCEDURE IF EXISTS `sp_consultarUnTipoVoluntario`;
        DROP PROCEDURE IF EXISTS `sp_eliminarTipoVoluntario`;
        DROP PROCEDURE IF EXISTS `sp_consultarTodosArea`;
        DROP PROCEDURE IF EXISTS `sp_actualizarArea`;
        DROP PROCEDURE IF EXISTS `sp_agregarArea`;
        DROP PROCEDURE IF EXISTS `sp_consultarUnArea`;
        DROP PROCEDURE IF EXISTS `sp_eliminarArea`;
        DROP PROCEDURE IF EXISTS `sp_consultarTodosSede`;
        DROP PROCEDURE IF EXISTS `sp_actualizarSede`;
        DROP PROCEDURE IF EXISTS `sp_agregarSede`;
        DROP PROCEDURE IF EXISTS `sp_consultarUnSede`;
        DROP PROCEDURE IF EXISTS `sp_eliminarSede`;
        DROP PROCEDURE IF EXISTS `sp_consultarTodosExpositor`;
        DROP PROCEDURE IF EXISTS `sp_actualizarExpositor`;
        DROP PROCEDURE IF EXISTS `sp_agregarExpositor`;
        DROP PROCEDURE IF EXISTS `sp_consultarUnExpositor`;
        DROP PROCEDURE IF EXISTS `sp_eliminarExpositor`;
        DROP PROCEDURE IF EXISTS `sp_consultarTodosDocumento`;
        DROP PROCEDURE IF EXISTS `sp_actualizarDocumento`;
        DROP PROCEDURE IF EXISTS `sp_agregarDocumento`;
        DROP PROCEDURE IF EXISTS `sp_consultarUnDocumento`;
        DROP PROCEDURE IF EXISTS `sp_eliminarDocumento`;
        DROP PROCEDURE IF EXISTS `sp_consultarTodosNoticia`;
        DROP PROCEDURE IF EXISTS `sp_actualizarNoticia`;
        DROP PROCEDURE IF EXISTS `sp_agregarNoticia`;
        DROP PROCEDURE IF EXISTS `sp_consultarUnNoticia`;
        DROP PROCEDURE IF EXISTS `sp_eliminarNoticia`;
        DROP PROCEDURE IF EXISTS `sp_consultarUltimasNoticia`;
        ');
    }
}
