package com.teste.parametrosdevoo.controller;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.web.bind.annotation.DeleteMapping;
import org.springframework.web.bind.annotation.GetMapping;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.PostMapping;
import org.springframework.web.bind.annotation.PutMapping;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestParam;
import org.springframework.web.bind.annotation.ResponseBody;
import org.springframework.web.bind.annotation.RestController;

import com.teste.parametrosdevoo.model.Voo;
import com.teste.parametrosdevoo.service.VooService;

@RestController
@RequestMapping("/voos")
public class VooController {

	@Autowired
	VooService vooService;

	@PostMapping
	public void adiciona(@RequestBody Voo voo) {
		this.vooService.adicionaVoo(voo);
	}
	

	@PostMapping(value="/delete")
	public void deleta(@RequestBody Voo voo){
		this.vooService.deletaVoo(voo.getIdVoo());
	}

	@PostMapping(value="/buscar")
	public Voo buscar(@RequestBody Voo voo){
		return this.vooService.buscarVoo(voo.getIdVoo());
	}

	@GetMapping
	@ResponseBody
	public List<Voo> getAll() {
		return this.vooService.listarVoos();
	}
	

}
