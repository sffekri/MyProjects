package com.bookstore.finalproject.service;

import java.util.*;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.bookstore.finalproject.entity.MyBookList;
import com.bookstore.finalproject.repository.MyBookRepository;



@Service
public class MyBookListService {
	
	@Autowired
	private MyBookRepository mybook;
	
	public MyBookList saveMyBooks(MyBookList book) {
		return mybook.save(book);
	}
	
	
	public List<MyBookList> getAllMyBooks(){
		return mybook.findAll();
	}
	
	public void deleteById(int id) {
		mybook.deleteById(id);
	}

}
