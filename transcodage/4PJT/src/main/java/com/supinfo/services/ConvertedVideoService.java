package com.supinfo.services;

import com.supinfo.model.ConvertedVideo;
import com.supinfo.model.User;

import java.util.List;
public interface ConvertedVideoService  {

    List<ConvertedVideo> findByUser(User user);
}
