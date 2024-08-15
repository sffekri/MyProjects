package com.bookstore.finalproject.controller;

import java.util.*;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.access.prepost.PreAuthorize;
//import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.stereotype.Controller;
import org.springframework.ui.Model;
import org.springframework.web.bind.annotation.*;
import org.springframework.web.servlet.ModelAndView;

import com.bookstore.finalproject.entity.Book;
import com.bookstore.finalproject.entity.MyBookList;
import com.bookstore.finalproject.service.BookService;
import com.bookstore.finalproject.service.MyBookListService;

@Controller
public class BookController {
	
	@Autowired
	private BookService service;
	
	@Autowired
	private MyBookListService myBookListService;
	
	@GetMapping("/testDatabaseConnection")
    @ResponseBody
    public String testDatabaseConnection() {
        int count = service.countBooks();
        return "Number of books in the database: " + count;
    }
	
	@GetMapping("/home")
	public String home() {
		return "home";
	}
	
	
	
	@GetMapping("/bookRegister")
	@PreAuthorize("hasRole('ADMIN')")
	public String bookRegister() {
		return "bookRegister";
	}
	
	@GetMapping("/availableBook")
	public ModelAndView getAllBook() {
		List<Book> list=service.getAllBooks();
		return new ModelAndView("availableBook", "books", list);
		
	}
	
	@PostMapping("/save")
	@PreAuthorize("isAuthenticated()")
	public String addBook(@ModelAttribute Book b) {
		service.save(b);
		return"redirect:/availableBook";
	}
	
	@GetMapping("/mybook")
	@PreAuthorize("isAuthenticated()")
	public String getMyBooks(Model model) {
		List<MyBookList>list=myBookListService.getAllMyBooks();
		model.addAttribute("myBook", list);
		return "mybook";
	}
	
	@RequestMapping("/mylist/{id}")
	@PreAuthorize("isAuthenticated()")
	public String getMyList(@PathVariable("id") int id) {
		Book b=service.getBookById(id);
		MyBookList  mb=new MyBookList(b.getId(), b.getName(), b.getAuthor(), b.getPrice());
		myBookListService.saveMyBooks(mb);
		return "redirect:/mybook";
		
	}
	
	@RequestMapping("/editBook/{id}")
	@PreAuthorize("hasRole('ADMIN')")
	public String editBook(@PathVariable("id") int id, Model model) {
		Book b=service.getBookById(id);
		model.addAttribute("book", b);
		return"bookEdit";
	}
	
	
	@RequestMapping("/deleteBook/{id}")
	@PreAuthorize("hasRole('ADMIN')")
	public String deleteBook(@PathVariable("id") int id) {
		service.deleteById(id);
		return "redirect:/availableBook";
	}
	
	
	

}
