package com.bookstore.finalproject.controller;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.security.access.prepost.PreAuthorize;
import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.PathVariable;
import org.springframework.web.bind.annotation.RequestMapping;

import com.bookstore.finalproject.service.MyBookListService;

@Controller
public class MyBookListController {
	
	@Autowired
	private MyBookListService service;
	
	@PreAuthorize("isAuthenticated()")
	@RequestMapping("/deleteMyList/{id}")
	public String deleteMyList(@PathVariable ("id") int id){
		service.deleteById(id);
		return"redirect:/mybook";
	}

}
