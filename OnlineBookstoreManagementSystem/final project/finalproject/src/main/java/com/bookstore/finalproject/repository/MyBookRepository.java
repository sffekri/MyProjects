package com.bookstore.finalproject.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.bookstore.finalproject.entity.MyBookList;


@Repository
public interface MyBookRepository extends JpaRepository<MyBookList,Integer>{
	
}
