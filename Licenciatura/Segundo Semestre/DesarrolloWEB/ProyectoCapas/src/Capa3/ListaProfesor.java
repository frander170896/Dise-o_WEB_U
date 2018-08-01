/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
package Capa3;

/**
 *
 * @author Estudiante
 */
public class ListaProfesor {
    
    private int tamaño;
    private Profesor[] Profesores;
    private int posicion;
    
    public ListaProfesor() {
        this.tamaño = 10;
        this.Profesores = new Profesor[tamaño];
        this.posicion = 0;
    }
    
    public String imprimeListaProfesores(){
        String respuesta = "LISTA DE PROFESORES \n\n";
        for (int i = 0; i < this.Profesores.length ; i++){
            respuesta += this.Profesores[i].toString() + "\n";
        }
        return respuesta;
    }
    
    public boolean AgregarListaProfesores(Profesor profesor){
  
        boolean inserto = false;
        
        try{
          if(posicion < 10){
            this.Profesores[posicion] = profesor;
            posicion++;
           }  
          inserto = true;
        }catch (Exception e){
            inserto = false;
        }
       return inserto;
    }
}
