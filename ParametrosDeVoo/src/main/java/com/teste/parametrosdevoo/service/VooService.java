package com.teste.parametrosdevoo.service;

import java.util.Collection;
import java.util.Collections;
import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.teste.parametrosdevoo.model.Voo;
import com.teste.parametrosdevoo.repository.VooRepository;

@Service
public class VooService {

	@Autowired
	VooRepository repository;

	public void adicionaVoo(Voo voo) {
		repository.save(voo);
	}

	public List<Voo> listarVoos() {
		List<Voo> voos = repository.findAll();
		Collections.reverse(voos);		
		return voos;

	}

	public void deletaVoo(Long id) {
		this.repository.deleteById(id);
	}

	public Voo buscarVoo(Long id) {
		return repository.findById(id).orElse(null);
	}
}
