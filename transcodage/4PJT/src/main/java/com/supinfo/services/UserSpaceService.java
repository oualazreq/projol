package com.supinfo.services;

import com.supinfo.model.User;
import com.supinfo.model.UserSpace;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.stereotype.Service;

import java.net.URISyntaxException;

@Service
public interface UserSpaceService {

    int getSize(String UserSpacePath);

    Boolean isSufficent(int UserSpaceSize, int currentVideoSize);

    UserSpace createSpace(User user) throws URISyntaxException;


    UserSpace saveSpace(UserSpace userSpace);




}
