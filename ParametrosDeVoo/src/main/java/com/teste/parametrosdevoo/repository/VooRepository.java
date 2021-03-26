package com.teste.parametrosdevoo.repository;

import java.util.Optional;

import org.springframework.data.jpa.repository.JpaRepository;

import com.teste.parametrosdevoo.model.Voo;

public interface VooRepository extends JpaRepository<Voo, Long> {
//	Optional<Voo> findById(Long id);
}
