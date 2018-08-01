/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Capa2;

import Capa3.ListaMateria;

/**
 *
 * @author Estudiante
 */
public class LogicaListaMateria {
 private ListaMateria listaMateria;
 
    public LogicaListaMateria() {
        this.listaMateria = new ListaMateria();
    }
    
    public void agregaListaMateria(LogicaMateria logMat){
        this.listaMateria.AgregarListaMateria(logMat.getMateria());
    } 
    
    public String imprimeLista(){
        String respuesta = "";
        respuesta = this.listaMateria.imprimeListaMateria();
        return respuesta;
    }
    
}
