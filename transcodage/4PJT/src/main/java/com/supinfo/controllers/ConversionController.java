package com.supinfo.controllers;

import com.google.common.collect.Lists;
import com.supinfo.core.WorkerService;
import com.supinfo.model.ConvertModel;
import com.supinfo.model.ConvertedVideo;
import com.supinfo.model.User;
import com.supinfo.services.UserService;
import com.supinfo.services.VideoService;
import it.ozimov.springboot.templating.mail.model.Email;
import it.ozimov.springboot.templating.mail.model.impl.EmailImpl;
import it.ozimov.springboot.templating.mail.service.EmailService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.web.bind.annotation.*;

import javax.mail.internet.AddressException;
import javax.mail.internet.InternetAddress;
import java.io.IOException;
import java.io.UnsupportedEncodingException;
import java.nio.charset.Charset;

@RestController
@RequestMapping("/api/convert")
public class ConversionController {

    @Autowired
    @Qualifier(value = "workerImpl")
    WorkerService workerService;

    @Autowired
    @Qualifier(value="videoServiceImpl")
    VideoService videoService;

    @Autowired
    @Qualifier(value = "userServiceImpl")
    UserService userService;

    @Autowired

    EmailService emailService;

   // @RequestMapping(path = "/{convertModel}/{mail}", method = RequestMethod.GET)
    @RequestMapping( method = RequestMethod.POST)
    //public ConvertedVideo convertVideo(@PathVariable String mail, @PathVariable ConvertModel convertModel) throws IOException {
    public ConvertedVideo convertVideo(@RequestBody ConvertModel convertModel) throws IOException, AddressException {

        System.out.println(convertModel.getFromFile());
        String toFile = convertModel.getFromFile().split("\\.")[0].split("uploads")[0]+"conversions"+
                convertModel.getFromFile().split("\\.")[0].split("uploads")[1]+"."+convertModel.getToFormat();
        boolean isConverted = workerService.convert(convertModel.getFromFile(),toFile);

        if(isConverted){

            ConvertedVideo convertedVideo = new ConvertedVideo();
            convertedVideo.setName(toFile.split("/")[2]);
            User user = userService.findByMail(convertModel.getMail());
            convertedVideo.setUser(user);
            this.sendEmailWithoutTemplating(user.getMail());
            return videoService.saveVideo(convertedVideo);
        }

        return null;
    }


    public void sendEmailWithoutTemplating(String userMail) throws UnsupportedEncodingException, AddressException {
        final Email email = EmailImpl.builder()
                .from(new InternetAddress("transcode@transcode.sup", "TRANSCODE TEAM"))
                .to(Lists.newArrayList(new InternetAddress(userMail)))
                .subject("onvertion is over")
                .body("Your convertion is over... You gan go to your userSpace to download it !!! :) ")
                .encoding(Charset.forName("UTF-8")).build();

        emailService.send(email);
    }


}
