package com.bookstore.finalproject.controller;

import java.util.*;

import org.springframework.beans.factory.annotation.Autowired;
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
	
	@GetMapping("/")
	public String home() {
		return "home";
	}
	
	@GetMapping("/bookRegister")
	public String bookRegister() {
		return "bookRegister";
	}
	
	@GetMapping("/availableBook")
	public ModelAndView getAllBook() {
		List<Book> list=service.getAllBooks();
		return new ModelAndView("availableBook", "books", list);
		
	}
	
	@PostMapping("/save")
	public String addBook(@ModelAttribute Book b) {
		service.save(b);
		return"redirect:/availableBook";
	}
	
	@GetMapping("/mybook")
	public String getMyBooks(Model model) {
		List<MyBookList>list=myBookListService.getAllMyBooks();
		model.addAttribute("myBook", list);
		return "mybook";
	}
	
	@RequestMapping("/mylist/{id}")
	public String getMyList(@PathVariable("id") int id) {
		Book b=service.getBookById(id);
		MyBookList  mb=new MyBookList(b.getId(), b.getName(), b.getAuthor(), b.getPrice());
		myBookListService.saveMyBooks(mb);
		return "redirect:/mybook";
		
	}
	
	@RequestMapping("/editBook/{id}")
	public String editBook(@PathVariable("id") int id, Model model) {
		Book b=service.getBookById(id);
		model.addAttribute("book", b);
		return"bookEdit";
	}
	
	
	@RequestMapping("/deleteBook/{id}")
	public String deleteBook(@PathVariable("id") int id) {
		service.deleteById(id);
		return "redirect:/availableBook";
	}
	
	//@GetMapping("/mybook")
	//public ModelAndView getMyBooks() {
		//List<MyBookList> list=myBookListService.getAllMyBooks();
		//return new ModelAndView("mybook", "myBook", list);
		
	// }
	
	
	
	//@PostMapping("/addToMyBook")
    //public String addToMyBook(@RequestParam int id,
    						 // @RequestParam String name,
    						  //@RequestParam String author,
    						  //@RequestParam String price) {
        //MyBookList myBook = new MyBookList(id, name, author, price);
        //myBookListService.savebook(myBook);
        //return "redirect:/mybook";
    //}
	
	

}
