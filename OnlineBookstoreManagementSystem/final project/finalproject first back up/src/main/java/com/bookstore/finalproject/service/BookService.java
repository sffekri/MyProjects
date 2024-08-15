package com.bookstore.finalproject.service;

import java.util.List;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import com.bookstore.finalproject.entity.Book;
import com.bookstore.finalproject.repository.BookRepository;

@Service
public class BookService {
	
	@Autowired
	private BookRepository bRepo;
	
	public void save(Book b) {
		bRepo.save(b);
		System.out.println("Saved Book:" + b);
		
	}
	
	public int countBooks() {
		return(int) bRepo.count();
	}
	
	public List<Book> getAllBooks(){
		return bRepo.findAll();
	}
	
	public Book getBookById(int id) {
		return bRepo.findById(id).get();
	}
	
	public void deleteById(int id) {
		bRepo.deleteById(id);
	}
	

	
}
