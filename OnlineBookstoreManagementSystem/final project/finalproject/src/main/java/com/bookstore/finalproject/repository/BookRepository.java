package com.bookstore.finalproject.repository;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import com.bookstore.finalproject.entity.Book;


@Repository
public interface BookRepository extends JpaRepository <Book,Integer> {

}
