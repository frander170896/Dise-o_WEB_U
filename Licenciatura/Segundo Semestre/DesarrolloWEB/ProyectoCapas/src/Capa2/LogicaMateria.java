/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Capa2;

import Capa3.Materia;

/**
 *
 * @author Estudiante
 */
public class LogicaMateria {
    private Materia materia;
    public LogicaMateria(String nombre, String codigoNRC, String periodo, String aula, String profesor) {
       materia = new Materia(nombre,codigoNRC,periodo,aula,profesor);
    }

    public Materia getMateria() {
        return materia;
    }

    public void setMateria(Materia materia) {
        this.materia = materia;
    }
    
    
}
