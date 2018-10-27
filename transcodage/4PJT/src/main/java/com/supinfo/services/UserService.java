package com.supinfo.services;

import com.supinfo.model.User;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.stereotype.Service;

import java.util.List;


public interface UserService {

    User findByMail(String mail);

    boolean userExist(User user);

    User createUser(User user);


}
