package com.supinfo.controllers;


import com.supinfo.TranscodeApplication;
import com.supinfo.model.SizeModel;
import com.supinfo.model.User;
import com.supinfo.model.UserSpace;
import com.supinfo.services.UserService;
import com.supinfo.services.UserSpaceService;
import org.apache.tomcat.util.http.fileupload.FileUtils;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.core.io.ClassPathResource;
import org.springframework.web.bind.annotation.*;

import java.io.File;
import java.io.FileInputStream;
import java.io.FileNotFoundException;
import java.io.IOException;
import java.net.URI;
import java.net.URISyntaxException;
import java.nio.file.Files;


@RestController
@RequestMapping("/api/users")
@CrossOrigin(origins = "https://transcode.sup:9000/")
public class UserController {

    @Autowired
    @Qualifier(value="userServiceImpl")
    private UserService userService;

    @Autowired
    @Qualifier(value="userSpaceServiceImpl")
    private UserSpaceService userSpaceService;



    /*public UserController(UserService userService, UserSpaceService userSpaceService) {
        this.userService = userService;
        this.userSpaceService = userSpaceService;
    }*/


    @RequestMapping(method = RequestMethod.POST)
    public void createUserAndSpace(@RequestBody User user){

        if(!userService.userExist(user)){
            try {

               UserSpace userSpace = userSpaceService.saveSpace(
                        userSpaceService.createSpace(user)
                );

                user.setUserSpace(userSpace);
                userService.createUser(user);

            } catch (URISyntaxException e) {
                e.printStackTrace();
            }
        }
    }



    @RequestMapping(path = "/space",method = RequestMethod.GET)
    public SizeModel createUserAndSpace(@RequestParam(value = "mail") String mail) throws FileNotFoundException {

        User user = userService.findByMail(mail);

        String userSpacePath = user.getUserSpace().getPath();

        URI uri = null;
        try {
            uri = new ClassPathResource("application.yaml").getURI();
        } catch (IOException e) {
            e.printStackTrace();
        }
        File fullPathToSubfolder = new File(uri).getAbsoluteFile();
        String projectFolder = fullPathToSubfolder.getAbsolutePath().split("target")[0];

        File file = new File(projectFolder+ TranscodeApplication.ROOT+"/"+userSpacePath);

        long size = getFolderSize(file);

        SizeModel sizeModel = new SizeModel(size);

        return sizeModel;
    }

    private static long getFolderSize(File dir) {
        long size = 0;
        for (File file : dir.listFiles()) {
            if (file.isFile()) {
                // System.out.println(file.getName() + " " + file.length());
                size += file.length();
            } else
                size += getFolderSize(file);
        }
        return size;
    }



}
