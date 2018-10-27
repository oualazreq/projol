package com.supinfo.controllers;

import com.supinfo.model.ConvertedVideo;
import com.supinfo.model.User;
import com.supinfo.model.UserSpace;
import com.supinfo.services.ConvertedVideoService;
import com.supinfo.services.UserService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.web.bind.annotation.*;

import java.net.URISyntaxException;
import java.util.ArrayList;
import java.util.List;

@RestController
@RequestMapping("/api/convertedVideoss")
public class ConvertedVideoController {

    @Autowired
    @Qualifier(value = "userServiceImpl")
    UserService userService;

    @Autowired
    @Qualifier(value = "convertedVideoServiceImpl")
    ConvertedVideoService convertedVideoService;

    @RequestMapping(method = RequestMethod.GET)
    public List<ConvertedVideo> createUserAndSpace(@RequestParam(value = "mail") String mail){



        User user = userService.findByMail(mail);


          if (user!=null){
                return convertedVideoService.findByUser(user);
            }
            else {
                return null;
            }
        }
}
