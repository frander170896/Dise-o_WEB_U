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
public class Profesor {
    private String nombre;
    private String apellido;
    private String fecha_nacimiento;
    private String departamento;
    private String usuario;
    private String clave;

    public Profesor(String nombre, String apellido, String fecha_nacimiento, String departamento, String usuario, String clave) {
        this.nombre = nombre;
        this.apellido = apellido;
        this.fecha_nacimiento = fecha_nacimiento;
        this.departamento = departamento;
        this.usuario = usuario;
        this.clave = clave;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public String getApellido() {
        return apellido;
    }

    public void setApellido(String apellido) {
        this.apellido = apellido;
    }

    public String getFecha_nacimiento() {
        return fecha_nacimiento;
    }

    public void setFecha_nacimiento(String fecha_nacimiento) {
        this.fecha_nacimiento = fecha_nacimiento;
    }

    public String getDepartamento() {
        return departamento;
    }

    public void setDepartamento(String departamento) {
        this.departamento = departamento;
    }

    public String getUsuario() {
        return usuario;
    }

    public void setUsuario(String usuario) {
        this.usuario = usuario;
    }

    public String getClave() {
        return clave;
    }

    public void setClave(String clave) {
        this.clave = clave;
    }

    @Override
    public String toString() {
        return "Profesor{" + "nombre=" + nombre + ", apellido=" + apellido + ", fecha_nacimiento=" + fecha_nacimiento + ", departamento=" + departamento + ", usuario=" + usuario + ", clave=" + clave + '}';
    }
   
    
    
}
