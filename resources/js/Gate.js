export default class Gate{
    constructor(user){
        this.user = user;
    }
    esAdmin(){
        var i, x = "";
        for (i in this.user) {
            x += this.user[i].nombre;
            if(this.user[i].nombre === 'Administrador')
            {
                return this.user[i].nombre === 'Administrador'
                break;
            }
        }
        //return this.user.nombre === 'Administrador'
    }
    esDev(){
        var i, x = "";
        for (i in this.user) {
            x += this.user[i].nombre;
            if(this.user[i].nombre === 'Desarrollador')
            {
                return this.user[i].nombre === 'Desarrollador'
                break;
            }
        }
        //return this.user.nombre === 'Desarrollador'
    }
    esAutor(){
        var i, x = "";
        for (i in this.user) {
            x += this.user[i].nombre;
            if(this.user[i].nombre === 'Autor')
            {
                return this.user[i].nombre === 'Autor'
                break;
            }
        }
        //return this.user.nombre === 'Autor'
    }
    esUsuario(){
        var i, x = "";
        for (i in this.user) {
            x += this.user[i].nombre;
            if(this.user[i].nombre === 'Usuario')
            {
                return this.user[i].nombre === 'Usuario'
                break;
            }
        }
        //return this.user.nombre === 'Usuario'
    }
    esVoluntario(){
        var i, x = "";
        for (i in this.user) {
            x += this.user[i].nombre;
            if(this.user[i].nombre === 'Voluntario')
            {
                return this.user[i].nombre === 'Voluntario'
                break;
            }
        }
        //return this.user.nombre === 'Voluntario'
    }
    esParticipante(){
        var i, x = "";
        for (i in this.user) {
            x += this.user[i].nombre;
            if(this.user[i].nombre === 'Participante')
            {
                return this.user[i].nombre === 'Participante'
                break;
            }
        }
        //return this.user.nombre === 'Participante'
    }
    esSuscriptor(){
        var i, x = "";
        for (i in this.user) {
            x += this.user[i].nombre;
            if(this.user[i].nombre === 'Suscriptor')
            {
                return this.user[i].nombre === 'Suscriptor'
                break;
            }
        }
        //return this.user.nombre === 'Suscriptor'
    }
    esOrganizador(){
        var i, x = "";
        for (i in this.user) {
            x += this.user[i].nombre;
            if(this.user[i].nombre === 'Organizador')
            {
                return this.user[i].nombre === 'Organizador'
                break;
            }
        }
        //return this.user.nombre === 'Organizador'
    }
}