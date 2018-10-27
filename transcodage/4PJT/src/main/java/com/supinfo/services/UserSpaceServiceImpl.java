package com.supinfo.services;

import com.supinfo.model.User;
import com.supinfo.model.UserSpace;
import com.supinfo.repository.UserSpaceRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.core.io.ClassPathResource;
import org.springframework.stereotype.Service;

import java.io.File;
import java.io.IOException;
import java.net.URI;
import java.net.URISyntaxException;
import java.net.URL;

@Service
@Qualifier(value="userSpaceServiceImpl")
public class UserSpaceServiceImpl implements UserSpaceService {

    @Autowired
    UserSpaceRepository userSpaceRepository;

    @Override
    public int getSize(String UserSpacePath) {
        return 0;
    }

    @Override
    public Boolean isSufficent(int UserSpaceSize, int currentVideoSize) {
        return null;
    }

    @Override
    public UserSpace createSpace(User user) throws URISyntaxException {

        URI uri = null;
        try {
            uri = new ClassPathResource("application.yaml").getURI();
        } catch (IOException e) {
            e.printStackTrace();
        }
        File fullPathToSubfolder = new File(uri).getAbsoluteFile();
        String projectFolder = fullPathToSubfolder.getAbsolutePath().split("target")[0];
        File user_dir = new File(projectFolder+"Transcode_space\\"+user.getUserSpace().getPath());
        File upload_dir = new File(projectFolder+"Transcode_space\\"+user.getUserSpace().getPath()+"\\uploads");
        File conversion_dir = new File(projectFolder+"Transcode_space\\"+user.getUserSpace().getPath()+"\\conversions");

        System.out.println(projectFolder+"Transcode_space\\"+user.getUserSpace().getPath()+"\\uploads");
        UserSpace userSpace = new UserSpace(user.getUserSpace().getPath());

        if(user_dir.mkdir() && upload_dir.mkdir() && conversion_dir.mkdir()){
            return userSpace;
        }
            return null;

    }

    @Override
    public UserSpace saveSpace(UserSpace userSpace) {
        return userSpaceRepository.save(userSpace);
    }
}
