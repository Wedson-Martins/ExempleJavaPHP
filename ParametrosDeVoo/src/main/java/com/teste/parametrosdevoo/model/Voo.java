package com.teste.parametrosdevoo.model;


import java.math.BigDecimal;

import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.Id;

@Entity
public class Voo {
	@Id
	@GeneratedValue
	private Long idVoo;
	private String dataVoo;
	private BigDecimal custo;
	private int distancia;
	private char captura;
	private int nivelDor;

	public Long getIdVoo() {
		return idVoo;
	}

	public void setIdVoo(Long idVoo) {
		this.idVoo = idVoo;
	}

	public String getDataVoo() {
		return dataVoo;
	}

	public void setDataVoo(String dataVoo) {
		this.dataVoo = dataVoo;
	}

	public BigDecimal getCusto() {
		return custo;
	}

	public void setCusto(BigDecimal custo) {
		this.custo = custo;
	}

	public int getDistancia() {
		return distancia;
	}

	public void setDistancia(int distancia) {
		this.distancia = distancia;
	}

	public char getCaptura() {
		return captura;
	}

	public void setCaptura(char captura) {
		this.captura = captura;
	}

	public int getNivelDor() {
		return nivelDor;
	}

	public void setNivelDor(int nivelDor) {
		this.nivelDor = nivelDor;
	}

}