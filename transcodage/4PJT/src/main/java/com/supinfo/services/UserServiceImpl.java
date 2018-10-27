package com.supinfo.services;

import com.supinfo.model.User;
import com.supinfo.model.UserSpace;
import com.supinfo.repository.UserRepository;
import com.supinfo.repository.UserSpaceRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
@Qualifier(value="userServiceImpl")
public class UserServiceImpl implements UserService {

    @Autowired
    private UserRepository userRepository;

    @Override
    public User findByMail(String mail) {
        return userRepository.findByMail(mail);
    }

    @Override
    public boolean userExist(User user) {

        if(userRepository.findByMail(user.getMail()) != null){

            return true;
        }
        else
        {return false; }
    }

    @Override
    public User createUser(User user) {

        return userRepository.save(user);


    }


}
