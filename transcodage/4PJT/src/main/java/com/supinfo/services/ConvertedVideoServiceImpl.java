package com.supinfo.services;

import com.supinfo.model.ConvertedVideo;
import com.supinfo.model.User;
import com.supinfo.repository.ConvertedVideoRepo;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
@Qualifier("convertedVideoServiceImpl")
public class ConvertedVideoServiceImpl implements ConvertedVideoService {

    @Autowired
    ConvertedVideoRepo convertedVideoRepo;


    @Override
    public List<ConvertedVideo> findByUser(User user) {
        return convertedVideoRepo.findByUser(user);
    }
}
