package com.supinfo.services;

import com.supinfo.model.ConvertedVideo;
import com.supinfo.model.Video;
import com.supinfo.repository.ConvertedVideoRepo;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.beans.factory.annotation.Qualifier;
import org.springframework.stereotype.Service;

@Service
@Qualifier(value = "videoServiceImpl")
public class VideoServiceImpl implements VideoService {

    @Autowired
    ConvertedVideoRepo convertedVideoRepo;



    @Override
    public ConvertedVideo saveVideo(ConvertedVideo convertedVideo) {
        return convertedVideoRepo.save(convertedVideo);
    }
}
