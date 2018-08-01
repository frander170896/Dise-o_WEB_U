/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Capa2;

import Capa3.Profesor;

/**
 *
 * @author Estudiante
 */
public class LogicaProfesor {
    private Profesor profesor;
    
    public LogicaProfesor(String nombre, String apellido, String fecha_nacimiento, String departamento, String usuario, String clave) {
        profesor = new Profesor(nombre, apellido, fecha_nacimiento,departamento, usuario, clave);
    }

    public Profesor getProfesor() {
        return profesor;
    }

    public void setProfesor(Profesor profesor) {
        this.profesor = profesor;
    }
    
}
