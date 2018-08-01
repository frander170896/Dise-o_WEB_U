/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Capa2;

import Capa3.ListaProfesor;

/**
 *
 * @author Estudiante
 */
public class LogicaListaProfesor {
    
    private ListaProfesor listaProfesor;
 
    public LogicaListaProfesor() {
        this.listaProfesor = new ListaProfesor();
    }
    
    public void agregaListaProfesor(LogicaProfesor logProf){
        this.listaProfesor.AgregarListaProfesores(logProf.getProfesor());
    } 
    
    public String imprimeLista(){
        String respuesta = "";
        respuesta = this.listaProfesor.imprimeListaProfesores();
        return respuesta;
    }
     
}
