package com.supinfo.controllers;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.RequestBody;
import org.springframework.web.bind.annotation.RequestMapping;
import org.springframework.web.bind.annotation.RequestMethod;


@Controller
public class TestController {

    @RequestMapping(path="api/users/redirect",method = RequestMethod.POST)
    public String createUserAndSpace(@RequestBody String path){

        return "redirect:"+path;

    }
}
