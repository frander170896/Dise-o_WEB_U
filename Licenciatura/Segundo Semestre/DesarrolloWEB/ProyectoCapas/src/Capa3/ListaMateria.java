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
public class ListaMateria {
    private int tamaño;
    private Materia[] Materias;
    private int posicion;
    public ListaMateria() {
        this.tamaño = 10;
        this.Materias = new Materia[tamaño];
        this.posicion = 0;
    }
    
    public String imprimeListaMateria(){
        String respuesta = "LISTA DE MATERIAS \n\n";
        for (int i = 0; i < this.Materias.length ; i++){
            respuesta += this.Materias[i].toString() + "\n";
        }
        return respuesta;
    }

     public boolean AgregarListaMateria(Materia materia){
  
        boolean inserto = false;
        try{
          if(posicion < 10){
            this.Materias[posicion] = materia;
            posicion++;
           }  
          inserto = true;
        }catch (Exception e){
            inserto = false;
        }
       return inserto;
    }
}
