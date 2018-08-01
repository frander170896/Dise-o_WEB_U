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
public class Materia {
    private String nombre;
    private String codigoNRC;
    private String periodo;
    private String aula;
    private String profesor;

    public Materia(String nombre, String codigoNRC, String periodo, String aula, String profesor) {
        this.nombre = nombre;
        this.codigoNRC = codigoNRC;
        this.periodo = periodo;
        this.aula = aula;
        this.profesor = profesor;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public String getCodigoNRC() {
        return codigoNRC;
    }

    public void setCodigoNRC(String codigoNRC) {
        this.codigoNRC = codigoNRC;
    }

    public String getPeriodo() {
        return periodo;
    }

    public void setPeriodo(String periodo) {
        this.periodo = periodo;
    }

    public String getAula() {
        return aula;
    }

    public void setAula(String aula) {
        this.aula = aula;
    }

    public String getProfesor() {
        return profesor;
    }

    public void setProfesor(String profesor) {
        this.profesor = profesor;
    }

    @Override
    public String toString() {
        return "Materia{" + "nombre=" + nombre + ", codigoNRC=" + codigoNRC + ", periodo=" + periodo + ", aula=" + aula + ", profesor=" + profesor + '}';
    }
    
    
    
    
}
