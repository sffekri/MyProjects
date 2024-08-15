package com.bookstore.finalproject.security;


import javax.sql.DataSource;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.security.config.annotation.authentication.builders.AuthenticationManagerBuilder;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.config.annotation.web.configuration.EnableWebSecurity;
import org.springframework.security.config.annotation.web.configuration.WebSecurityConfigurerAdapter;
import org.springframework.security.provisioning.JdbcUserDetailsManager;
import org.springframework.security.provisioning.UserDetailsManager;


@Configuration
@EnableWebSecurity
public class SecurityConfig extends WebSecurityConfigurerAdapter {

    @Autowired
    private DataSource dataSource; // Autowire your DataSource

    @Bean
    public UserDetailsManager userDetailsManager(DataSource dataSource) {
        return new JdbcUserDetailsManager(dataSource);
    }

    
    protected void configure(AuthenticationManagerBuilder auth) throws Exception {
        auth.jdbcAuthentication()
            .dataSource(dataSource)
            .usersByUsernameQuery("SELECT username, password, enabled FROM users WHERE username=?")
            .authoritiesByUsernameQuery("SELECT username, authority FROM authorities WHERE username=?");
    
    }
    
    protected void configure(HttpSecurity http) throws Exception {
        http
                .authorizeHttpRequests(authorizeRequests ->
                        authorizeRequests
                                .requestMatchers("/bookRegister/**", "/bookEdit/**","/availableBook/**").hasRole("ROLE_ADMIN")
                                .requestMatchers("/mybook/**","/availableBook/**").hasRole("ROLE_USER")
                                .requestMatchers("/home").permitAll()
                                .anyRequest().authenticated()

                		)
                
                .formLogin(form -> form
                		.loginPage("/showMyLoginPage")
                		.loginProcessingUrl("/authenticateTheUser")
                		.permitAll()
                )
                .logout(logout -> logout
                        .permitAll()
                );
        
        
    }
}

    
    /*package com.bookstore.finalproject.security;

 


import javax.sql.DataSource;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.context.annotation.Bean;
import org.springframework.context.annotation.Configuration;
import org.springframework.security.config.annotation.web.builders.HttpSecurity;
import org.springframework.security.config.annotation.web.configuration.EnableWebSecurity;
import org.springframework.security.provisioning.JdbcUserDetailsManager;
import org.springframework.security.provisioning.UserDetailsManager;
import org.springframework.security.web.SecurityFilterChain;



@Configuration
@EnableWebSecurity
public class SecurityConfig {
	
    //@Bean
    //PasswordEncoder passwordEncoder() {
        //return new BCryptPasswordEncoder();
    //}

    //public BCryptPasswordEncoder passwordEncoder() {
        //return new BCryptPasswordEncoder();
    //}
    
	@Autowired
    private DataSource dataSource; 
	
    @Bean
    public UserDetailsManager userDetailsManager(DataSource dataSource) {
    	return new JdbcUserDetailsManager(dataSource);
    	}

    
    
    @Bean
    public SecurityFilterChain securityFilterChain(HttpSecurity http) throws Exception {
        http
                .authorizeHttpRequests(authorizeRequests ->
                        authorizeRequests
                                //.requestMatchers("/bookRegister/**", "/bookEdit/**").hasRole("ADMIN")
                                //.requestMatchers("/mybook/**").authenticated()
                        
                                .requestMatchers("/home", "/availableBook").permitAll()
                                .anyRequest().authenticated()

                		)
                
                .formLogin(form -> form
                		.loginPage("/login")
                		.permitAll()
                )
                .logout(logout -> logout
                        .permitAll()
                );
        
        return http.build();
    }
}

/*UserDetailsService userDetailsService(PasswordEncoder passwordEncoder) {
        InMemoryUserDetailsManager manager = new InMemoryUserDetailsManager();
        manager.createUser(User.withUsername("user")
                .password(passwordEncoder.encode("password"))
                .roles("USER")
                .build());
        manager.createUser(User.withUsername("admin")
                .password(passwordEncoder.encode("admin"))
                .roles("ADMIN")
                .build());
        return manager;
    }
*/